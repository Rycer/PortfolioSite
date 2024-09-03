<?php
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje recenzje</title>
    <link rel="stylesheet" href="style-main.css">
</head>
<body>
    <?php
    $sql = "SELECT ocena, tresc, data, d.id AS idPostu, nazwa FROM recenzje r, posty d WHERE d.id = idPostu AND nick = '$login'";
    $result = $conn->query($sql);

    while($row = $result->fetch_object()) {
        echo "<div>";
        echo "<p>Data: {$row->data}</p>";
        echo "<p>Nazwa dzbana: {$row->nazwa}</p>";
        echo "<p>Treść: {$row->tresc}</p>";
        echo "<p>Ocena: {$row->ocena}</p>";
        echo "</div> <br>";
    }
    
    $conn->close();

    ?>
    
</body>
</html>