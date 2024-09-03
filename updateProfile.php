<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktualizowanie...</title>
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "portfolio");

    $id = $_POST["id"];
    $login = $_POST["login"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $awatar = $_POST["awatar"];

    $sql = "SELECT login, email, haslo, awatar FROM uzytkownicy WHERE id = $id";
    $conn->query($sql);
    $result = $conn->query($sql);
    $row = $result->fetch_object();
    $tmpLogin = $row->login;
    $tmpEmail = $row->email;
    $tmpPassword = $row->haslo;
    $tmpAwatar = $row->awatar;

    if(empty($login)){
        $login = $tmpLogin;
    }

    if(empty($email)){
        $email = $tmpEmail;
    }

    if(empty($password)){
        $password = $tmpPassword;
    } else{
        $password = md5($password);
    }

    if($_FILES['awatar']['tmp_name'] == null){
        $awatar = $tmpAwatar;
    } else {
    $awatar = basename($_FILES["awatar"]["name"]);
    move_uploaded_file($_FILES["awatar"]["tmp_name"], "awatary/$awatar");
    }

    $sql = "UPDATE uzytkownicy SET login='$login', email='$email', haslo='$password', awatar='$awatar' WHERE id=$id";
    $conn->query($sql);

    $_SESSION["login"] = "$login";

    $conn->close();
    header("location: profile.php?id=$id");
    ?>
</body>
</html>