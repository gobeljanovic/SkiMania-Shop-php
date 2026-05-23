<?php
    require_once 'config/db.php';

    if(!isset($_SESSION['status']) || $_SESSION['status']!=='admin'){
        header('Location: index.php');
        exit();
    }
    if(!isset($_GET['id']) || empty($_GET['id'])){
        header('Location: index.php');
        exit();
    }

    $id = intval($_GET['id']);

    $stmt = mysqli_prepare($dbc,"SELECT ime,prezime,email,uloga FROM users WHERE id=?");
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    $rez = mysqli_stmt_get_result($stmt);
    //var_dump($rez);
    if(mysqli_num_rows($rez)==0){ //korisnik ne postoji
        header("Location: admin.php");
        exit();
    }

    $user = mysqli_fetch_assoc($rez);
    mysqli_stmt_close($stmt);

    // Obrada POST forme
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $ime = trim($_POST['ime']);
    $prezime = trim($_POST['prezime']);
    $email = trim($_POST['email']);
    $uloga = trim($_POST['uloga']);
    $pass = trim($_POST['pass']); // opcionalno

    // validacija
    if(empty($ime) || empty($prezime) || empty($email) || empty($uloga)){
        $error = "Sva polja osim lozinke su obavezna!";
    } else {
        if(!empty($pass)){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($dbc, "UPDATE users SET ime=?, prezime=?, email=?, uloga=?, password=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "sssssi", $ime, $prezime, $email, $uloga, $hash, $id);
        } else {
            $stmt = mysqli_prepare($dbc, "UPDATE users SET ime=?, prezime=?, email=?, uloga=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "ssssi", $ime, $prezime, $email, $uloga, $id);
        }

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: admin.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit korisnika</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('img/izmenaKorisnikaWallpaper.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">

<div class="container py-5 mt-5">
    <h2 class="mb-4 display-2 text-success mark d-flex justify-content-center align-items-center">Izmeni korisnika</h2>
    <hr>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label text-white">Ime</label>
                <input type="text" name="ime" class="form-control" value="<?php echo htmlspecialchars($user['ime']); ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label text-white">Prezime</label>
                <input type="text" name="prezime" class="form-control" value="<?php echo htmlspecialchars($user['prezime']); ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-md-8">
                <label class="form-label text-white">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label text-white">Uloga</label>
                <select name="uloga" class="form-select" required>
                    <option value="admin" <?php if($user['uloga']=='admin') echo 'selected'; ?>>Admin</option>
                    <option value="user" <?php if($user['uloga']=='user') echo 'selected'; ?>>Korisnik</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                    <label class="form-label text-white">Nova lozinka</label>
                    <input type="password" name="pass" class="form-control" placeholder="ostavite prazno ako ne menjate">
            </div>
            <div class="mb-3 pt-4 col-md-3">
                <button type="submit" class="btn btn-success h-100 w-100">Sačuvaj promene</button>
            </div>
            <div class="mb-3 pt-4 col-md-3">
                <a href="admin.php" class="btn btn-warning h-100 w-100">Nazad</a>
            </div>
        </div>
    
        

        
    </form>
</div>

<script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>