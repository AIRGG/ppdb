<?php
include("../config/lib.php");
if(!validasi_login($_SESSION["tmplog"],$_SESSION["usr"]["username"])){
    session_destroy();
    header("location:../login.php");
}
if(isset($_GET["logout"])){
    $sql = proses("UPDATE login SET tmplog='' WHERE username=? AND password=?",[$_SESSION["usr"]["username"],$_SESSION["usr"]["password"]]);
    if($sql){
        session_destroy();
        header("location:../login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome</h1>
    <a href="?logout">Loogut</a>
</body>
</html>