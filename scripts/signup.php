<?php
/* devolve texto simples que o JavaScript vai ler               */
/* NÃO emite <script> nem header('Location')                    */
ini_set('display_errors',1); error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido');
}

$nome  = trim($_POST['nome']  ?? '');
$email = trim($_POST['email'] ?? '');
$pw1   = $_POST['password'] ?? '';
$pw2   = $_POST['repeat_password'] ?? '';

if ($nome==='' || $email==='' || $pw1==='' || $pw2==='') {
    exit('Todos os campos são obrigatórios!');
}
if ($pw1 !== $pw2) {
    exit('Credenciais inválidas! As senhas não coincidem.');
}

try {
    $db = new SQLite3(__DIR__.'/scripts/users.db');
    $db->exec('CREATE TABLE IF NOT EXISTS users(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT, email TEXT UNIQUE, password TEXT )');

    $stmt = $db->prepare(
        'INSERT INTO users (nome,email,password) VALUES (?,?,?)'
    );
    $stmt->bindValue(1,$nome,  SQLITE3_TEXT);
    $stmt->bindValue(2,$email, SQLITE3_TEXT);
    $stmt->bindValue(3,password_hash($pw1,PASSWORD_DEFAULT),SQLITE3_TEXT);
    $stmt->execute();

    /* “palavra-chave” para o JS identificar sucesso */
    exit('OK_REGISTO');
}
catch (Exception $e) {
    exit('Erro: '.$e->getMessage());
}
