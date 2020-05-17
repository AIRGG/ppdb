<?php
try {
    include("../config/lib.php");
    $salt = "m6tl7u|#u{-hpa<b?/aeg";
    $usr = $_POST["username"];
    $pwd = md5($_POST["password"].$salt);
    $sql = show("SELECT * FROM login WHERE sts=1 AND username=?", [$usr]);
    if(count($sql) === 1){
        if($sql[0]["password"] === $pwd){
            $rand = random_int(9999999999,99999999999);
            proses("UPDATE login SET tmplog=? WHERE username=? AND password=?",[$rand,$usr,$pwd]);
            $_SESSION["usr"] = $sql[0];
            $_SESSION["tmplog"] = $rand;
            header("location:../dashboard/utama.php");
        }else{
            echo "Gagal";
        }
    }else{
        echo "Gagal";
    }
} catch (\Throwable $th) {
    echo $th;
    die("sorry something wrong!! ");
}
?>