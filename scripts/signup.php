<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


$db = new SQLite3(__DIR__ . '/../users.db');


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


    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($result->fetchArray()) {
        die("Email já registado.");
    }

    $stmt = $db->prepare("INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)");
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);

    if ($stmt->execute()) {

        $_SESSION["user_id"] = $db->lastInsertRowID();
        $_SESSION["nome"] = $nome;
        header("Location: Inicio.php");
        exit();
    } else {
        echo "Erro ao registar utilizador.";
    }
}
?>
