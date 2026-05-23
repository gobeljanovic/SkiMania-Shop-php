<?php require_once 'config/db.php';
  if(!isset($_SESSION['status'])){
    header("Location: index.php");
    exit();
  }
  if($_SESSION['status']==='guest'){
    $gost = true;
  }else{
    $gost = false;
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" cintent="Posaljite svoju poruku i kontaktirajte nas - SkiMania">
    <meta name="keywords" content="Lokacija, Poruka">
    <meta name="autor" content="Djordje, Gobeljić, djordjenrt4023@gs.viser.edu.rs">

    <link rel="stylesheet" href="css/style.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./fontawesome/css/all.min.css">
    <title>Kontakt-SkiMania</title>
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
                <a class="nav-link active" href="kontakt.php">Kontakt</a>
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
    
    <?php if(!$gost):?>
    <section style="margin-bottom: 20px;" id="kontaktSekcija"> <!--KONTAKT ZA ULOGOVANE KORISNIKE-->
      <div class="container pt-3"> 
        <h1 class="display-4 text-center mark" style="color: #005e6e;">Lokacija <i class="fa-solid fa-map-pin" style="font-size: 75%;"></i></h1>
        <hr>
      </div>
      <div class="map-container" style="margin: 10px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2888.4746226926445!2d21.005072483910798!3d43.6174795527279!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475658b3439be01f%3A0xeab7536936e5ea26!2sKneginje%20Milice%2058%2C%20Trstenik!5e0!3m2!1sen!2srs!4v1734959928674!5m2!1sen!2srs" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="container">
        <h1 class="display-4 text-center mark" style="color: #005e6e;">Ostavite nam poruku</h1>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <form action="izlaznaStrana.php" method="POST"> <!--forma-->
            
                <div class="mb-3">
                  <label for="phone" class="form-label text-white"><i class="fa-solid fa-phone"></i> Telefon</label>
                  <input type="text" name="telefon" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unesite vaš broj telefona" required>
                </div>
                <div class="mb-3">
                  <label for="text" class="form-label text-white"><i class="fa-solid fa-heading"></i> Naslov poruke</label>
                  <input type="text" name="naslov" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Unesite naslov poruke" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputMessage1" class="text-white"><i class="fa-solid fa-message"></i> Sadržaj poruke</label>
                  <textarea class="form-control" name="sadrzaj" placeholder="Unesite poruku" id="floatingTextarea2" style="height: 100px" rows="5" id="exampleInputMessage1" required></textarea>
                </div>
              
                <div class="d-grid gap-2">
                     <input type="submit" name="poruka" class="btn btn-primary" href="izlaznaStrana.php" value="Posalji">
                </div>
            </form>
          </div>

        </div>
      </div>
    </section>
    <?php else:?>
    <section style="margin: 20px;" id="izlaznaStranaSekcija">
        <div class="container">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading" style="color:#217c92">Ukoliko zelite da nam posaljete poruku morate kreirati nalog</h4>
                <p class="lead"><a href="registracija.php" class="btn btn-outline-success w-100">
                <i class="fas fa-sign-out-alt"></i> Kreirajte nalog </a></p>
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