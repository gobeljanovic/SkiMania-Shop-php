<?php
    require_once 'config/db.php';

    if(!isset($_SESSION['status']) || !isset($_GET['id']) || empty($_GET['id'])){
        header("Location: index.php");
        exit();
    }

    $id = intval($_GET['id']);
    $s = "SELECT * FROM proizvodi_kat WHERE id=?";
    $stmt = mysqli_prepare($dbc,$s);
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    $rez = mysqli_stmt_get_result($stmt);
    $r1 = mysqli_fetch_assoc($rez);
    mysqli_stmt_close($stmt);

    //kreiranje sesije za korpu
    if(isset($_POST['dodaj_korpu'])){

      $proizvod_id = intval($_POST['proizvod_id']);
      $velicina = $_POST['velicina'];

      if(empty($velicina)){
          echo "<script>alert('Morate izabrati velicinu!');</script>";
      } else {

          if(!isset($_SESSION['korpa'])){
              $_SESSION['korpa'] = [];
          }

          // Ako proizvod već postoji u korpi
          if(isset($_SESSION['korpa'][$proizvod_id])){
              $_SESSION['korpa'][$proizvod_id]['kolicina']++;
          } else {
              $_SESSION['korpa'][$proizvod_id] = [
                  'kolicina' => 1,
                  'velicina' => $velicina
              ];
          }

          echo "<script>alert('Proizvod dodat u korpu!');</script>";
      }
}
    //print_r($r1);
    //print_r($_SESSION['korpa'][$proizvod_id]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" cintent="Detaljnije predstavljene skije ELAN VOYAGER">
    <meta name="keywords" content="ELAN, VOYAGER">
    <meta name="autor" content="Djordje, Gobeljić, djordjenrt4023@gs.viser.edu.rs">

    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <title><?php echo $r1['naziv'];?></title>
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

    <section class="skije-Snowboard-Sekcija"> <!--stavio sam klasu kako bi se odnosilo na ostale dokumente-->
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6"> <!--slika proizvoda-->
                    <img src="<?php echo $r1['slika'];?>" alt="<?php echo $r1['naziv'];?>" class="img-thumbnail">
                </div>
              
                <form class="col-md-6 col-lg-6 skija_detaljnije" method="POST">
                    <input type="hidden" name="proizvod_id" value="<?php echo $r1['id']; ?>">
                    <h1 class="display-5 skiNaslov"><?php echo ceil($r1['cena']);?> RSD</h1>
                    <hr>
                    <p>Opis: <?php echo $r1['opis'];?></p>
                    <hr>
                    <p class="lead"><mark><a href="tabele_velicina/<?php echo $r1['kategorija'];?>_velicina.pdf" target="_blank" style="color: black;">Tabela velicina <i class="fa-solid fa-table"></i></a></mark></p>
                    <hr>
                    <p>Velicina *</p>
                    <select class="form-select" aria-label="Default select example" name="velicina">
                        <option selected value="" required>Izaberite...</option>
                        <option value="<?php echo $r1['velicina']?>"><?php echo $r1['velicina']?></option>
                    </select>
                    
                    <?php if($_SESSION['status']!=='guest'):?>
                    <button type="submit" name="dodaj_korpu" class="btn btn-success btn-lg" 
                        style="margin-left: 40%; margin-top: 20px;">
                        Dodaj u korpu <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                <?php else:?>
                  <section style="margin: 20px;" id="izlaznaStranaSekcija">
                    <div class="container">
                      <div class="alert alert-success" role="alert">
                          <h4 class="alert-heading" style="color:#217c92">Ukoliko zelite da porucite artikle iz nase prodavnice morate imati nalog</h4>
                          <p class="lead"><a href="registracija.php" class="btn btn-outline-confirm w-100">
                            <i class="fas fa-sign-out-alt"></i> Kreirajte nalog </a></p>
                      </div>
                    </div>
                </section>
                <?php endif;?>
                    
            </form>
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


      <script src="js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="fontawesome/js/all.min.js"></script>
    </body>
</html>