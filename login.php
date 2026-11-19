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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logowanie - Szprycha</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          integrity="sha384-QWTKZyjpPEjISv5WaRU90FeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 400px;">
        <h2 class="mb-3">Logowanie do CMS</h2>
        <?php if (!empty($blad)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($blad) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Login</label>
                <input type="text" name="login" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hasło</label>
                <input type="password" name="haslo" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Zaloguj</button>
        </form>
    </div>
</body>
</html>