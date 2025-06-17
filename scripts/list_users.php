<?php
$db = new SQLite3('users.db');
$result = $db->query("SELECT id, nome, email FROM users");

echo "<h2>Lista de Utilizadores</h2>";
echo "<table border='1'><tr><th>ID</th><th>Nome</th><th>Email</th></tr>";
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr><td>{$row['id']}</td><td>{$row['nome']}</td><td>{$row['email']}</td></tr>";
}
echo "</table>";
echo '<a href="register.html">Voltar ao registo</a>';
?>