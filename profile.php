<?php
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $idUzytkownika = $_GET["id"];
        $sql = "SELECT login, awatar, opis FROM uzytkownicy WHERE id = $idUzytkownika";
        $row = $conn->query($sql)->fetch_object();
        $nazwa = $row->login;
        echo "<title>Profil $nazwa</title>";
    ?>
    <link rel="stylesheet" href="style-main.css">
</head>
<body>
    <?php
    echo "<div class='profile-big'>";
    echo "<img src='awatary/$row->awatar'>";
    echo "<h1>$nazwa</h1>";
    echo "<p>$row->opis</p>";
    if($idUzytkownika==$_SESSION["id"] || $rolaZalogowanego == "admin"){
        echo "<div class='managementBtns'>";
        echo "<a href='updateProfileForm.php?id=$idUzytkownika'><button id='edit' style='margin: 5px;'>Edytuj profil</button></a>";
        echo "<a href='deleteProfile.php?id=$idUzytkownika'><button id='delete'>Usuń profil</button></a>";
        echo "</div>";
    }else{
        require("followBtn.php");
    }

    if($idUzytkownika!=$_SESSION["id"] && $rolaZalogowanego == "admin"){
        require("followBtn.php");
    }

    echo "</div>";
    ?>

    <h1 class="content">Posty</h1>
    <div class="grid-container">
        <?php
            $sql = "SELECT id, nazwa, obrazek FROM posty WHERE idUzytkownika = $idUzytkownika";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_object()) {
                    echo "<div class='grid-item'>";
                    echo "<a href='details.php?id={$row->id}'><div class='gradient'><p>{$row->nazwa}</p></div></a>";
                    if (mime_content_type("obrazki/{$row->obrazek}")=='video/mp4'){
                        echo"<a href='details.php?id={$row->id}'><video autoplay muted loop><source src='obrazki/{$row->obrazek}'>Twoja przeglądarka nie obsługuje filmów w technologii HTML5.</video></a>";
                    }
                    else{
                        echo "<img src='obrazki/{$row->obrazek}'>";
                    }
                    echo "</div>";
                }
            } else {
                echo "Nie masz żadnych postów w swojej kolekcji.";
            }
        ?>
    </div>
    
    <?php
    $conn->close();
    ?>
</body>
</html>