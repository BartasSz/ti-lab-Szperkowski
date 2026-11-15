<?php
// Tworzy nową instancję PDO wskazując na plik bazy w bieżącym katalogu
$pdo = new PDO('sqlite:' . __DIR__ . '/szprycha.sqlite');

// Konfiguracja raportowania błędów - wyjątki (exceptions) zatrzymają skrypt przy błędzie SQL
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Konfiguracja trybu pobierania danych - zwraca wiersze jako tablice asocjacyjne
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);