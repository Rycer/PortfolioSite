<script src="jquery.js"></script>
<script src="follow.js"></script>

<?php
    $idZalogowanego = $_SESSION["id"];
    $sql = "SELECT id FROM obserwowani WHERE idObserwowanego = $idUzytkownika AND idUzytkownika = $idZalogowanego";
    $added = $conn->query($sql)->num_rows > 0;
    $text = $added ? "Przestań obserwować" : "Obserwuj";
    echo "<button class='follow' data-obserwowany='$idUzytkownika'>$text</button>";
?>