<?php
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witaj!</title>

    <link rel="stylesheet" href="style-main.css">

</head>
<body>
    <div class="header">
        <h1>Polubione posty</h1>
    </div>

    <div class="grid-container">
        <?php
            $idUzytkownika = $idZalogowanego;
            $sql = "SELECT p.id, p.nazwa, p.obrazek, p.idUzytkownika FROM posty p, ulubione u WHERE u.idPostu = p.id AND u.idUzytkownika = $idUzytkownika";
            
            $result = $conn->query($sql);
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
                echo "Użytkownik nie polubił żadnych postów.";
            }
            $conn->close();
        ?>
    </div>

</body>
</html>
