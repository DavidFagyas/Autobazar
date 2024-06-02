<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style1.css">
    <title>Pridať nové auto</title>
</head>

<body>
<header>
    <a href="index.php">
        <img src="logo .jpg"  height="75px" width="105px" >
    </a>
    <h1>Pridať nové auto</h1>
    <nav style="top: auto;">
        <ul class="navbar-nav">
            <li><a class="nav-link" href="index.php">Domov</a></li>
            <li><a class="nav-link" href="dostupne-auta.php">Dostupné autá</a></li>
            <li><a class="nav-link" href="onas.php">O nás</a></li>
            <li><a class="nav-link" href="kontakt.php">KONTAKT</a></li>
        </ul>
    </nav>
</header>

<section>
    <h3>Pridať nové auto</h3>

    <section id="new-car">
        <form action="add_car.php" method="post" enctype="multipart/form-data">
            <label for="make">Značka:</label>
            <input type="text" id="make" name="make" required><br>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required><br>

            <label for="year">Rok výroby:</label>
            <input type="text" id="year" name="year" required><br>

            <label for="price">Cena:</label>
            <input type="text" id="price" name="price" required><br>

            <label for="image">Výber obrázka:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br>

            <input type="submit" value="Pridať">
        </form>
    </section>
</section>

<footer>
    <div class="col-25">
        <h3>Tu nás nájdete</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10614.839764656655!2d18.0910518!3d48.3084298!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xba2bad032d96b960!2sFakulta%20pr%C3%ADrodn%C3%BDch%20vied%20a%20informatiky!5e0!3m2!1ssk!2ssk!4v1669307792855!5m2!1ssk!2ssk" width="650" height="280" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
    </div>
    <div class="footermenu2">
        <h3>Sledujte nás!</h3>
        <div class="footerikony">
            <a href="https://www.facebook.com/david.fagyas.3"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/_15david_/"><i class="fab fa-instagram"></i></a>  
        </div> 
    </div>
    <h3>Pripojte sa k odberu noviniek</h3><br><br><br><br>
    <div class="footermail">
        <input type="email" placeholder="ZADAJTE VÁŠ EMAIL"  class="footerinput"> <br>
        <button class="footerbtn">ODOSLAŤ</button>
    </div>
</footer>
<footer>
    <div class="footermenu2">
        <span class="autor">&copy;Dávid Fagyas, 2023.</span>
    </div>
</footer>


<?php
require 'db.php';
session_start();

// Spracovanie a uloženie do databázy
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];

    // Nahratie obrázka
    $target_dir = "Auta/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // SQL vloženie
    $sql = "INSERT INTO cars (make, model, year, price, image, user_id) 
            VALUES ('$make', '$model', '$year', '$price', '$target_file', '{$_SESSION['user_id']}')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Návrat na úvodnú stránku
        exit();
    } else {
        echo "Chyba pri pridávaní: " . $conn->error;
    }
}

$conn->close();
?>


</body>
</html>
