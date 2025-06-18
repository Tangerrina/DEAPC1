<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    if (empty($nome) || empty($email) || empty($password) || empty($repeat_password)) {
        die("Todos os campos são obrigatórios.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido.");
    }

    if ($password !== $repeat_password) {
        die("As passwords não coincidem.");
    }

    
    $db = new SQLite3(__DIR__ . "/../users.db");

    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    )");

    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(":email", $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($result->fetchArray()) {
        die("Email já registado.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)");
    $stmt->bindValue(":nome", $nome, SQLITE3_TEXT);
    $stmt->bindValue(":email", $email, SQLITE3_TEXT);
    $stmt->bindValue(":password", $hashed_password, SQLITE3_TEXT);
    $stmt->execute();

    $_SESSION["user_id"] = $db->lastInsertRowID();
    $_SESSION["nome"] = $nome;

    header("Location: Inicio.php");
    exit();
}
?>
