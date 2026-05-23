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
    <meta name="description" cintent="Informacije o poslatim podacima">
    <meta name="keywords" content="">
    <meta name="autor" content="Djordje, Gobeljić, djordjenrt4023@gs.viser.edu.rs">

    <link rel="stylesheet" href="css/style.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./fontawesome/css/all.min.css">
    <title>Izlazna strana</title>
</head>
<body style="background-image: url('img/loginWallpaper.jpeg'); background-size: cover; background-repeat: no-repeat; background-position: center;">

    <nav class="navbar navbar-expand-lg bg-body-tertiary"> <!--NAVIGACIJA-->
        <div class="container-fluid">
          <a href="index1.php" class="navbar-brand"><img class="logoNav" src="img/logo1.jpg" alt="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index1.php">Početna</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="onama.php">O nama</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="galerija.php">Galerija</a>
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
            </ul>
          </div>
        </div>
    </nav>

    <?php 
    if(isset($_POST['poruka'])):
      $user_id = intval($_SESSION['korisnik']);
      $telefon = trim($_POST['telefon'] ?? '');
      $naslov = trim($_POST['naslov'] ?? '');
      $sadrzaj = trim($_POST['sadrzaj'] ?? '');

      $s = "INSERT INTO poruke_klijenata 
            (user_id,telefon,naslov,sadrzaj) VALUES (?,?,?,?)";
      $stmt = mysqli_prepare($dbc,$s);
      mysqli_stmt_bind_param($stmt,"isss",$user_id,$telefon,$naslov,$sadrzaj);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      ?>

    
    <section style="margin: 20px;" id="izlaznaStranaSekcija">
      <div class="container">
        <h1 class="display-4" style="color:#217c92">
            Obaveštenje o poslatoj poruci
        </h1>
        <hr>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading" style="color:#217c92">Uspešno poslato! <i class="fa-solid fa-check"></i></h4>
            <p class="lead">Poruka je uspešno poslata! Hvala vam na ukazanom poverenju! Uskoro će vam na mail stići odgovor!</p>
            <hr>
            <p class="mb-0 lead">Ukoliko Vas zanima jos nešto od artikala, možete se vratiti na <a href="index1.php" style="text-decoration: none;">početnu stranu</a></p>
          </div>
      </div>
    </section>

    <?php else:?>
    <section style="margin: 20px;" id="izlaznaStranaSekcija">
      <div class="container">
        <h1 class="display-4" style="color:#217c92">
            Obaveštenje o poslatoj poruci
        </h1>
        <hr>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading" style="color:#217c92">Neuspesno poslato!  <i class="fa-solid fa-x"></i></h4>
            <p class="lead">Poruka nije poslata!</p>
            <hr>
            <p class="mb-0 lead">Ukoliko Vas zanima jos nešto od artikala, možete se vratiti na <a href="index1.php" style="text-decoration: none;">početnu stranu</a></p>
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
            <a href="mapasajta.php">Mapa sajta</a>
            <a href="galerija.php">Galerija</a>
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