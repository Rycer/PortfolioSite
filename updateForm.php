<!DOCTYPE html>
<html lang="pl">

<?php
require("navbar.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj post</title>
    <link rel="stylesheet" href="style-main.css">
    <link rel="stylesheet" href="style-form.css">
</head>
<body>
    
    <?php
    $id = $_GET["id"];
    ?>

    <div class="header">
    <h1>Zaktualizuj post</h1> 
    </div>

    <div class="content">
    
    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value=<?php echo "'$id'";?>>

        <?php
        $conn = new mysqli("localhost", "root", "", "portfolio");
        $sql = "SELECT nazwa, opis, idKategorii FROM posty WHERE id=$id";
        $row = $conn->query($sql)->fetch_object();
        $nazwa = $row->nazwa;
        $opis = $row->opis;
        $idKat = $row->idKategorii;
        ?>

        <label for="nazwa">Nazwa postu:</label><br>
        <input type="text" id="nazwa" class="input" name="nazwa" value=<?php echo "'$nazwa'";?>><br>

        <label for="opis">Opis postu:</label><br>
        <textarea name="opis" cols="50" rows="10"><?php echo "$opis";?></textarea>
        <br>

        <p>Obrazek: <input type="file" name="obrazek"></p>

        <p>
            Kategoria: <select name="idKategorii" >
            <?php
                
                $sql = "SELECT id, nazwa FROM kategorie";
                $result = $conn->query($sql);
                
                while($row = $result->fetch_object()) {
                    if($row->id == $idKat){
                        echo "<option value='{$row->id}' selected>{$row->nazwa}</option>";
                    }
                    else{
                        echo "<option value='{$row->id}'>{$row->nazwa}</option>";
                    }
                }
                $conn->close();
            ?>
            </select>
        </p>

        <input type="submit" id="submit" value="Aktualizuj post">
    </form> 
    <br>
    <a href="index.php">Anuluj</a>
    </div>
</body>
</html>