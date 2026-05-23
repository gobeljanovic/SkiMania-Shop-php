<?php
require_once 'config/db.php';

if(!isset($_SESSION['status']) || $_SESSION['status'] !== 'admin'){
    header("Location: index.php");
    exit();
}

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    // zaštita da admin ne može obrisati sebe
    if($id == $_SESSION['status']){
        header("Location: admin.php");
        exit();
    }

    $stmt = mysqli_prepare($dbc, "DELETE FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

header("Location: admin.php");
exit();