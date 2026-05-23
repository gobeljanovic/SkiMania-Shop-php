<?php
require_once 'config/db.php';

if(!isset($_SESSION['status']) || $_SESSION['status']!=='admin'){
    header("Location: index.php");
    exit();
}

if(isset($_POST['dodajProizvod'])){
    $nizVelicina = ['xl','l','m','s'];
    $naziv = trim($_POST['naziv']);
    $opis = trim($_POST['opis']);
    $cena = doubleval($_POST['cena']);
    $kolicina = intval($_POST['kolicina']);
    $kategorija_id = intval($_POST['kategorija_id']);

    
    $s = "SELECT naziv FROM kategorije WHERE id = ?";
    $stmt = mysqli_prepare($dbc,$s);
    mysqli_stmt_bind_param($stmt,"i",$kategorija_id);
    mysqli_stmt_execute($stmt);
    $rez = mysqli_stmt_get_result($stmt);
    $r = mysqli_fetch_assoc($rez);


    //Validacija unetih podataka

    if(empty($naziv) || $cena<=0 || $kolicina < 0){
        die("neispravni podaci");
    }

    if(!isset($_FILES['slika']) || $_FILES['slika']['error'] !== 0){
        die("Greška pri upload-u slike.");
    }
    $slika = $_FILES['slika'];
    $dozvoljeniTipovi = ['jpg','jpeg','png','webp'];
    $ext = strtolower(pathinfo($slika['name'], PATHINFO_EXTENSION));

    if(!in_array($ext,$dozvoljeniTipovi)){
        die("Dozvoljeni formati su jpg, jpeg, png, webp.");
    }

    if($slika['size'] > 5 * 1024 * 1024){
        die("Slika ne sme biti veća od 5MB.");
    }
    //dodavanje naziva svakoj uplodovanoj slici 'proizvod_unikatniIdSaDecimalama.ext'
    $novoIme = uniqid('proizvod_', true) . "." . $ext;
    $putanjaDoSLike = "uploads/" . $novoIme;

    if(!move_uploaded_file($slika['tmp_name'], $putanjaDoSLike)){
        die("Upload slike nije uspeo.");
    }

    //insert u bazu

     //ukoliko su skije ili bord prihvataju se samo uneti brojevi u intervalu 100 i 220 i upisuju se u bazu
    if($r['naziv'] == 'Skije' || $r['naziv'] == 'Snowboard'){
        $duzina = !empty($_POST['duzina']) ? intval($_POST['duzina']) : NULL;
            if($duzina !== NULL && ($duzina < 100 || $duzina > 220)){
                die("Dužina mora biti između 100 i 220 cm.");
            }
            $s = "INSERT INTO proizvodi 
            (naziv,opis,cena,slika,kategorija_id,kolicina_na_stanju,velicina) VALUES (?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare($dbc,$s);
            mysqli_stmt_bind_param($stmt,"ssdsiii",$naziv,$opis,$cena,$putanjaDoSLike,$kategorija_id,$kolicina,$duzina);
            mysqli_stmt_execute($stmt);
    } 
    else{ 
        //ukoliko je neki drugi proizvod mora proci provera velicina (dostupne velicine su u nizu $nizVelicina)
        $duzina = !empty($_POST['duzina']) ? trim(strtolower($_POST['duzina'])) : NULL;
        if(!in_array($duzina,$nizVelicina)){
            die("neispravni podaci uneti za velicinu");
        }
        $s = "INSERT INTO proizvodi 
            (naziv,opis,cena,slika,kategorija_id,kolicina_na_stanju,velicina) VALUES (?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare($dbc,$s);
            mysqli_stmt_bind_param($stmt,"ssdsiis",$naziv,$opis,$cena,$putanjaDoSLike,$kategorija_id,$kolicina,$duzina);
            mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    header("Location: admin.php");
}

?>