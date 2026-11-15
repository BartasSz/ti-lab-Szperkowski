<?php
require 'baza.php';


$pdo->exec('CREATE TABLE IF NOT EXISTS uslugi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nazwa TEXT NOT NULL,
    cena INTEGER NOT NULL
)');


$pdo->exec('CREATE TABLE IF NOT EXISTS uzytkownicy (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login TEXT NOT NULL UNIQUE,
    haslo_hash TEXT NOT NULL
)');


$pdo->exec('DELETE FROM uslugi');

// Wprowadzanie (INSERT) 4 początkowych usług
$pdo->exec("INSERT INTO uslugi (nazwa, cena) VALUES 
    ('Przegląd podstawowy', 120),
    ('Przegląd rozszerzony', 200),
    ('Centrowanie koła', 60),
    ('Wymiana dętki', 30)
");

 
$z = $pdo->prepare('INSERT INTO uzytkownicy (login, haslo_hash) VALUES (:login, :hash)');
$z->execute([
    'login' => 'admin',
    'hash' => password_hash('TwojeHaslo', PASSWORD_DEFAULT) 
]);

echo "Baza gotowa.\n";

