<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    // Se algum campo estiver vazio, exibe alerta e impede envio
    if (empty($nome) || empty($email) || empty($password) || empty($repeat_password)) {
        echo "<script>alert('Todos os campos devem ser preenchidos!'); window.history.back();</script>";
        exit();
    }

    // Se as senhas não coincidirem, exibe alerta e impede envio
    if ($password !== $repeat_password) {
        echo "<script>alert('Credenciais inválidas! As senhas não coincidem.'); window.history.back();</script>";
        exit();
    }

    // Protege a senha antes de salvar
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Conecta ao banco de dados
    $db = new SQLite3('users.db');
    $stmt = $db->prepare("INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)");
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashed_password, SQLITE3_TEXT);

    // Insere no banco e redireciona apenas se o registro for bem-sucedido
    if ($stmt->execute()) {
        echo "<script>alert('Registo realizado com sucesso!'); window.location.href='login.html';</script>";
        exit();
    } else {
        echo "<script>alert('Erro ao registar usuário.'); window.history.back();</script>";
        exit();
    }

    $db->close();
}
?>

