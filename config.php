<?php
// config.php - Configurações Gerais de Segurança e Acesso

// Nome da aplicação
define('APP_NAME', 'Super Loterias');

// Credenciais Padrão do Leitor (Comprador)
define('READER_USERNAME', 'leitor@superloterias.com');
define('READER_PASSWORD_HASH', '$2y$10$cAipO3DF5ra1wbd3BaHyjeG/KVIXjVYBRouGXQiaqvTegFBCOjIci'); // Senha correspondente: 'SuperLoterias2026'

// Senha Administrativa de Suporte (para atualizar resultados e testes)
define('ADMIN_PASSWORD_HASH', '$2y$10$nEjvNXhcbi750bSruf3Vqe3Djf4oeAnH1/YiIpmMJEe7R6.MYdpqW'); // Senha correspondente: 'F.braga1'

// Caminho absoluto para a base de dados JSON estatística
define('DB_FILE_PATH', __DIR__ . '/loterias_stats.json');
