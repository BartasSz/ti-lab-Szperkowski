<?php
$firma = 'Szprycha';
$rok = date('Y');
$imie = htmlspecialchars($_GET['imie'] ?? 'Rowerzysto');


require 'baza.php';
$uslugi = $pdo->query('SELECT nazwa, cena FROM uslugi ORDER BY cena')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Szprycha - serwis rowerowy</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js" defer></script>

</head>
<body>
    <header class="site-header">
        <a class="logo" href="#">
    <svg viewBox="0 0 120 64" width="72" height="38" role="img" aria-labelledby="logo-tytul">
        <title id="logo-tytul">Szprycha</title>
        
        <!-- Przednie i tylne koło -->
        <circle cx="28" cy="42" r="18" fill="none" stroke="#4426FF" stroke-width="5"/>
        <circle cx="92" cy="42" r="18" fill="none" stroke="#4426FF" stroke-width="5"/>
        
        <!-- Dorysowana rama roweru z linii łamanej -->
        <polyline points="28,42 48,14 80,14 92,42" fill="none" stroke="#111" stroke-width="5"/>
        <polyline points="48,14 60,42 80,14" fill="none" stroke="#111" stroke-width="5"/>
    </svg>
    <span>Szprycha</span>
</a>
        <button class="menu-toggle">Menu</button>
        <nav class="menu">
            
            <a href="#uslugi">Usługi</a>
            <a href="#cennik">Cennik</a>
            <a href="#kontakt">Kontakt</a>
        </nav>
    </header>
    
    <main>
        <section id="uslugi">
         <div class="cards">
    <article class="card">
        <h3>Przegląd podstawowy</h3>
        <p>Regulacja hamulców i przerzutek.</p>
        <p class="card_price">od 120 zł</p>
    </article>
    
    <article class="card card--highlight">
        <h3>Przegląd rozszerzony</h3>
        <p>Najczęściej wybierane! Kompleksowy serwis.</p>
        <p class="card_price">od 200 zł</p>
    </article>
    
    <article class="card">
        <h3>Centrowanie koła</h3>
        <p>Wyrównanie naciągu szprych.</p>
        <p class="card_price">od 60 zł</p>
    </article>
</div>
        </section>
        
        <section id="cennik">
        <h2>Cennik</h2>
<table class="price-table">
    <thead>
        <tr>
            <th>Usługa</th>
            <th class="num">Cena</th>
        </tr>
    </thead>
    <tbody>
 <?php foreach ($uslugi as $usluga): ?>
        <tr>
            <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
            <td class="num"><?= $usluga['cena'] ?> zł</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
        </section>
    </main>
    
    <footer id="kontakt">
     <h2>Kontakt</h2>
<p>Pracownia Rowerowa Szprycha</p>
<p>Bydgoszcz, ul. Fordońska 123</p>
<p>Telefon: <a href="tel:+48500100200">500 100 200</a></p>
<p>E-mail: <a href="mailto:kontakt@szprycha.pl">kontakt@szprycha.pl</a></p>
<footer id="kontakt">
    <p>&copy; <?= $rok ?> <?= $firma ?></p>
</footer>
    </footer>
</body>
</html>
