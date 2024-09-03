<!DOCTYPE html>
<html lang="pl">

<?php
require("navbar.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj profil</title>
    <link rel="stylesheet" href="style-main.css">
    <link rel="stylesheet" href="style-form.css">
</head>
<body>
    <?php
    $id = $_GET["id"];
    ?>

    <div class="header">
    <h1>Edytuj profil</h1>
    </div>

    <?php
        $conn = new mysqli("localhost", "root", "", "portfolio");
        $sql = "SELECT login, email FROM uzytkownicy WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_object();
        $tmpLogin = $row->login;
        $tmpEmail = $row->email;
        $conn->close();
    ?>

    <div class="content">    
    <form action="updateProfile.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value=<?php echo "$id" ?>>

        <label for="login">Nazwa użytkownika:</label><br>
        <input type="text" id="login" class="input" name="login" value="<?php echo "$tmpLogin"; ?>"><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" class="input" name="email" value="<?php echo "$tmpEmail"; ?>"><br>

        <label for="password">Hasło:</label><br>
        <input type="password" id="password" class="input" name="password"><br>

        <p>Awatar: <input type="file" name="awatar"></p>

        <input type="submit" id="submit" value="Aktualizuj profil">
    </form> 
    <br>
    <a href="profile.php?id=<?php echo "$id"; ?>">Anuluj</a>
    </div>

</body>
</html>