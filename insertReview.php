<?php
require ("session.php");
require("db.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie komentarza...</title>
</head>
<body>
    <?php
    $id = $_POST["post_id"];
    $tresc = $_POST["komentarz"];
    

    $sql = "INSERT INTO komentarze (idPostu, nick, tresc) VALUES ('$id', '$login', '$tresc')";
    $conn->query($sql);

    $conn->close();
    header("Location: details.php?id=$id");
    ?>
</body>
</html>