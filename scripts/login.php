<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $email = $_POST['email'];
    $password = $_POST['password'];
    $db = new SQLite3('scripts/users.db');
    $stmt = $db->prepare("SELECT id, username, password FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo "Login bem-sucedido! Bem-vindo, " . $user['username'];
    } else {
        echo "Email ou password incorretos!";
    }
    $db->close();
}
?>
<form method="POST">
    <label for="email">Email:</label><br>
    <input type="email" name="email" id="email"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password"><br><br>

    <button type="submit">Login</button>
</form>
