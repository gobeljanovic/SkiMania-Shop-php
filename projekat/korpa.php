<?php
require_once 'config/db.php';

if(!isset($_SESSION['status'])){
    header("Location: index.php");
    exit();
}
if(!isset($_SESSION['korpa']) || empty($_SESSION['korpa'])){
   $praznaKorpa = true;
} else{
    $praznaKorpa = false;
}

// echo "<pre>";
// echo print_r($_SESSION['korpa']);
// echo "</pre>";

//brisanje iz korpe
if(isset($_GET['remove'])){ 
    $remove_id = intval($_GET['remove']);
    unset($_SESSION['korpa'][$remove_id]);
    header("Location: korpa.php");
    exit();
}
$ukupno = 0;
if(isset($_POST['checkout'])){
    if(!isset($_SESSION['korisnik'])){
        echo "<script>alert('Morate biti ulogovani da poručite.');</script>";
    } else {
        
        // Ubacivanje u tabelu porudzbine
        $user_id = $_SESSION['korisnik'];
        $datum = date('Y-m-d H:i:s');
        $status = 'na cekanju';

        foreach($_SESSION['korpa'] as $proizvod_id => $p)
        {
            $s = "SELECT cena FROM proizvodi_kat WHERE id=?";
            $stmt = mysqli_prepare($dbc,$s);
            mysqli_stmt_bind_param($stmt,'i',$proizvod_id);
            mysqli_stmt_execute($stmt);
            $rez = mysqli_stmt_get_result($stmt);
            $r = mysqli_fetch_assoc($rez);
            mysqli_stmt_close($stmt);

            $ukupno += $r['cena'] * $p['kolicina']; //racunanje ukupne cene za upis u porudzbine
        }

        // Ubacivanje stavki
        $stmt = mysqli_prepare($dbc,"INSERT INTO porudzbine (user_id, datum, ukupna_cena, status) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt,'isds',$user_id,$datum,$ukupno,$status);
        mysqli_stmt_execute($stmt);
        $porudzbina_id = mysqli_insert_id($dbc);
        mysqli_stmt_close($stmt);

        foreach($_SESSION['korpa'] as $proizvod_id => $p){
            $s = "SELECT cena FROM proizvodi_kat WHERE id=?";
            $stmt = mysqli_prepare($dbc,$s);
            mysqli_stmt_bind_param($stmt,'i',$proizvod_id);
            mysqli_stmt_execute($stmt);
            $rez = mysqli_stmt_get_result($stmt);
            $r = mysqli_fetch_assoc($rez);
            mysqli_stmt_close($stmt);

            $cena = $r['cena'];
            $kolicina = $p['kolicina'];
            $ukupno_proizvod = $cena * $kolicina;
            $ukupno += $ukupno_proizvod;

            $stmt = mysqli_prepare($dbc,"INSERT INTO stavke_porudzbine (porudzbina_id, proizvod_id, kolicina, cena) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($stmt,'iiid',$porudzbina_id,$proizvod_id,$kolicina,$cena);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Smanjivanje stanja
            $stmt = mysqli_prepare($dbc,"UPDATE proizvodi SET kolicina_na_stanju = kolicina_na_stanju - ? WHERE id=?");
            mysqli_stmt_bind_param($stmt,'ii',$kolicina,$proizvod_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        // Ciscenje korpe
        unset($_SESSION['korpa']);

        echo "<script>alert('Uspešno ste poručili proizvode!'); window.location.href='index1.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" cintent="Prodaja Skija,Snowboard-ova i opreme za zimske sportove">
    <meta name="keywords" content="Ski,Skije,Snowboard,Pnacerice,Čizme,Oprema,Jakna,Pantalone">
    <meta name="autor" content="Djordje, Gobeljić, djordjenrt4023@gs.viser.edu.rs">

    <link rel="stylesheet" href="css/style.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./fontawesome/css/all.min.css">
    <title>SkiMania Korpa</title>
</head>
<body style="background-image: url('img/loginWallpaper.jpeg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
  
    <nav class="navbar navbar-expand-lg "> <!--NAVIGACIJA-->    
        <div class="container-fluid">
          <a href="index1.php" class="navbar-brand"><img class="logoNav" src="img/logo1.jpg" alt="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <?php if($_SESSION['status']==='admin'):?>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="admin.php">Početna</a>
                  </li>
                <?php else:?>
                  <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index1.php">Početna</a>
                  </li>
                <?php endif;?>
              <li class="nav-item">
                <a class="nav-link" href="onama.php">O nama</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="flase">
                  Prodavnica
                </a>
                <ul class="dropdown-menu">
                  <?php 
                    $s = "SELECT id,naziv FROM kategorije";
                    $rez = mysqli_query($dbc,$s);
                    while($r = mysqli_fetch_assoc($rez))
                    {
                      echo "<li><a class='dropdown-item' href='proizvod.php?id={$r['id']}'>" . $r['naziv'] . "</a></li>";
                    }
                  ?>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="kontakt.php">Kontakt</a>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="korpa.php">
                    <i class="fa-solid fa-cart-shopping fa-2x"></i>
                    </a>
                </li>
                <?php if($_SESSION['status']!=='guest'):?>
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-outline-danger mt-2">
                      <i class="fas fa-sign-out-alt"></i> Odjavite se
                    </a>
                </li>
                <?php endif;?>
            </ul>
          </div>
        </div>
    </nav>
    
    <?php if(!$praznaKorpa):?>
    <div class="container pt-5 mb-5">
        <table class="table table-light table-striped table-hover align-middle text-center">
            <thead>
                <tr>
                    <th>Proizvod</th>
                    <th>Velicina</th>
                    <th>Kolicina</th>
                    <th>Cena</th>
                    <th>Ukupno</th>
                    <th></th>
                </tr>
            </thead>
             <tbody>   <!-- Prikaz svih proizvoda dodatih u korpu -->
                <?php foreach($_SESSION['korpa'] as $proizvod_id => $p):
                    $q = "SELECT * FROM proizvodi_kat WHERE id=?";
                    $stmt = mysqli_prepare($dbc,$q);
                    mysqli_stmt_bind_param($stmt,'i',$proizvod_id);
                    mysqli_stmt_execute($stmt);
                    $rez = mysqli_stmt_get_result($stmt);
                    $r = mysqli_fetch_assoc($rez);
                    mysqli_stmt_close($stmt);

                    $cena = $r['cena'];
                    $ukupno_proizvod = $cena * $p['kolicina'];
                    $ukupno += $ukupno_proizvod;
                ?>
                <tr>
                    <td><?php echo $r['naziv']; ?></td>
                    <td><?php echo $p['velicina']; ?></td>
                    <td><?php echo $p['kolicina']; ?></td>
                    <td><?php echo ceil($cena); ?> RSD</td>
                    <td><?php echo ceil($ukupno_proizvod); ?> RSD</td>
                    <td>
                        <a href="korpa.php?remove=<?php echo $proizvod_id; ?>" class="btn btn-danger btn-sm">Ukloni</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="display-4 d-flex justify-content-center align-items-center mark" style="color: #015c68;">Vasa korpa - Ukupno: <?php echo ceil($ukupno); ?> RSD</h4>

        <form method="POST">
            <input type="submit" value="Poruči" name="checkout" class="btn btn-success btn-lg w-100">
        </form>
    </div>
    <?php else:?>
    <section style="margin: 20px;" id="izlaznaStranaSekcija">
      <div class="container">
        <h1 class="display-4 text-center mark" style="color: #005e6e;">
            Obaveštenje o artiklima u korpi
        </h1>
        <hr>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading" style="color:#217c92">Vasa korpa je prazna </h4>
            <p class="lead">Trenutno nema artikala dodatih u korpu</p>
            </div>
      </div>
    </section>
    <?php endif;?>   
    <footer> <!--FOOTER-->
        <div class="footer-container">
          <div class="footer-left">
          <a href="#">
           <h1>Skimania.rs</h1>
           <p>Najnoviji modeli skija i opreme</p>
          </a>
       
        </div>
        <div class="footer-columns">
          <div class="footer-column">
            <h4>Zašto nas podržavate!</h4>
            <p>Prodavnica skijaške opreme
             Skimania datira još od 2005. godine. 
             Od početka prodavanja skijaške opreme Skimania je važila za prodavnicu
             koja je mogla da se pohvali svojim kvalitetom, pofesionalizmom u poslovanju i
             prijatnom atmosferom prema svojim mušterijama.</p>
        <a href="onama.php">Procitajte vise...</a>
        </div>
        <div class="footer-column">
          <h4>Info prodavnice</h4>
            <a href="onama.php">O nama</a>
            <a href="kontakt.php">Kontakt</a>
            <a href="faq.php">FAQ</a>
        </div>
          
        <div class="footer-column">
            <h4>Kontakt</h4>
          <p>Addresa: Kneginje Milice 58, Trstenik</p>
            <a href="mailto:skimania2005@gmail.com"><p>Email: skimania2005@gmail.com</p></a>
            <a href="tel:+381697419651 "><p>Telefon: +381 69 741 96 51 </p></a>
          <p>Elektronsko plaćanje</p>
        <div class="payment-options">
          <img src="img/payment.png" alt="payment options">
            </div>
          </div>
        </div>
          <div class="footer-social">
            <div class="social-links">
              <a href="https://x.com/?lang=en" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
              <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
              <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
              <a href="https://www.linkedin.com/feed/" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
            </div>
          </div>
        </div>
    </footer>

    <div class="copyright"><!--COPYRIGHT-->
        <div>
             <div>
                   <div>
                     <span><a href="">Skimania</a>,<i class="fa-solid fa-copyright"></i> Sva prava zadrzana</span>
                   </div>
                <div class="copyright">
                    Designed by <a href="">SkiMania tim</a>
                </div>
            </div>
        </div>
    </div>


      <script src="./js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="./fontawesome/js/all.min.js"></script>
    </body>
</html>
