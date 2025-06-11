<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    if (empty($nome) || empty($email) || empty($password) || empty($repeat_password)) {
        die("Todos os campos devem ser preenchidos.");
    }

    if ($password !== $repeat_password) {
        die("As senhas não coincidem.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $db = new SQLite3('users.db');

    $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashed_password, SQLITE3_TEXT);

    $resultado = $stmt->execute();

    if ($resultado) {
        header("Location: login.html");
        exit();
    } else {
        echo "Erro ao registar usuário.";
    }

    $db->close();
}
?>
