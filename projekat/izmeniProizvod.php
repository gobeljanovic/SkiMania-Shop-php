<?php
require_once 'config/db.php';
if(!isset($_SESSION['status']) || $_SESSION['status']!=='admin'){
    header("Location: index.php");
    exit();
}
if(!isset($_GET['id']) || empty($_GET['id']))
{
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

$s = "SELECT * FROM proizvodi WHERE id=?";
$stmt = mysqli_prepare($dbc,$s);
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
$rez = mysqli_stmt_get_result($stmt);
$proizvod = mysqli_fetch_assoc($rez);
mysqli_stmt_close($stmt);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $naziv = trim($_POST['naziv']);
    $opis = trim($_POST['opis']);
    $cena = doubleval($_POST['cena']);
    $kolicina = intval($_POST['kolicina']);

    // Provera da li je nova slika poslata
if(isset($_FILES['slika']) && $_FILES['slika']['error'] === 0){
    $slika = $_FILES['slika'];
    $dozvoljeniTipovi = ['jpg','jpeg','png','webp'];
    $ext = strtolower(pathinfo($slika['name'], PATHINFO_EXTENSION));

    if(!in_array($ext,$dozvoljeniTipovi)){
        die("Dozvoljeni formati su jpg, jpeg, png, webp.");
    }

    if($slika['size'] > 5 * 1024 * 1024){
        die("Slika ne sme biti veća od 5MB.");
    }

    $novoIme = uniqid('proizvod_', true) . "." . $ext;
    $putanjaDoSLike = "uploads/" . $novoIme;

    if(!move_uploaded_file($slika['tmp_name'], $putanjaDoSLike)){
        die("Upload slike nije uspeo.");
    }

} else {
    // Nije poslat novi fajl - ostaje stara slika
    $putanjaDoSLike = $proizvod['slika'];
}

    $s = "UPDATE proizvodi  SET naziv = ?, opis = ?, cena = ?, slika = ?,kolicina_na_stanju = ?
            WHERE id=?";
    $stmt = mysqli_prepare($dbc,$s);
    mysqli_stmt_bind_param($stmt,"ssdsii",$naziv,$opis,$cena,$putanjaDoSLike,$kolicina,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <title>Izmena proizvoda</title>
</head>
<body style="background-image: url('img/izmenaKorisnikaWallpaper.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">

    
    <div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-8 pt-5">
            <h2 class="mb-4 display-2 text-success mark d-flex justify-content-center align-items-center">Izmeni proizvod </h2>
        </div>
        <div class="col-md-4">
                <a href="<?php echo htmlspecialchars($proizvod['slika']); ?>" target="_blank" data-lightbox="photos">
                <img src="<?php echo htmlspecialchars($proizvod['slika']); ?>" alt="<?php echo htmlspecialchars($proizvod['naziv']); ?>" width="200" class="img-fluid mx-5">  </a>
        </div>
    </div>
    
    <hr>

    <form method="POST"  enctype="multipart/form-data">
        <div class="row">
            <div class="mb-3 col-md-12">
                <label class="form-label text-white">Naziv</label>
                <input type="text" name="naziv" class="form-control" value="<?php echo htmlspecialchars($proizvod['naziv']); ?>" required>
            </div>  
        </div>
        <div class="row">
            <div class="mb-3 col-md-12">
                <label class="form-label text-white">Opis</label>
                <input name="opis" type="text" class="form-control w-100" value="<?php echo htmlspecialchars($proizvod['opis'])?>">
            </div>
        </div>
            
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label text-white">Cena</label>
                <input type="number" name="cena" class="form-control" value="<?php echo htmlspecialchars($proizvod['cena']); ?>">
            </div>
            <div class="mb-3 col-md-4">
                <label class="form-label text-white">Kolicina</label>
                <input type="number" name="kolicina" class="form-control" value="<?php echo htmlspecialchars($proizvod['kolicina_na_stanju']); ?>">    
            </div>
            <div class="mb-2 col-md-4">
                <label class="form-label text-white">Nova Slika</label>
                 <input class="form-control" type="file" id="slika" name="slika">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 pt-4 col-md-6">
                <button type="submit" class="btn btn-success h-100 w-100">Sačuvaj promene</button>
            </div>
            <div class="mb-3 pt-4 col-md-6">
                <a href="admin.php" class="btn btn-warning h-100 w-100">Nazad</a>
            </div>
        </div>
    
        

        
    </form>
</div>  
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./fontawesome/js/all.min.js"></script>
</body>
</html>