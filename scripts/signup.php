<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (empty($username) || empty($email) || empty($password)) {
        echo "Todos os campos são obrigatórios!";
        exit;
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $db = new SQLite3('scripts/users.db');
    $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $passwordHash, SQLITE3_TEXT);
    
    if ($stmt->execute()) {
        echo "Utilizador registado com sucesso!";
    } else {
        echo "Erro ao registar o utilizador!";
    }
    $db->close();
}
?>

<form method="POST">
    <label for="username">Nome de utilizador:</label><br>
    <input type="text" name="username" id="username"><br><br>

    <label for="email">Email:</label><br>
    <input type="email" name="email" id="email"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password"><br><br>

    <button type="submit">Registar</button>
</form>
