<?php
require 'baza.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $z = $pdo->prepare('SELECT login, haslo_hash FROM uzytkownicy WHERE login = :login');
    $z->execute(['login' => trim($_POST['login'] ?? '')]);
    $u = $z->fetch();

    
    if ($u && password_verify($_POST['haslo'] ?? '', $u['haslo_hash'])) {
        session_regenerate_id(true); 
        $_SESSION['uzytkownik'] = $u['login']; 
        header('Location: admin.php'); 
        exit;
    }
    $blad = 'Błędny login lub hasło.'; 
}
?>
<!DOCTYPE html>
<html lang="pl">
<!-- Tutaj dodaj prosty formularz HTML z method="post", polami input (name="login", name="haslo") oraz wyświetlaniem zmiennej $blad -->
<body>
    <form method="post">
        <h2>Logowanie do CMS</h2>
        <?php if (!empty($blad)) echo "<p style='color:red;'>$blad</p>"; ?>
        <input type="text" name="login" placeholder="Login" required>
        <input type="password" name="haslo" placeholder="Hasło" required>
        <button type="submit">Zaloguj</button>
    </form>
</body>
</html>