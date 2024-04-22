<?php
session_start();
$servername = $_ENV['HOST'];
$usr = $_ENV['USR'];
$pw = $_ENV['PW'];
$dbname = $_ENV['DBNAME'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Nem sikerült csatlakozni az adatbázishoz: " . $conn->connect_error);
}

$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $targy = test_input($_POST["targy"]);
    $uzenet = test_input($_POST["uzenet"]);
    $sender = isset($_SESSION['username']) ? $_SESSION['username'] : "Vendég";

    if (empty($name) || !preg_match('/^[A-Za-z]{8,20}$/', $name)) {
        $errors['name'] = "Kötelező, 8-20 karakter hosszúnak kell lennie!";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 40) {
        $errors['email'] = "Helytelen vagy üres email!";
    }

    if (empty($targy) || strlen($targy) < 3 || strlen($targy) > 10) {
        $errors['targy'] = "Kötelező , Rövid vagy hosszú tárgy!";
    }

    if (empty($uzenet) || strlen($uzenet) < 10) {
        $errors['uzenet'] = "Üzenet megadása kötelező, túl rövid üzenet!";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO messages (name, email, subject, message, sender) VALUES ('$name', '$email', '$targy', '$uzenet', '$sender')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['targy'] = $_POST['targy'];
            $_SESSION['uzenet'] = $_POST['uzenet'];
            
            header("Location: /?currentPage=siker");
            exit(); // Biztosítsd, hogy a további kód ne fusson le
        } else {
            echo "Hiba történt az adatok rögzítésekor: " . $conn->error;
        }
    } 
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>