<?php
session_start();

// Caminho absoluto para a base de dados principal
$db = new SQLite3(__DIR__ . '/../users.db');

// Cria a tabela se não existir
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
)");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verifica se já existe utilizador com este email
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    if ($result->fetchArray()) {
        echo "Email já registado.";
        exit;
    }

    // Insere novo utilizador
    $stmt = $db->prepare("INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)");
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);

    if ($stmt->execute()) {
        // Login automático
        $_SESSION["user_id"] = $db->lastInsertRowID();
        $_SESSION["nome"] = $nome;
        header("Location: Inicio.php");
        exit();
    } else {
        echo "Erro ao registar utilizador.";
    }
}
?>