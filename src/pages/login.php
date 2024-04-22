<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf8">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="/styles/login.css" rel="stylesheet" type="text/css">
</head>
<style>
    .piros {
        color: red;
    }
</style>

<body>
    <div class="container">
        <div class=row>
            <div class="loginx">
                <div class="font2">Bejelentkezés</div>
                <form action="?currentPage=login" method="post">
                    <label for="username">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" name="username" placeholder="felhasználónév" name="username" required>
                    <label for="jelszó">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" name="password" placeholder="jelszó" name="password" required>
                    <input type="submit" value="Bejelentkezés">
                    <div class="link">
                        <p>Nem vagy még felhasználó? <a href="?currentPage=reg">Regisztrálj!</a></p>
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
if (!$con) {
    exit('Nem sikerült csatlakozni az adatbázishoz!: ' . mysqli_connect_error());
}
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
if (empty($username) || empty($password)) {
    echo isset($_POST['username']);
    exit('');
}

if ($stmt = $con->prepare('SELECT id, pw FROM users WHERE username = ?')) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $stored_password);
        $stmt->fetch();


        if (password_verify($password, $stored_password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            echo 'Üdvözöllek újra itt ' . htmlspecialchars($_SESSION['name'], ENT_QUOTES) . '!';
            echo $_SESSION['loggedin'];
            header("Location: ?currentPage=home");
        } else {
            // Helytelen jelszó
            echo "<span class='piros'> Hiba: Helytelen felhasználónév vagy jelszó </span>";

        }
    } else {
        // Helytelen felhasználónév

        echo "<span class='piros'> Hiba: Helytelen felhasználónév vagy jelszó</span>";
    }
    $stmt->close();
} else {
    echo 'Sikertelen adatbázis lekérdezés';
}

$con->close();
?>


</html>