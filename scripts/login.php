<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $db = new SQLite3('scripts/users.db');
    $stmt = $db->prepare("SELECT id, email, password FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if (!$user) {
        // Se não existir usuário com este email, cria um novo
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashed_password, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo "<script>alert('Registro realizado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao criar usuário.'); history.back();</script>";
            exit();
        }
    } else {
        // Se o usuário já existir, verifica a senha
        if (password_verify($password, $user['password'])) {
            echo "<script>alert('Login bem-sucedido!');</script>";
        } else {
            echo "<script>alert('Email ou senha incorretos!'); history.back();</script>";
            exit();
        }
    }

    $db->close();
}
?>
