<?php
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-main.css">
    <link rel="stylesheet" href="style-details.css">

    <?php
        $id = $_GET["id"];
        $sql = "SELECT idKategorii, k.nazwa AS nazwaKat, p.nazwa, obrazek, p.opis, p.idUzytkownika, p.data FROM posty p, kategorie k WHERE p.id=$id AND idKategorii=k.id";

        $result = $conn->query($sql);

        $row = $result->fetch_object();
        echo "<title>$row->nazwa</title>"
    ?>   
    
</head>
<body>
    <div class="content">
    <details-container>
        <details-media>
            <?php
                if (mime_content_type("obrazki/{$row->obrazek}")=='video/mp4'){
                    echo"<video controls autoplay muted loop><source src='obrazki/{$row->obrazek}'>Twoja przeglądarka nie obsługuje filmów w technologii HTML5.</video>";
                }
                else{
                echo "<img src='obrazki/{$row->obrazek}'>";
                }
            ?>
        </details-media>

        <details-desc>
        <?php
            $sql = "SELECT awatar, login from uzytkownicy WHERE id={$row->idUzytkownika}";
            $idUzytkownika = $row->idUzytkownika;
            $awatar = $conn->query($sql)->fetch_object()->awatar;
            $nazwaAutora = $conn->query($sql)->fetch_object()->login;
            $idKat = $row->idKategorii;
            echo "<h1>{$row->nazwa}</h1>";            
            echo "<div id='profile-small'>
            <a href='profile.php?id={$idUzytkownika}'>
            <img src='awatary/$awatar'>
            <h2 style='display:inline;'>$nazwaAutora</h2></a>
            </div>";
            echo "<p>{$row->opis}</p>";

            echo "<div class=managementBtns>";

            if($idZalogowanego!=$idUzytkownika){
                $sql = "SELECT id FROM ulubione WHERE idPostu = $id AND idUzytkownika = $idZalogowanego";
                $added = $conn->query($sql)->num_rows > 0;
                $text = $added ? "Usuń z ulubionych" : "Dodaj do ulubionych";
                echo "<p><a class='fav' id='fav' data-post='$id'>$text</a></p>";
            }

            if($idZalogowanego==$idUzytkownika || $rolaZalogowanego == "admin"){

            echo "<p><a href='updateForm.php?id=$id' id='edit'>Edytuj post</a></p>";
            echo "<p><a href='delete.php?id=$id' id='delete'>Usuń post</a></p>";
            }
            echo "<p><a href='index.php?idKat={$idKat}'>Kategoria: {$row->nazwaKat}</a></p>";
            echo "</div class=managementBtns>";
        ?>


        <?php
        echo "<p>$row->data</p>";
        ?>


            
        <br>
        <h1>Komentarze</h1>

        <form action="insertReview.php" method="post">
            <input type="hidden" name="post_id" value=<?php echo "$id" ?>>

            <label for="komentarz">Treść komentarza:</label>
            <br>
            <textarea id="komentarz" class="commentInput" name="komentarz" rows="4" cols="50" ></textarea>
            <br>
            
            <input type="submit" id="submit" value="Dodaj komentarz">
        </form>

        <br>

        <?php
            $sql = "SELECT k.nick, k.tresc, k.data, u.id, u.awatar FROM komentarze k, uzytkownicy u WHERE idPostu=$id AND k.nick = u.login";
            $result = $conn->query($sql);


            while($row = $result->fetch_object()) {
            echo "<div class='comment'>";
            echo "<a href='profile.php?id={$row->id}'>{$row->nick}</a>";
            echo "<p style='margin-top: 5;'>{$row->tresc}</p>";
            echo "<p id='data'>{$row->data}</p>";
            echo "</div>";
            }
            
            $conn->close();
        ?>

        <br>

        <a href="index.php">Wróć</a>

    </details-desc>
        </details-container>
        </div>
    <script src="jquery.js"></script>
    <script src="script.js"></script>

</body>
</html>
