<?php
// Pripojenie k databáze
$conn = new mysqli("localhost", "root", "", "mydatabase");
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Prosím, prihláste sa!");
}

$id = $_GET['id'];
$sql = "SELECT * FROM cars WHERE id='$id' AND user_id='".$_SESSION['user_id']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Nemáte oprávnenie upravovať toto auto.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "UPDATE cars SET make='$make', model='$model', year='$year', price='$price', description='$description' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Auto bolo úspešne aktualizované!";
    } else {
        echo "Chyba: " . $conn->error;
    }
}
?>
<form method="post">
    Značka: <input type="text" name="make" value="<?php echo $row['make']; ?>"><br>
    Model: <input type="text" name="model" value="<?php echo $row['model']; ?>"><br>
    Rok: <input type="text" name="year" value="<?php echo $row['year']; ?>"><br>
    Cena: <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
    Popis: <textarea name="description"><?php echo $row['description']; ?></textarea><br>
    <input type="submit" value="Aktualizovať">
</form>
