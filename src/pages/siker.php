<?php
session_start(); 
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];


if (empty($errors)) {
    
    $uzenet = isset($_SESSION['uzenet']) ? $_SESSION['uzenet'] : '';
    $targy = isset($_SESSION['targy']) ? $_SESSION['targy'] : '';
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
    
    // Eltávolítjuk az adatokat a session-ből, hogy ne jelenjenek meg újra a frissítés során
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['targy']);
    unset($_SESSION['uzenet']);
} else {
    // Ha van hiba, töröljük az adatokat a session-ből
    unset($_SESSION['errors']);
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/styles/siker.css">
</head>
<body>
<div class="container">
        <h1>Sikeres üzenetküldés!</h1>
        <?php if (empty($errors)): ?>
            <p class="success">Üzenet: <?php echo $uzenet; ?></p>
            <p class="success">Tárgy: <?php echo $targy; ?></p>
            <p class="success">Email: <?php echo $email; ?></p>
            <p class="success">Név: <?php echo $name; ?></p>
        <?php else: ?>
            <p class="error">Hiba történt a feldolgozás során.</p>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li class="error"><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?> 
</div>
</body>
</html>