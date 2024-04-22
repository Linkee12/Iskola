<?php

$servername = $_ENV['HOST'];
$usr = $_ENV['USR'];
$pw = $_ENV['PW'];
$dbname = $_ENV['DBNAME'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Nem sikerült csatlakozni az adatbázishoz: " . $conn->connect_error);
}

$sql = "SELECT * FROM messages ORDER BY creation_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/styles/uzenetek.css">
</head>

<body class="container">
    <div class="containeru">
        <h3>
            Üzenetek
        </h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Név</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tárgy</th>
                    <th scope="col">Üzenet</th>
                    <th scope="col">Létrehozás dátuma</th>
                    <th scope="col">Küldte</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ellenőrizd, hogy a lekérdezés sikeres volt-e
                if ($result->num_rows > 0) {
                    // Minden sor megjelenítése a táblázatban
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['subject'] . "</td>";
                        echo "<td>" . $row['message'] . "</td>";
                        echo "<td>" . $row['creation_date'] . "</td>";
                        echo "<td>" . $row['sender'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>