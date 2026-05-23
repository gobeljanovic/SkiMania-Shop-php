<?php require_once 'config/db.php';

if(!isset($_SESSION['status']) || !isset($_GET['id']) || empty($_GET['id'])){
    header("Location: index.php");
    exit();
}
    $idKat = intval($_GET['id']); //uzimamo iz GET-a vrednost id-a kategorije
    $s = "SELECT naziv FROM kategorije WHERE id=?";
    $stmt = mysqli_prepare($dbc,$s);
    mysqli_stmt_bind_param($stmt,'i',$idKat);
    mysqli_stmt_execute($stmt);
    $rez1 = mysqli_stmt_get_result($stmt);
    $r1 = mysqli_fetch_assoc($rez1);
    mysqli_stmt_close($stmt);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" cintent="Katalog dostupnih skija u prodavnici">
    <meta name="keywords" content="Ski,Skije,ELAN">
    <meta name="autor" content="Djordje, Gobeljić, djordjenrt4023@gs.viser.edu.rs">

    <link rel="stylesheet" href="css/style.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./fontawesome/css/all.min.css">
    <title><?= $r1['naziv'];?> SkiMania</title>
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
                    <a class="nav-link" aria-current="page" href="admin.php">Početna</a>
                  </li>
                <?php else:?>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index1.php">Početna</a>
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

    <section id="skijeSekcija"> <!--KATALOG PROIZVODA-->
        <div class="container">
            <div class="row">
              <?php
                $s = "SELECT * FROM proizvodi_kat WHERE kategorija_id=?";
                $stmt = mysqli_prepare($dbc,$s);
                mysqli_stmt_bind_param($stmt,'i',$idKat);
                mysqli_stmt_execute($stmt);
                $rez = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);

                if(mysqli_num_rows($rez)!=0):
                  while($r = mysqli_fetch_assoc($rez)):
                      if($r['kolicina_na_stanju']==0): //Ukoliko je kolicina na stanju 0 taj proizvod brisemo iz tabele
                          $s = "DELETE FROM proizvodi WHERE id=?";
                          $stmt = mysqli_prepare($dbc,$s);
                          mysqli_stmt_bind_param($stmt,'i',$r['id']);
                          mysqli_stmt_execute($stmt);
                          mysqli_stmt_close($stmt);
                          continue;
                      endif;
              ?>
                <div class="col-lg-3 col-md-4 col-sm-6"> 
                    <div class="card text-center">
                        <img src="<?php echo $r['slika'];?>" class="card-img-top" alt="<?php echo $r['slika'];?>">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $r['naziv'];?></h5>
                          <p class="card-text"><?php echo $r['cena'];?> RSD</p>
                          <a href="proizvodDetaljnije.php?id=<?php echo $r['id']; ?>" class="btn btn-outline-primary">Detaljnije</a>
                        </div>
                      </div>
                </div>
            <?php 
                  endwhile;
                else: ?>
                    <div class="card m-5">
                        <div class="card-body">
                            <figure>
                            <blockquote class="blockquote">
                                <p>Obavestenje</p>
                            </blockquote>
                            <figcaption class="blockquote-footer">   
                                Trenutno su nam ponestali proizvodi trazene kategorije <cite title="Source Title">Uskoro vise informacija o stanju na lageru</cite>
                            </figcaption>
                            </figure>
                        </div>
                        </div>
                <?php endif;?>
            </div>
        </div>
    </section>

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
        <a href="onama.html">Procitajte vise...</a>
        </div>
        <div class="footer-column">
          <h4>Info prodavnice</h4>
            <a href="onama.html">O nama</a>
            <a href="kontakt.html">Kontakt</a>
            <a href="faq.html">FAQ</a>
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