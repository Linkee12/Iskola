document.getElementById("kapcsolat").addEventListener("submit", function(event) {
    var isValid = validateForm();
    if (!isValid) {
        event.preventDefault(); // Megakadályozza az űrlap elküldését, ha nem megfelelőek az adatok
    }
});
function validateForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var targy = document.getElementById("targy").value;
    var uzenet = document.getElementById("uzenet").value;
    var isValid = true;

    var namePattern = /^[A-Za-z]{8,20}$/;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (name === "" || !name.match(namePattern)) {
        document.getElementById("nameError").innerHTML = "Név megadása kötelező, 8-20 karakter hosszúnak kell lennie!";
        isValid = false;
    } else {
        document.getElementById("nameError").innerHTML = "";
    }

    if (email === "" || email.length > 40 || !email.match(emailPattern)) {
        document.getElementById("emailError").innerHTML = "Érvényes e-mail cím megadása kötelező, maximum 40 karakter hosszúságban!";
        isValid = false;
    } else {
        document.getElementById("emailError").innerHTML = "";
    }

    if (targy === "" || targy.length < 3 || targy.length > 10) {
        document.getElementById("targyError").innerHTML = "Tárgy megadása kötelező, minimum 3, maximum 10 karakter hosszúságú lehet!";
        isValid = false;
    } else {
        document.getElementById("targyError").innerHTML = "";
    }

    if (uzenet === "" || uzenet.length < 10 || uzenet.length >50) {
        document.getElementById("uzenetError").innerHTML = "Üzenet megadása kötelező, legalább 10 legfeljebb 50 karakter";
        isValid = false;
    } else {
        document.getElementById("uzenetError").innerHTML = "";
    }
    
    return isValid;
}
