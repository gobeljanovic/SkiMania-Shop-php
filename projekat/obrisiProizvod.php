<?php
require_once 'config/db.php';

if(!isset($_SESSION['status']) || $_SESSION['status']!=='admin')
{
    header("Location: index.php");
    exit();
}
    $id = intval($_GET['id']);
    $s = "DELETE FROM proizvodi WHERE id = ?";
    $stmt = mysqli_prepare($dbc, $s);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: admin.php");
?>