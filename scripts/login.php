<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        die("Email e password são obrigatórios.");
    }

    
    $db = new SQLite3(__DIR__ . "/../users.db");

    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(":email", $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if (!$user) {
        echo "Utilizador não registado.";
    } elseif (!password_verify($password, $user["password"])) {
        echo "Password errada.";
    } else {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["nome"] = $user["nome"];
        echo "OK";
        exit();
    }
}
?>
