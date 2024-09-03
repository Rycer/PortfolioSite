<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie...</title>
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "portfolio");
    $nazwa = $_POST["nazwa"];
    $opis = $_POST["opis"];
    $idKat = $_POST["idKategorii"];
    $idUzyt = $_POST["idUzytkownika"];
    $obrazek = basename($_FILES["obrazek"]["name"]);
    move_uploaded_file($_FILES["obrazek"]["tmp_name"], "obrazki/$obrazek");


    $sql = "INSERT INTO posty (nazwa, obrazek, idKategorii, idUzytkownika, opis) VALUES ('$nazwa', '$obrazek', '$idKat', '$idUzyt', '$opis')";
    $conn->query($sql);

    $conn->close();
    header("Location: index.php");
    ?>
</body>
</html>