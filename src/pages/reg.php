<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="/styles/reg.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="container2">
        <div class=row2>
            <div class="regisztracio">
                <div class="font">Regisztráció</div>
                <form action="?currentPage=reg" method="post" autocomplete="off">
                    <label for="username">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" name="username" placeholder="felhasználónév" name="username" required>
                    <label for="jelszó">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" name="password" placeholder="jelszó" name="password" required>
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                    </label>
                    <input type="email" name="email" placeholder="email" name="email" required>
                    <input type="submit" value="Regisztáció">
                    <div class="link">
                        <p>Rendelkezel felhasználóval? <a href="?currentPage=login">Jelentkezz be !</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
$servername = $_ENV['HOST'];
$usr = $_ENV['USR'];
$pw = $_ENV['PW'];
$dbname = $_ENV['DBNAME'];


$con = new mysqli($servername, $usr, $pw, $dbname);
if ($con->connect_error) {
    die('Nem sikerült csatlakozni az adatbázishoz: ' . $con->connect_error);
}

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    exit('');
}

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

if (empty($username) || empty($password) || empty($email)) {
    exit('Kérlek tölts ki minden adatot');
}

if ($stmt = $con->prepare('SELECT id FROM users WHERE username = ?')) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'A felhasználónév foglalt, kérlek válassz másikat!';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if ($insert_stmt = $con->prepare("INSERT INTO users (email, pw, username) VALUES (?, ?, ?)")) {
            $insert_stmt->bind_param('sss', $email, $hashed_password, $username);
            if ($insert_stmt->execute()) {
                echo 'Sikeresen regisztráltál!';
            } else {
                echo 'Nem sikerült regisztrálni: ' . $insert_stmt->error;
            }
        } else {
            echo 'Nem sikerült előkészíteni a beszúrást: ' . $con->error;
        }
    }
} else {
    echo 'Nem sikerült előkészíteni a lekérdezést: ' . $con->error;
}

$con->close();
?>

</html>