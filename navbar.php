<?php
    require ("session.php");
?>

<nav>
    <link rel="stylesheet" href="style-navbar.css">
    <a href="index.php"><img src="logo.svg" id="logo"></a>
    <p>
        <a href="followFeed.php">Obserwowani</a>
        <a href="insertForm.php">Dodaj post</a>
        <form target="_self" action="index.php" method="get">
        <p style="margin: 0;">
            <input type="text" class="nav-search" name="fraza" style="margin-right:5px;">
            <input type="submit" id="submit" value="Wyszukaj" >
        </p>
    </form>

    <?php $idUzytkownika=$_SESSION["id"];?>
        <div class="nav-right">
            <a href="profile.php?id=<?php echo "$idUzytkownika"?>">
                <?= $_SESSION["login"] ?>
            </a>
            <a href="favorites.php">Polubione posty</a>
            <a href="logout.php">Wyloguj</a>
        </div>
    </p>
</nav>
