<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuwanie...</title>
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "portfolio");
    $id = $_GET["id"];

    $sql = "SELECT obrazek FROM posty WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_object();

    unlink("obrazki/{$row->obrazek}");

    $sql = "DELETE FROM posty WHERE id=$id";
    $conn->query($sql);

    $conn->close();
    header("Location: index.php");
    ?>
</body>
</html>