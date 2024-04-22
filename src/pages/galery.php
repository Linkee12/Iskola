<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/galery.css">
    <title>Galery</title>
</head>

<body>
    <div class="mainContainer">
        <div class="upload">
            <h1>Kép feltöltése:</h1>
            <?php if (isset ($_SESSION['loggedin'])) {
                echo '
             <form action="?currentPage=galery" method="post" enctype="multipart/form-data">
                <label for="file-upload" class="fileUpload">+
                </label>
                <input id="file-upload" type="file" style="display:none;" onchange="showFileName(this)"
                    name="fileToUpload" id="fileToUpload">
                <input id="up" type="submit"
                    style="padding-left: 0.1rem; border-radius:0.3rem; padding-top: 0.4rem; background-color:rgb(24, 40, 77); font-size: 2rem; width: 8.3rem;"
                    value="Feltöltés" name="submit" onMouseOver="this.style.backgroundColor="rgb(36, 23, 121)""
                    onMouseLeave="this.style.backgroundColor="rgb(24, 40, 77)"">
                <div id="file-name">
                </div>
                <script>
                    function showFileName(input) {
                        var fileName = input.files[0].name;
                        document.getElementById("file-name").innerHTML = "Kiválasztott fájl: " + fileName;
                    }
                </script>
            </form>';
            }else{
                echo '<div class="paragraph"> A feltöltéshez be kell jelentkezned! </div>';
            }
            ; ?>
            <?php
            $message = "";
            $avaliableFiles = array("image/jpg", "image/jpeg", "image/png");
            if (isset($_POST["submit"])) {
                $target_dir = "./pages/galery/";
                $target_file = $target_dir . basename(uniqid() . "." . explode("/", $_FILES["fileToUpload"]["type"])[1]);
                if (file_exists($target_file)) {
                    $message = "A fájl már létezik.";
                } else if (!in_array($_FILES["fileToUpload"]["type"], $avaliableFiles)) {

                    $message = "Csak JPG JPEG és PNG fájlok tölthetők fel";
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                        $message = "A fájl (" . basename($_FILES["fileToUpload"]["name"]) . ") sikeresen feltöltve.";
                    } else {
                        $message = "Hiba történt a feltöltés közben.";
                    }
                }

            }

            echo '<div class="message">' .$message.'</div>';
            ?>

        </div>
        <div class="images">
            <?php

            $dir = './pages/galery';
            $arrayOfDir = scandir($dir);
            for ($i = 2; $i < count($arrayOfDir); $i++) {
                $name = explode('.', $arrayOfDir[$i])[0];
                echo '<div class="imagesContainer"><a href="/pages/galeryFullSize.php?active='.$i.'"> <img src="./pages/galery/'. $arrayOfDir[$i] .'" 
                    alt="' .$arrayOfDir[$i]. '"></img></a><div class=label>' . $name .'
                    </div></div>';
            }
            ?>
        </div>
    </div>
</body>

</html>