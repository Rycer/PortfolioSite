<?php
require ("session.php");
require("db.php");

$idAutora = $_REQUEST["idObserwowanego"];
$idUzytkownika = $_SESSION["id"];

$sql = "SELECT id FROM obserwowani WHERE idUzytkownika = $idUzytkownika AND idObserwowanego = $idAutora";
$result = $conn->query($sql);;

if ($result->num_rows == 1) {
    $id = $result->fetch_object()->id;
    $sql = "DELETE FROM obserwowani WHERE id = $id";
} else {
    $sql = "INSERT INTO obserwowani (idUzytkownika, idObserwowanego) VALUES ($idUzytkownika, $idAutora)";
}

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    echo "sukces";
}

$conn->close();
?>
