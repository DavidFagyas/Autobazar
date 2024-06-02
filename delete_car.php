<?php
require 'db.php';
session_start();

// Kontrola, či je používateľ prihlásený a či je administrátor
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    die("Nemáte oprávnenie na zobrazenie tejto stránky.");
}

$id = $_GET['id'];

// Vymazanie auta
$sql = "DELETE FROM cars WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    echo "Auto bolo úspešne vymazané.";
} else {
    echo "Chyba: " . $conn->error;
}

// Návrat na administrátorskú stránku
header("Location: admin.php");
?>
