<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit('Método não permitido');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    exit('Preencha todos os campos.');
}

try {
    $db = new SQLite3(__DIR__.'/scripts/users.db');
    $stmt = $db->prepare("SELECT id, nome, email, password FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if (!$user || !password_verify($password, $user['password'])) {
        exit('Email ou palavra-passe incorretos!');
    }

    // Guardar sessão
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nome'] = $user['nome'];

    // Se for usado com JavaScript, devolver só texto:
    exit('OK_LOGIN');
}
catch (Exception $e) {
    exit('Erro: ' . $e->getMessage());
}
