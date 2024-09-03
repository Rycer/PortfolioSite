<?php
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wstaw post</title>
    <link rel="stylesheet" href="style-main.css">
    <link rel="stylesheet" href="style-form.css">
</head>
<body>
    <div class="header">

    <h1>Wstaw post</h1>

</div>

<div class="content">

    <form action="insert.php" method="post" enctype="multipart/form-data">
        <?php
         $idUzytkownika = $_SESSION["id"];
            echo "<input type='hidden' name='idUzytkownika' value='$idUzytkownika'>";
        ?>
        <label for="nazwa">Nazwa postu:</label><br>
        <input type="text" id="nazwa" class="input" name="nazwa" value="Nazwa"><br>

        <label for="opis">Opis postu:</label><br>
        <textarea name="opis" cols="50" rows="10" class="textarea"></textarea>
        <br>

        <p>Obrazek: <input type="file" name="obrazek"></p>

        <p>
            Kategoria: <select name="idKategorii" >
            <?php
                $conn = new mysqli("localhost", "root", "", "portfolio");
                $sql = "SELECT id, nazwa FROM kategorie";
                $result = $conn->query($sql);

                while($row = $result->fetch_object()) {
                echo "<option value='{$row->id}'>{$row->nazwa}</option>";
                }
                $conn->close();
            ?>
            </select>
        </p>

        <input type="submit" id="submit" value="Dodaj post">
    </form> 
    <br>    
    <a href="index.php">Anuluj</a>
</div>
</body>
</html>
