<?php
// 1. Zabezpieczenie dostępu i połączenie z bazą
require 'auth.php'; 
require 'baza.php';

// 2. Obsługa żądań POST (Dodawanie usługi)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $akcja = $_POST['akcja'] ?? '';

    if ($akcja === 'dodaj') {
        // Oczyszczenie i rzutowanie typów zmiennych wejściowych
        $nazwa = trim($_POST['nazwa'] ?? '');
        $cena = (int)($_POST['cena'] ?? 0);

        // Walidacja po stronie serwera
        if ($nazwa !== '' && $cena > 0) {
            // Prepared Statement chroniący przed SQL Injection
            $z = $pdo->prepare('INSERT INTO uslugi (nazwa, cena) VALUES (:nazwa, :cena)');
            $z->execute(['nazwa' => $nazwa, 'cena' => $cena]);
            
            // Przekierowanie Location przerywa żądanie POST i wymusza ponowne załadowanie strony metodą GET
            header('Location: admin.php?ok=dodano');
            exit;
        }
    }
}

// 3. Pobranie zaktualizowanej listy usług do wygenerowania widoku HTML
$uslugi = $pdo->query('SELECT id, nazwa, cena FROM uslugi ORDER BY nazwa')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel CMS</title>
</head>
<body>
    <h2>Witaj, <?= htmlspecialchars($_SESSION['uzytkownik']) ?>!</h2>
    <a href="wyloguj.php">Wyloguj się</a>

    <!-- Komunikat po udanym przekierowaniu PRG -->
    <?php if (isset($_GET['ok']) && $_GET['ok'] === 'dodano'): ?>
        <p style="color: green; font-weight: bold;">Usługa została poprawnie dodana.</p>
    <?php endif; ?>

    <!-- Formularz wysyłający metodę POST do tego samego pliku -->
    <hr>
    <h3>Dodaj nową usługę</h3>
    <form method="post">
        <!-- Ukryte pole definiujące akcję dla backendu -->
        <input type="hidden" name="akcja" value="dodaj">
        
        <label for="nazwa">Nazwa:</label>
        <input id="nazwa" name="nazwa" required maxlength="100">
        
        <label for="cena">Cena (zł):</label>
        <input id="cena" name="cena" type="number" min="1" required>
        
        <button type="submit">Dodaj</button>
    </form>

    <hr>
    <!-- Generowanie tabeli HTML na podstawie danych zwróconych przez PDO -->
    <h3>Lista usług w bazie</h3>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($uslugi as $usluga): ?>
                <tr>
                    <td><?= $usluga['id'] ?></td>
                    <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                    <td><?= $usluga['cena'] ?> zł</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>