<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kapcsolat</title>
    <style>
        .error { color: red;
                position:relative;
                left:30px;
                font-size:12px;}
         
    </style>
    <link rel="stylesheet" type="text/css" href="styles/kapcsolat.css">
    <script src="/js/kapcsvalid.js"></script>
</head>
<body>
<div class="container">
    <h1>Kapcsolat</h1>
    <form id="kapcsolat" onsubmit="return validateForm()" method="post" action="/pages/phpval.php">
    <div class="col-75">    
    <label for="name">Név (minimum 8, maximum 20 betű):</label><br>
        <input type="text" id="name" name="name"><br>
        <span id="nameError" class="error"></span><br>
    </div>    
    <div class="col-75">
        <label for="email">E-mail (kötelező, maximum 40 karakter):</label><br>
        <input type="text" id="email" name="email"><br>
        <span id="emailError" class="error"></span><br>
    </div>    
    <div class="col-75">
        <label for="targy">Tárgy (kötelező, minimum 3, maximum 10 betű):</label><br>
        <input type="text" id="targy" name="targy"><br>
        <span id="targyError" class="error"></span><br>    
    </div>    
    <div class="col-75">
        <label for="uzenet">Üzenet (minimum 10 karakter maximum 50 karakter):</label><br>
        <textarea id="uzenet" name="uzenet"></textarea><br>
        <span id="uzenetError" class="error"></span><br>
    </div>
        <input id="kuld" type="submit" value="Küldés">
    </form>
</div>
</body>
</html>