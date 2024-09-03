<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktualizowanie...</title>
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "portfolio");
    $id = $_POST["id"];
    $sql = "SELECT obrazek FROM posty WHERE id=$id";
    $result = $conn->query($sql)->fetch_object();
    $nazwa = $_POST["nazwa"];
    $opis = $_POST["opis"];
    $idKat = $_POST["idKategorii"];
    $obrazek = $_POST["obrazek"];
    $tmpObrazek = $result->obrazek;

    if($_FILES['obrazek']['tmp_name'] == null){
        $obrazek = $tmpObrazek;
    } else {
    $obrazek = basename($_FILES["obrazek"]["name"]);
    move_uploaded_file($_FILES["obrazek"]["tmp_name"], "obrazki/$obrazek");
    }

    $sql = "UPDATE posty SET nazwa='$nazwa', opis='$opis', idKategorii='$idKat', obrazek='$obrazek' WHERE id=$id";
    $conn->query($sql);

    $conn->close();
    header("location: details.php?id=$id");
    ?>
</body>
</html>