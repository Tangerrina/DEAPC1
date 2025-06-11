<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    if (empty($nome) || empty($email) || empty($password) || empty($repeat_password)) {
        echo "<script>alert('Todos os campos devem ser preenchidos.'); window.history.back();</script>";
        exit();
    }

    if ($password !== $repeat_password) {
        echo "<script>alert('Credenciais inválidas! As senhas não coincidem.'); window.history.back();</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $db = new SQLite3('users.db');
    $stmt = $db->prepare("INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)");
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashed_password, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "<script>alert('Registo realizado com sucesso!'); window.location.href='login.html';</script>";
        exit();
    } else {
        echo "<script>alert('Erro ao registar usuário.'); window.history.back();</script>";
    }

    $db->close();
}
?>

