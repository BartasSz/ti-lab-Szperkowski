<?php
require 'auth.php'; 
?>
<!DOCTYPE html>
<html lang="pl">
<body>
    <h2>Witaj w panelu, <?= htmlspecialchars($_SESSION['uzytkownik']) ?>!</h2>
    <a href="wyloguj.php">Wyloguj się</a>
</body>
</html>