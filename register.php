<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style1.css">

    <title>Autobazár Dávid</title>
</head>
<body>
    <header>
        <a href="index.php">
            <img src="logo.jpg" height="75px" width="105px">
        </a>
        <h1>Prihlásenie</h1>
        <nav style="top: auto;">
            <ul class="navbar-nav">
                <li><a class="nav-link" href="index.php">Domov</a></li>
                <li><a class="nav-link" href="dostupne-auta.php">Dostupné autá</a></li>
                <li><a class="nav-link" href="onas.php">O nás</a></li>
                <li><a class="nav-link" href="kontakt.php">KONTAKT</a></li>
            </ul>
        </nav>
    </header>
    <?php





require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password != $confirm_password) {
        echo "Heslá sa nezhodujú!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registrácia úspešná!";
            header("Location: login.php");  
        } else {
            echo "Chyba: " . $conn->error;
        }
    }
}
?>

<form method="post">
    Používateľské meno: <input type="text" name="username" required><br>
    Heslo: <input type="password" name="password" required><br>
    Potvrdenie hesla: <input type="password" name="confirm_password" required><br>
    <input type="submit" value="Registrovať sa">
</form>
