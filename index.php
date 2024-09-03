<?php
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>

    <link rel="stylesheet" href="style-main.css">

</head>
<body>
    <div class="header">
        <h1><?php 
        if (isset($_GET["fraza"])){
            $fraza = $_GET["fraza"];
            echo "Wyszukiwanie: $fraza";}
        else if(isset($_GET["idKat"])){ 
            $idKat = $_GET["idKat"];
            $sql = "SELECT nazwa FROM kategorie WHERE id=$idKat";
            $result = $conn->query($sql);
            $row = $result->fetch_object();
            echo "{$row->nazwa}";
        } else{
            echo "Najnowsze posty";}?></h1>
    </div>

    <div class="content">
    <?php
    $sql = "SELECT id, nazwa FROM kategorie";
    $result = $conn->query($sql);
    echo "<p>Kategoria: <select name='kategorie' onchange='location = this.value;'></p>";
    echo "<option value='index.php'>Wszystkie</option>";
    
    while($row = $result->fetch_object()) {
        if($row->id == $idKat){
            echo "<option value='index.php?idKat={$row->id}' selected>{$row->nazwa}</option>";
        }
        else{
            echo "<option value='index.php?idKat={$row->id}'>{$row->nazwa}</option>";
        }
        
    }
    
    echo "</select>";
    ?>
    </div>

    <div class="grid-container">
        <?php
            $sql = "SELECT id, nazwa, obrazek, idUzytkownika FROM posty p";
            if (isset($_GET["idKat"])) {
            $idKat = $_GET["idKat"];
            $sql .= " WHERE idKategorii = $idKat";
            }
            elseif (isset($_GET["fraza"])) {
            $fraza = $_GET["fraza"];
            $sql .= " WHERE nazwa LIKE '%$fraza%'";
            }
            $sql .= " ORDER BY id DESC";

            $result = $conn->query($sql);

            $awatar = "awatar.jpg"; 

            if ($result->num_rows > 0) {
                while($row = $result->fetch_object()) {
                    $idUzytkownika = $row->idUzytkownika;
                    $sql = "SELECT login, awatar FROM uzytkownicy WHERE id=$idUzytkownika";
                    $objUzytkownik = $conn->query($sql)->fetch_object();
                    $nazwaUzytkownika = $objUzytkownik->login;
                    $awatar = $objUzytkownik->awatar;
                    echo "<div class='grid-item'>";
                    echo "<a href='details.php?id={$row->id}'><div class='gradient'><p>{$row->nazwa}</p>
                    <div class='profile-mini'>
                    <p> <img src='awatary/$awatar'>$nazwaUzytkownika</p>
                    </div>
                    </div></a>";
                    
                    if (mime_content_type("obrazki/{$row->obrazek}")=='video/mp4'){
                        echo"<video autoplay muted loop><source src='obrazki/{$row->obrazek}'>Twoja przeglądarka nie obsługuje filmów w technologii HTML5.</video>";
                    }
                    else{
                        echo "<img src='obrazki/{$row->obrazek}'>";
                    }
                    echo "</div>";
                }
            } else {
                echo "Nie masz żadnych postów w swojej kolekcji";
            }
            $conn->close();
        ?>
    </div>

</body>
</html>
