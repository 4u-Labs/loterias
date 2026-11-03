<?php
// auth.php - Controle de Sessão e Autenticação

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkAuth() {
    // No-op: acesso liberado para todos
}

function redirectToLogin() {
    // No-op
}
