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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" cintent="Dodatne informacije o prodavnici Skimania">
    <meta name="keywords" content="O nama, Žarko Gobeljić, Kopaonik, Prodavnica, Shop">
    <meta name="autor" content="Djordje, Gobeljić, djordjenrt4023@gs.viser.edu.rs">

    <link rel="stylesheet" href="css/style.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./fontawesome/css/all.min.css">
    <title>O nama-SkiMania</title>
</head>
<body>

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
                <a class="nav-link active" href="onama.php">O nama</a>
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

    <section id="onamaSekcija"><!--ONAMA-->
        <div class="container onamaDiv">
            <h4 class="display-4" style="color: #217c92;">O nama</h4>
            <hr>    
            <div class="row">
                <div class="col-md-6">
                    <p style="font-size: 1.1em;">Prodavnica skijaške opreme Skimania datira još od 2005. godine. Kada je osnovana prva prodavnica u Trsteniku,
                         malom gradu udaljenom 80 kilometara od najvećeg srpskog skijališta <strong>Kopanika</strong>, 
                         sama pozicija i nedostatak konkurencije bio je motiv otvaranja ove prodavnice. 
                         Vlasnik prodavnice <mark>Žarko Gobeljić</mark> kada je završio svoju profesionalnu skijašku karijeru 
                         imao je ambiciju da svoju ljubav prema skijanju nastavi uz rekreativno skijanje i otvaranje biznisa 
                         koji je usko vezan za bilo koji sport na snegu. Time je spojeno lepo i korisno. 
                         Zato danas naši klijenti i mi garantujemo svojim kvalitetom i posvećenošću</p>
                    <br>
                    <p class="lead">Ukoliko vam se svidelo ovo što ste pročitali kontaktirajte nas.</p>
                    <br>
                    <address>
                        Kneginje Milice 58 <br>
                        37240 Trstenik, Srbija <br>
                        <abbr title="Phone">P:</abbr>+381697419651 <br>
                        <a href="mailto.skimania2005@gmail.com">skimania2005@gmail.com</a>
                    </address>
                    <br>
                    <figure>
                        <blockquote class="blockquote">
                            <p>
                                Skimania.rs - Skijaši se dele na dve grupe, na one koji gledaju vremensku prognozu i na one koji imaju dobru opremu! 
                            </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Kupite svoju opremu online i osigurajte sebi zimski odmor - <cite title="Plodovi.rs">Skimania.rs</cite>
                        </figcaption>
                    </figure>
                    <a href="stampa.php" type="button" class="btn btn-info">ŠTAMPANJE</a>
                    <a href="Skimania.pdf" target="_blank" type="button" class="btn btn-info">PREUZIMANJE</a>
                </div>
                <div class="col-md-6">
                    <img src="img/logo1.jpg" alt="logoOnama" class="img-thumbnail">
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