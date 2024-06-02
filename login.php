<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style1.css">
    <title>Autobazár David</title>

    
</head>

<header>
    
    <a href="index.php">
        <img src="logo .jpg"  height="75px" width="105px" >
      </a>
    <h1 >Kontakt</h1>
    <nav style="top: auto;">
        <ul class="navbar-nav">
            <a class="nav-link" href="index.php">Domov</a></li>
            <a class="nav-link" href="dostupne-auta.php">Dostupné autá</a></li>
            <a class="nav-link" href="onas.php">O nás</a></li>
            <a class="nav-link" href="kontakt.php">KONTAKT</a></li>
        </ul>
    </nav>
</header>
    <?php


require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['is_admin'] = $row['is_admin']; 
            header("Location: admin.php"); 
        } else {
            echo "Nesprávne heslo!";
        }
    } else {
        echo "Používateľ neexistuje!";
    }
}
?>

<form method="post">
    Používateľské meno: <input type="text" name="username"><br>
    Heslo: <input type="password" name="password"><br>
    <input type="submit" value="Prihlásiť sa">
</form>
