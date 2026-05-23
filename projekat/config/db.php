
<?php
    
    session_start();

    $ip = "localhost";
    $name = "root";
    $pass = "";
    $db = "skimania";

    $dbc = @mysqli_connect($ip,$name,$pass,$db);
    if(mysqli_connect_errno()){
        die("neuspela konekcija sa bazom");
    }
?>