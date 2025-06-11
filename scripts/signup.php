<?php
// signup.php
ini_set('display_errors',1); error_reporting(E_ALL);   // mostre erros

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.html'); exit();
}

$nome           = trim($_POST['nome']  ?? '');
$email          = trim($_POST['email'] ?? '');
$password       = $_POST['password']       ?? '';
$repeatPassword = $_POST['repeat_password']?? '';

// validações
if ($nome === '' || $email === '' || $password === '' || $repeatPassword === '') {
    echo "<script>alert('Todos os campos são obrigatórios!'); history.back();</script>";
    exit;
}
if ($password !== $repeatPassword) {
    echo "<script>alert('Credenciais inválidas! As senhas não coincidem.'); history.back();</script>";
    exit;
}

// grava
try {
    $db = new SQLite3(__DIR__ . '/scripts/users.db');   // ajuste o caminho
    $db->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT, email TEXT UNIQUE, password TEXT
    )');

    $stmt = $db->prepare('INSERT INTO users (nome,email,password) VALUES (?,?,?)');
    $stmt->bindValue(1, $nome,  SQLITE3_TEXT);
    $stmt->bindValue(2, $email, SQLITE3_TEXT);
    $stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);
    $stmt->execute();

    echo "<script>alert('Registo realizado com sucesso!'); window.location.href='login.html';</script>";
    exit;

} catch (Exception $e) {
    // e.g. email duplicado
    echo "<script>alert('Erro: {$e->getMessage()}'); history.back();</script>";
    exit;
}
?>
