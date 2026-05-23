<?php require_once 'config/db.php';
  if(!isset($_SESSION['status'])){
    header("Location: index.php");
    exit();
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
    <title>SkiMania Shop</title>
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
                    <a class="nav-link active" aria-current="page" href="admin.php">Početna</a>
                  </li>
                <?php else:?>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index1.php">Početna</a>
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

    <section id="hero-section"> <!--Prva sekcija-->
        <div class="container">
            <div class="row align-items-center"> <!--red-->
                <div class="col-md-6 col-sm-12"> <!--1. kolona-->
                    <h5 id="h5-anim"><span>Najpovoljniji</span> <span>Web</span> <span>Shop</span> <span>Na</span> <span>Balkanu</span></h5>
                    <h1 class="skimania-naslov">Ski Mania  <i class="fa-solid fa-person-skiing skiIcon"></i></h1>
                </div> 

                <div class="col-md-6 col-sm-12"> <!--2. kolona (CAROUSEL)-->
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="img/skijas1.jpg" class="d-block w-100" alt="skijas">
                            
                          </div>
                          <div class="carousel-item">
                            <img src="img/skijas2.jpg" class="d-block w-100" alt="skijas">
                            
                          </div>
                          <div class="carousel-item">
                            <img src="img/skijas3.jpg" class="d-block w-100" alt="skijas">
                            
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div> 
            </div>
        </div>
    </section>

    <section id="indexSekcija">   <!--Druga sekcija-->
        <div class="container">
            <div class="row">
                <div class="col-md-4"> <!--prva kolona kartica-->
                    <div class="card">
                        <img src="img/skijeKartica.jpg" class="card-img-top img-fluid" alt="skije">
                        <div class="card-body">
                          <h5 class="card-title">Skije</h5>
                          <p class="card-text lead">Skije su dugotrajne, uske daske koje se koriste za klizanje po snežnim površinama. Obično su izrađene od kombinacije drva, plastike, metala i kompozitnih materijala, što im daje potrebnu čvrstoću i fleksibilnost. Skije su pričvršćene za čizme pomoću specijalnih vezova i koriste se u različitim disciplinama, poput alpskog skijanja, nordijskog skijanja i slobodnog skijanja. Za pregled dostupnih skija u našoj prodavnici kliknite dugme ispod.</p>
                          <?php
                          $stmt = mysqli_prepare($dbc,"SELECT id FROM kategorije WHERE naziv='Skije'");
                          mysqli_stmt_execute($stmt);
                          $rez = mysqli_stmt_get_result($stmt);
                          $r = mysqli_fetch_assoc($rez);
                          mysqli_stmt_close($stmt);
                          //var_dump($r['id']);
                          ?>
                          <a class="btn btn-outline-primary" href="proizvod.php?id=<?php echo $r['id'];?>">Katalog skija</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"> <!--druga kolona kartica-->
                    <div class="card">
                        <img src="img/bordKartica.jpg" class="card-img-top" alt="Snow Board">
                        <div class="card-body">
                          <h5 class="card-title">Snowboard</h5>
                          <p class="card-text lead">
                            Snowboard daska je široka, čvrsta ploča koja se koristi za klizanje po snežnim padinama. Daska je obično dugačka i ima specifičan oblik, sa blagim zakrivljenjima na krajevima, što omogućava kontrolu prilikom vožnje niz padine. Snowboard daske su napravljene od različitih materijala, uključujući drvo, plastiku, kompozite i metal, što im daje fleksibilnost, čvrstoću i lakoću. Za pregled dostupnih snowboard-ova u našoj prodavnici kliknite dugme ispod.</p>
                          <?php
                          $stmt = mysqli_prepare($dbc,"SELECT id FROM kategorije WHERE naziv='Snowboard'");
                          mysqli_stmt_execute($stmt);
                          $rez = mysqli_stmt_get_result($stmt);
                          $r = mysqli_fetch_assoc($rez);
                          mysqli_stmt_close($stmt);
                          ?>
                          <a class="btn btn-outline-primary" href="proizvod.php?id=<?php echo $r['id'];?>">Katalog snowboard-ova</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"> <!--treci kolona kartica-->
                    <div class="card">
                        <img src="img/opremaKartica.jpg" class="card-img-top" alt="Dodatna oprema">
                        <div class="card-body">
                          <h5 class="card-title">Dodatna oprema</h5>
                          <p class="card-text lead">Dodatna oprema za skijanje obuhvata različite stvari koje skijašima pomažu da se zaštite, poboljšaju performanse i uživaju u sportu. Neki od najvažnijih komada opreme uključuju kacigu, rukavice, jaknu, ski pantalone, naočare, štapove, pancerice, aktivni veš, kape, potkape, majice, dukseve, vezove za skije i snowboard. Za pregled dodatne opreme u našoj prodavnici kliknite dugme ispod.</p>
                          <?php
                          $stmt = mysqli_prepare($dbc,"SELECT id FROM kategorije WHERE naziv='Naocare'");
                          mysqli_stmt_execute($stmt);
                          $rez = mysqli_stmt_get_result($stmt);
                          $r = mysqli_fetch_assoc($rez);
                          mysqli_stmt_close($stmt);
                          ?>
                          <a class="btn btn-outline-primary mb-2" href="proizvod.php?id=<?php echo $r['id'];?>">Katalog dodatne opreme</a>
                          <?php
                          $stmt = mysqli_prepare($dbc,"SELECT id FROM kategorije WHERE naziv='Jakne'");
                          mysqli_stmt_execute($stmt);
                          $rez = mysqli_stmt_get_result($stmt);
                          $r = mysqli_fetch_assoc($rez);
                          mysqli_stmt_close($stmt);
                          ?>
                          <a class="btn btn-outline-primary" href="proizvod.php?id=<?php echo $r['id'];?>">Katalog odeće</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"> <!--Horizontalna kartica-->
                    <div class="card mb-3">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="img/logo1.jpg " class="img-fluid rounded-start" alt="logo.jpg">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body" style="height: 100%; width: 100%;">
                              <h5 class="card-title">Skimaina.rs online prodavnica za kupovinu skijaske opreme</h5>
                              <p class="card-text lead">Prodavnica skijaške opreme <u class="link-underline-light">Skimania</u> datira još od 2005. godine. Kada je osnovana prva prodavnica u Trsteniku, malom gradu udaljenom 80 kilometara od najvećeg srpskog skijališta Kopanika, sama pozicija i nedostatak konkurencije bio je motiv otvaranja ove prodavnice. Za više detalja o našoj prodavnici kliknite na dugme <u class="link-underline-light">Detaljnije o nama</u></p>
                              <a class="btn btn-outline-primary" href="onama.php">Detaljnije o nama</a>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
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
