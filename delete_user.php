<?php
require 'db.php';
session_start();

// Kontrola, či je používateľ prihlásený a či je administrátor
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    die("Nemáte oprávnenie na zobrazenie tejto stránky.");
}

$id = $_GET['id'];

// Kontrola, či sa používateľ nesnaží vymazať sám seba
if ($id == $_SESSION['user_id']) {
    die("Nemôžete vymazať sám seba.");
}

// Vymazanie používateľa
$sql = "DELETE FROM users WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    echo "Používateľ bol úspešne vymazaný.";
} else {
    echo "Chyba: " . $conn->error;
}

// Návrat na administrátorskú stránku
header("Location: admin.php");
?>
