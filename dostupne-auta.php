<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style1.css">
    <title>Dostupné autá</title>
</head>

<body>
<header>
    <a href="index.php">
        <img src="logo .jpg"  height="75px" width="105px" >
    </a>
    <h1 >Dostupné auta</h1>
    <nav style="top: auto;">
        <ul class="navbar-nav">
            <a class="nav-link" href="index.php">Domov</a></li>
            <a class="nav-link" href="dostupne-auta.php">Dostupné autá</a></li>
            <a class="nav-link" href="onas.php">O nás</a></li>
            <a class="nav-link" href="kontakt.php">KONTAKT</a></li>
        </ul>
    </nav>
</header>

<section>
    <h6>Dostupné autá</h6>


    <form method="GET" action="dostupne-auta.php">
        <label for="brand">Značka:</label>
        <select name="brand" id="brand">
            <option value="">Všetky</option>
            <?php
            require 'db.php';
            
         
            $sql = "SELECT DISTINCT make FROM cars";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["make"] . "'>" . $row["make"] . "</option>";
                }
            }
            ?>
        </select>
  
        
        <label for="price_order">Cena:</label>
        <select name="price_order" id="price_order">
            <option value="asc">Vzostupne</option>
            <option value="desc">Zostupne</option>
        </select>
        
        <input type="submit" value="Filtrovať">
    </form>


    <?php
  
    $sql = "SELECT * FROM cars";
    
 
    if(isset($_GET['brand']) && !empty($_GET['brand'])) {
        $brand = $_GET['brand'];
        $sql .= " WHERE make='$brand'";
    }
    
   
    $price_order = "asc";
    if(isset($_GET['price_order']) && !empty($_GET['price_order'])) {
        $price_order = $_GET['price_order'];
    }
    $sql .= " ORDER BY price $price_order";
    
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='car'>";
            echo "<img src='" . $row["image"] . "' alt='Auto " . $row["id"] . "'>";
            echo "<div>";
            echo "<h3><a href='car" . $row["id"] . ".php'>" . $row["make"] . " " . $row["model"] . "</a></h3>";
            echo "<p>Cena:" . $row["price"] . " €</p>";
            echo "<p>Rok vyroby:" . $row["year"] . " </p>";
           
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Nie sú k dispozícii žiadne autá.</p>";
    }
    $conn->close();
    ?>
</section>

<footer>
    <div class="col-25">
        <h3 class="footernadpis"> Tu sa nachádzame</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10614.839764656655!2d18.0910518!3d48.3084298!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xba2bad032d96b960!2sFakulta%20pr%C3%ADrodn%C3%BDch%20vied%20a%20informatiky!5e0!3m2!1ssk!2ssk!4v1669307792855!5m2!1ssk!2ssk" width="650" height="280" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
    </div>
    <div class="footermenu2">
        <h3 class="footernadpis">SLEDUJTE NÁS!</h3>
        <div class="footerikony">
            <o href="https://www.facebook.com/david.fagyas.3"><i class="fab fa-facebook-f"></i></o>
            <o href="https://www.instagram.com/_15david_/"><i class="fab fa-instagram"></i></o>  
        </div> 
    </div>
    <h3 class="footernadpis">Pripojte sa k Newsletteru</h3>  <br><br><br><br>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div id="goToTop" class="hore" onclick="scrollToTop()">
    <i class="fas fa-arrow-up"></i>
</div>
<script>showSlides();
    document.getElementById('goToTop').addEventListener('click', scrollToTop);
function scrollToTop() {
    window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
    });
 }</script>
</body>




</html>
