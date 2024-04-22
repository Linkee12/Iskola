<?php session_start() ?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Menü mesterek</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Madimi One">
    <?php include ("./template.php") ;
    $_ENV = parse_ini_file('.env');
    ?>
</head>

<body>
    <header class="fejlec">
        <img src="marka.png" alt="logo" width="200" height="200" id="marka" />
        <br>
        <h2>Rendelésfelvétel: Kedd - Szombat: 10:00 - 21:00-ig &emsp; Tel: +36 76/123-456</h2>
        <?php
        if(isset($_SESSION["loggedin"])) {
        echo'<div>Bejelentkezve: '.$_SESSION["username"].' </div>';}
        ?>
        <hr>
    </header>
    <div id="csomag">
        <aside id="nav">
            <nav>
                <ul>
                    <?php
                    $currentPage = "home";
                    if (isset ($_GET['currentPage'])) {
                        $currentPage = $_GET['currentPage'];
                    }

                    foreach ($navigation as $item) {
                        if ($item['isLoggedIn'][0] == 1 && !isset ($_SESSION["loggedin"])) {
                            ?>
                            <li class="<?php echo $item['file']; ?>">
                                <a href="?currentPage=<?php echo $item['file']; ?>">
                                    <?php echo $item['show']; ?>
                                </a>
                            </li>
                            <?php
                        } else if ($item['isLoggedIn'][1] == 1 && isset ($_SESSION["loggedin"])) {
                            ?>
                                <li class="<?php echo $item['file']; ?>">
                                    <a href="?currentPage=<?php echo $item['file']; ?>">
                                    <?php echo $item['show']; ?>
                                    </a>
                                </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </nav>
        </aside>
        <br>
        <br>
        <br>
        <br>
        <div id="content">

            <?php include ("./pages/" . $currentPage . ".php"); ?>
        </div>
    </div>
    <br>
    <footer class="footer"><b>" A filozófiám alapja "cogito ergo sum" - gondolkodni és létezni viszont csak akkor tudok,
            ha
            jóllakott vagyok."
            <i>Bud Spencer</i></b>
    </footer>
</body>

</html>