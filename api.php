<?php
// api.php - API de Processamento Matemático Segura
require_once 'config.php';

// Exige autenticação de sessão
require_once 'auth.php';
checkAuth();

header('Content-Type: application/json; charset=utf-8');

// Configura limites de tempo e memória
set_time_limit(30);
ini_set('memory_limit', '128M');

// Carrega os dados estatísticos
if (!file_exists(DB_FILE_PATH)) {
    echo json_encode(['error' => 'Base de dados não encontrada.']);
    exit;
}

$raw_db = file_get_contents(DB_FILE_PATH);
$LOTTERY_DATABASE = json_decode($raw_db, true);

if (!$LOTTERY_DATABASE) {
    echo json_encode(['error' => 'Erro ao processar base de dados.']);
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

// Lista de loterias válidas
$valid_lotteries = ['megasena', 'lotofacil', 'quina', 'lotomania', 'duplasena', 'timemania'];

// Regras de limites de cada loteria
$lottery_rules = [
    'megasena' => ['min' => 6, 'max' => 60, 'maxSel' => 20],
    'lotofacil' => ['min' => 15, 'max' => 25, 'maxSel' => 20],
    'quina' => ['min' => 5, 'max' => 80, 'maxSel' => 15],
    'lotomania' => ['min' => 50, 'max' => 100, 'maxSel' => 50],
    'duplasena' => ['min' => 6, 'max' => 50, 'maxSel' => 15],
    'timemania' => ['min' => 7, 'max' => 80, 'maxSel' => 10]
];

switch ($action) {
    case 'get_stats':
        $lottery = isset($_GET['lottery']) ? trim($_GET['lottery']) : '';
        if (!in_array($lottery, $valid_lotteries)) {
            echo json_encode(['error' => 'Loteria inválida.']);
            exit;
        }
        echo json_encode($LOTTERY_DATABASE[$lottery]);
        break;

    case 'generate_games':
        // Recebe parâmetros do POST
        $input = json_decode(file_get_contents('php://input'), true);
        $lottery = isset($input['lottery']) ? trim($input['lottery']) : '';
        $numCount = isset($input['numCount']) ? intval($input['numCount']) : 0;
        $gameCount = isset($input['gameCount']) ? intval($input['gameCount']) : 0;
        $strategy = isset($input['strategy']) ? trim($input['strategy']) : 'balanced';
        $fixedNumbers = isset($input['fixedNumbers']) ? array_map('intval', $input['fixedNumbers']) : [];
        $excludedNumbers = isset($input['excludedNumbers']) ? array_map('intval', $input['excludedNumbers']) : [];

        if (!in_array($lottery, $valid_lotteries)) {
            echo json_encode(['error' => 'Loteria inválida.']);
            exit;
        }

        $r = $lottery_rules[$lottery];
        if ($numCount < $r['min'] || $numCount > $r['maxSel']) {
            echo json_encode(['error' => 'Quantidade de dezenas inválida.']);
            exit;
        }

        if ($gameCount < 1 || $gameCount > 100) {
            echo json_encode(['error' => 'Quantidade de jogos deve ser entre 1 e 100.']);
            exit;
        }

        // Gera os jogos estatísticos
        $generated = [];
        $generatedKeys = [];
        $attempts = 0;

        while (count($generated) < $gameCount && $attempts < 1000) {
            $attempts++;
            $g = getStatisticalGame($lottery, $numCount, $strategy, $fixedNumbers, $excludedNumbers, $LOTTERY_DATABASE[$lottery], $r);
            sort($g);
            $key = implode(',', $g);
            if (!in_array($key, $generatedKeys)) {
                $generatedKeys[] = $key;
                $generated[] = $g;
            }
        }

        echo json_encode(['games' => $generated]);
        break;

    case 'calculate_covering':
        // Recebe parâmetros do POST
        $input = json_decode(file_get_contents('php://input'), true);
        $lottery = isset($input['lottery']) ? trim($input['lottery']) : '';
        $pool = isset($input['pool']) ? array_map('intval', $input['pool']) : [];
        $ticketSize = isset($input['ticketSize']) ? intval($input['ticketSize']) : 0;
        $guarantee = isset($input['guarantee']) ? intval($input['guarantee']) : 0;

        if (!in_array($lottery, $valid_lotteries)) {
            echo json_encode(['error' => 'Loteria inválida.']);
            exit;
        }

        $poolCount = count($pool);
        if ($poolCount < $ticketSize || $poolCount > 20) {
            echo json_encode(['error' => 'Conjunto de dezenas muito grande ou inválido (máximo permitido: 20 dezenas).']);
            exit;
        }

        // Calcula combinações para ver se excede limite de memória
        $cands = combinationCount($poolCount, $ticketSize);
        $targs = combinationCount($poolCount, $guarantee);
        if ($cands > 20000 || $targs > 20000) {
            echo json_encode(['error' => 'A complexidade deste fechamento é muito alta para processar.']);
            exit;
        }

        $generated = solveCoveringDesign($pool, $ticketSize, $guarantee);
        echo json_encode(['games' => $generated]);
        break;

    case 'update_results':
        // Recebe o input JSON para obter a senha
        $input = json_decode(file_get_contents('php://input'), true);
        $password = isset($input['password']) ? $input['password'] : '';

        // Valida a senha contra o hash do administrador
        if (!password_verify($password, ADMIN_PASSWORD_HASH)) {
            echo json_encode(['error' => 'Senha incorreta. Acesso negado.']);
            exit;
        }

        $updated_any = false;
        $messages = [];
        $PRIMES = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97];

        foreach ($valid_lotteries as $key) {
            // Tenta primeiro a API espelho do Heroku (sem bloqueio de data center)
            $api_url = "https://loteriascaixa-api.herokuapp.com/api/" . $key . "/latest";
            $api_data = fetchUrlJson($api_url);

            // Se falhar, tenta o servicebus oficial da Caixa
            if (!$api_data || !isset($api_data['concurso']) || !isset($api_data['dezenas'])) {
                $api_url = "https://servicebus2.caixa.gov.br/portaldeloterias/api/" . $key;
                $api_data = fetchUrlJson($api_url);
            }

            // Normaliza os campos das duas estruturas possíveis
            $latest_contest_api = 0;
            $dezenas_strings = [];
            $date = '';

            if ($api_data && isset($api_data['concurso']) && isset($api_data['dezenas'])) {
                $latest_contest_api = intval($api_data['concurso']);
                $dezenas_strings = $api_data['dezenas'];
                $date = isset($api_data['data']) ? $api_data['data'] : date('d/m/Y');
            } elseif ($api_data && isset($api_data['numero']) && isset($api_data['listaDezenas'])) {
                $latest_contest_api = intval($api_data['numero']);
                $dezenas_strings = $api_data['listaDezenas'];
                $date = isset($api_data['dataApuracao']) ? $api_data['dataApuracao'] : date('d/m/Y');
            }

            if ($latest_contest_api === 0 || empty($dezenas_strings)) {
                $messages[] = "[$key] Não foi possível consultar o resultado mais recente (bloqueio de conexão ou API offline).";
                continue;
            }

            $latest_contest_local = intval($LOTTERY_DATABASE[$key]['latest_draw']['contest']);

            if ($latest_contest_api > $latest_contest_local) {
                $dezenas = array_map('intval', $dezenas_strings);
                sort($dezenas);
                
                $date = isset($api_data['dataApuracao']) ? $api_data['dataApuracao'] : date('d/m/Y');
                
                $new_draw = [
                    'contest' => $latest_contest_api,
                    'date' => $date,
                    'numbers' => $dezenas
                ];
                
                // 1. Atualizar latest_draw
                $LOTTERY_DATABASE[$key]['latest_draw'] = $new_draw;
                
                // 2. Incrementar total_draws
                $LOTTERY_DATABASE[$key]['total_draws'] += 1;
                
                // 3. Atualizar recent_draws
                $recent = $LOTTERY_DATABASE[$key]['recent_draws'];
                $recent[] = $new_draw;
                if (count($recent) > 15) {
                    array_shift($recent);
                }
                $LOTTERY_DATABASE[$key]['recent_draws'] = $recent;
                
                // 4. Atualizar frequências
                foreach ($dezenas as $n) {
                    if (isset($LOTTERY_DATABASE[$key]['frequency'][$n])) {
                        $LOTTERY_DATABASE[$key]['frequency'][$n] += 1;
                    } else {
                        $LOTTERY_DATABASE[$key]['frequency'][$n] = 1;
                    }
                }
                
                // 5. Atualizar delays
                $max_num = $lottery_rules[$key]['max'];
                for ($i = 1; $i <= $max_num; $i++) {
                    if (in_array($i, $dezenas)) {
                        $LOTTERY_DATABASE[$key]['delays'][$i] = 0;
                    } else {
                        if (isset($LOTTERY_DATABASE[$key]['delays'][$i])) {
                            $LOTTERY_DATABASE[$key]['delays'][$i] += 1;
                        } else {
                            $LOTTERY_DATABASE[$key]['delays'][$i] = 1;
                        }
                    }
                }
                
                // 6. Atualizar even_odd_dist
                $even_count = 0;
                foreach ($dezenas as $n) {
                    if ($n % 2 === 0) $even_count++;
                }
                $odd_count = count($dezenas) - $even_count;
                $pattern = "{$even_count}P:{$odd_count}I";
                if (isset($LOTTERY_DATABASE[$key]['even_odd_dist'][$pattern])) {
                    $LOTTERY_DATABASE[$key]['even_odd_dist'][$pattern] += 1;
                } else {
                    $LOTTERY_DATABASE[$key]['even_odd_dist'][$pattern] = 1;
                }
                
                // 7. Atualizar high_low_dist
                $mid = $max_num / 2;
                $high_count = 0;
                foreach ($dezenas as $n) {
                    if ($n > $mid) $high_count++;
                }
                $low_count = count($dezenas) - $high_count;
                
                $total_numbers_drawn = $LOTTERY_DATABASE[$key]['total_draws'] * count($dezenas);
                $prev_total_numbers = ($LOTTERY_DATABASE[$key]['total_draws'] - 1) * count($dezenas);
                $prev_high_count = round(($LOTTERY_DATABASE[$key]['high_low_dist']['high_pct'] / 100) * $prev_total_numbers);
                $prev_low_count = round(($LOTTERY_DATABASE[$key]['high_low_dist']['low_pct'] / 100) * $prev_total_numbers);
                
                $new_high_total = $prev_high_count + $high_count;
                $new_low_total = $prev_low_count + $low_count;
                
                $LOTTERY_DATABASE[$key]['high_low_dist']['high_pct'] = round(($new_high_total / $total_numbers_drawn) * 100, 2);
                $LOTTERY_DATABASE[$key]['high_low_dist']['low_pct'] = round(($new_low_total / $total_numbers_drawn) * 100, 2);
                
                // 8. Atualizar hot_numbers & cold_numbers
                arsort($LOTTERY_DATABASE[$key]['frequency']);
                $sorted_freq = array_keys($LOTTERY_DATABASE[$key]['frequency']);
                $LOTTERY_DATABASE[$key]['hot_numbers'] = array_slice($sorted_freq, 0, 10);
                
                arsort($LOTTERY_DATABASE[$key]['delays']);
                $sorted_delay = array_keys($LOTTERY_DATABASE[$key]['delays']);
                $LOTTERY_DATABASE[$key]['cold_numbers'] = array_slice($sorted_delay, 0, 10);
                
                ksort($LOTTERY_DATABASE[$key]['frequency']);
                ksort($LOTTERY_DATABASE[$key]['delays']);
                
                // 9. Atualizar avg_sum
                $prev_total_draws = $LOTTERY_DATABASE[$key]['total_draws'] - 1;
                $prev_sum_total = $LOTTERY_DATABASE[$key]['avg_sum'] * $prev_total_draws;
                $new_sum_total = $prev_sum_total + array_sum($dezenas);
                $LOTTERY_DATABASE[$key]['avg_sum'] = round($new_sum_total / $LOTTERY_DATABASE[$key]['total_draws'], 1);
                
                // 10. Atualizar prime_dist
                $p_count = 0;
                foreach ($dezenas as $n) {
                    if (in_array($n, $PRIMES)) $p_count++;
                }
                $p_key = strval($p_count);
                if (isset($LOTTERY_DATABASE[$key]['prime_dist'][$p_key])) {
                    $LOTTERY_DATABASE[$key]['prime_dist'][$p_key] += 1;
                } else {
                    $LOTTERY_DATABASE[$key]['prime_dist'][$p_key] = 1;
                }
                
                // 11. Quadrant dist
                $q_size = $max_num / 4.0;
                $quadrants = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
                foreach ($dezenas as $n) {
                    if ($n <= $q_size) $quadrants[1]++;
                    elseif ($n <= $q_size * 2) $quadrants[2]++;
                    elseif ($n <= $q_size * 3) $quadrants[3]++;
                    else $quadrants[4]++;
                }
                
                foreach ($quadrants as $q => $count) {
                    $q_key = strval($q);
                    $prev_pct = isset($LOTTERY_DATABASE[$key]['quadrant_dist'][$q_key]) ? $LOTTERY_DATABASE[$key]['quadrant_dist'][$q_key] : 25.0;
                    $prev_absolute = round(($prev_pct / 100) * $prev_total_numbers);
                    $new_absolute = $prev_absolute + $count;
                    $LOTTERY_DATABASE[$key]['quadrant_dist'][$q_key] = round(($new_absolute / $total_numbers_drawn) * 100, 1);
                }
                
                $messages[] = "[$key] Sorteio {$latest_contest_api} adicionado e estatísticas atualizadas.";
                $updated_any = true;
            } else {
                $messages[] = "[$key] Já está atualizado no concurso {$latest_contest_local}.";
            }
        }

        if ($updated_any) {
            file_put_contents(DB_FILE_PATH, json_encode($LOTTERY_DATABASE, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }

        echo json_encode(['success' => true, 'updated' => $updated_any, 'messages' => $messages]);
        exit;

    default:
        echo json_encode(['error' => 'Ação inválida.']);
        break;
}

// Funções Auxiliares de Geração Estatística
function getStatisticalGame($lottery, $size, $strategy, $fixedNumbers, $excludedNumbers, $data, $r) {
    $allNums = range(1, $r['max']);
    
    // Filtra dezenas permitidas (não proibidas)
    $allowedPool = array_values(array_filter($allNums, function($n) use ($excludedNumbers) {
        return !in_array($n, $excludedNumbers);
    }));

    // Mantém as fixadas que estão nas permitidas
    $game = array_values(array_filter($fixedNumbers, function($n) use ($allowedPool) {
        return in_array($n, $allowedPool);
    }));

    if (count($game) >= $size) {
        return array_slice($game, 0, $size);
    }

    if ($strategy === 'random' || !$data) {
        $remaining = array_values(array_filter($allowedPool, function($n) use ($game) {
            return !in_array($n, $game);
        }));
        while (count($game) < $size && count($remaining) > 0) {
            $idx = rand(0, count($remaining) - 1);
            $game[] = $remaining[$idx];
            array_splice($remaining, $idx, 1);
        }
        return $game;
    }

    // Estratégias Avançadas
    $hotSet = $data['hot_numbers'];
    $coldSet = $data['cold_numbers'];

    if ($strategy === 'hot') {
        $hotPool = array_values(array_filter($allowedPool, function($n) use ($hotSet) {
            return in_array($n, $hotSet);
        }));
        $restPool = array_values(array_filter($allowedPool, function($n) use ($hotSet) {
            return !in_array($n, $hotSet);
        }));

        while (count($game) < $size) {
            $pool = (rand(1, 100) <= 80 && count($hotPool) > 0) ? $hotPool : $restPool;
            $unselected = array_values(array_filter($pool, function($n) use ($game) {
                return !in_array($n, $game);
            }));
            $finalPool = count($unselected) > 0 ? $unselected : array_values(array_filter($allowedPool, function($n) use ($game) {
                return !in_array($n, $game);
            }));

            if (count($finalPool) === 0) break;
            $idx = rand(0, count($finalPool) - 1);
            $game[] = $finalPool[$idx];
        }
    } 
    elseif ($strategy === 'cold') {
        $coldPool = array_values(array_filter($allowedPool, function($n) use ($coldSet) {
            return in_array($n, $coldSet);
        }));
        $restPool = array_values(array_filter($allowedPool, function($n) use ($coldSet) {
            return !in_array($n, $coldSet);
        }));

        while (count($game) < $size) {
            $pool = (rand(1, 100) <= 80 && count($coldPool) > 0) ? $coldPool : $restPool;
            $unselected = array_values(array_filter($pool, function($n) use ($game) {
                return !in_array($n, $game);
            }));
            $finalPool = count($unselected) > 0 ? $unselected : array_values(array_filter($allowedPool, function($n) use ($game) {
                return !in_array($n, $game);
            }));

            if (count($finalPool) === 0) break;
            $idx = rand(0, count($finalPool) - 1);
            $game[] = $finalPool[$idx];
        }
    } 
    else { // Balanced
        $hotPool = array_values(array_filter($allowedPool, function($n) use ($hotSet) {
            return in_array($n, $hotSet);
        }));
        $coldPool = array_values(array_filter($allowedPool, function($n) use ($coldSet, $hotSet) {
            return in_array($n, $coldSet) && !in_array($n, $hotSet);
        }));
        $neutralPool = array_values(array_filter($allowedPool, function($n) use ($hotSet, $coldSet) {
            return !in_array($n, $hotSet) && !in_array($n, $coldSet);
        }));

        while (count($game) < $size) {
            $rand = rand(1, 100);
            if ($rand <= 60 && count($hotPool) > 0) {
                $pool = $hotPool;
            } elseif ($rand <= 80 && count($coldPool) > 0) {
                $pool = $coldPool;
            } else {
                $pool = count($neutralPool) > 0 ? $neutralPool : $allowedPool;
            }

            $unselected = array_values(array_filter($pool, function($n) use ($game) {
                return !in_array($n, $game);
            }));
            $finalPool = count($unselected) > 0 ? $unselected : array_values(array_filter($allowedPool, function($n) use ($game) {
                return !in_array($n, $game);
            }));

            if (count($finalPool) === 0) break;
            $idx = rand(0, count($finalPool) - 1);
            $game[] = $finalPool[$idx];
        }
    }

    return $game;
}

// Matemática de Combinações
function combinationCount($n, $k) {
    if ($k < 0 || $k > $n) return 0;
    if ($k === 0 || $k === $n) return 1;
    if ($k > $n / 2) $k = $n - $k;
    
    $result = 1;
    for ($i = 1; $i <= $k; $i++) {
        $result = $result * ($n - $k + $i) / $i;
    }
    return round($result);
}

function getCombinations($array, $k) {
    $result = [];
    $count = count($array);
    
    $helper = function($start, $combo) use (&$helper, &$result, $array, $k, $count) {
        if (count($combo) === $k) {
            $result[] = $combo;
            return;
        }
        for ($i = $start; $i < $count; $i++) {
            $combo[] = $array[$i];
            $helper($i + 1, $combo);
            array_pop($combo);
        }
    };
    
    $helper(0, []);
    return $result;
}

function solveCoveringDesign($pool, $ticketSize, $targetSize) {
    $targets = getCombinations($pool, $targetSize);
    $candidates = getCombinations($pool, $ticketSize);
    
    $targetsCount = count($targets);
    $candidatesCount = count($candidates);
    
    $targetCovered = array_fill(0, $targetsCount, false);
    $uncoveredCount = $targetsCount;
    $chosenTickets = [];
    
    $candidateCovers = [];
    for ($i = 0; $i < $candidatesCount; $i++) {
        $c = $candidates[$i];
        $coveredIndices = [];
        for ($tIdx = 0; $tIdx < $targetsCount; $tIdx++) {
            $t = $targets[$tIdx];
            $isSubset = true;
            foreach ($t as $val) {
                if (!in_array($val, $c)) {
                    $isSubset = false;
                    break;
                }
            }
            if ($isSubset) {
                $coveredIndices[] = $tIdx;
            }
        }
        $candidateCovers[$i] = $coveredIndices;
    }
    
    while ($uncoveredCount > 0) {
        $bestCandidateIdx = -1;
        $maxNewCovered = -1;
        
        for ($i = 0; $i < $candidatesCount; $i++) {
            $count = 0;
            $covers = $candidateCovers[$i];
            foreach ($covers as $tIdx) {
                if (!$targetCovered[$tIdx]) {
                    $count++;
                }
            }
            if ($count > $maxNewCovered) {
                $maxNewCovered = $count;
                $bestCandidateIdx = $i;
            }
        }
        
        if ($bestCandidateIdx === -1 || $maxNewCovered === 0) {
            break;
        }
        
        $chosenTickets[] = $candidates[$bestCandidateIdx];
        
        $covers = $candidateCovers[$bestCandidateIdx];
        foreach ($covers as $idx) {
            if (!$targetCovered[$idx]) {
                $targetCovered[$idx] = true;
                $uncoveredCount--;
            }
        }
    }
    
    return $chosenTickets;
}

function fetchUrlJson($url) {
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 12);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    } else {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n",
                "timeout" => 12
            ],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false
            ]
        ];
        $context = stream_context_create($opts);
        $response = @file_get_contents($url, false, $context);
        if ($response === false) {
            return null;
        }
        return json_decode($response, true);
    }
}


