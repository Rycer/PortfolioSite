<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require("db.php");

$login = $_SESSION["login"];
$idZalogowanego = $_SESSION["id"];

$sql = "SELECT rola FROM uzytkownicy WHERE id=$idZalogowanego";
$result = $conn->query($sql)->fetch_object();
$rolaZalogowanego = $result->rola;

?>