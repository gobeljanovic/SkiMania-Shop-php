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
    <meta name="description" cintent="Cesto postavljana pitanja">
    <meta name="keywords" content="Ski,Skije,Snowboard,Pnacerice,Čizme,Oprema,Jakna,Pantalone, Iznajmljivanje, Oprema">
    <meta name="autor" content="Djordje, Gobeljić, djordjenrt4023@gs.viser.edu.rs">

    <link rel="stylesheet" href="css/style.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./fontawesome/css/all.min.css">
    <title>FAQ SkiMania</title>
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

    <section id="faqSekcija" style="margin: 20px 0px;">
        <div class="container">
            <h1 class="display-4 text-center mark" style="color: #005e6e;">Često postavljana pitanja <i class="fa-solid fa-clipboard-question"></i></h1>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="accordion" id="accordionExample"> 
                        <div class="accordion-item"> <!--PRVO pitanje-->
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Koja je razlika između skija i snowboard-a?
                            </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Skije su dva odvojena dela koji se postavljaju na noge, dok se snowboard koristi kao jedan širok daskasti oblik. Skijaši se obično kreću u paralelnim pravcima, dok snowboardisti koriste tehniku koja zahteva da im obe noge budu postavljene na istoj dasci i kreću se bočno.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item"><!--DRUGO pitanje-->
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Kako da odaberem pravu veličinu skija?
                            </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Veličina skija zavisi od vaše visine, težine i nivoa skijaškog iskustva. Generalno, skije bi trebalo da budu između vašeg brada i nosa, ali to može varirati u zavisnosti od tipa skijanja (npr. freestyle, alpsko skijanje, off-piste).
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item"> <!--TRECE pitanje-->
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Kako da odaberem odgovarajući snowboard?
                            </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Izbor snowboard-a zavisi od vašeg stila vožnje (freeride, freestyle, all-mountain) i nivoa iskustva. Takođe, važno je da se vodi računa o vašoj visini i težini kako bi odabrali pravu dužinu daske.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item"><!--CETVRTO pitanje-->
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
                                Kako da odaberem odgovarajuće skijaške čizme?
                              </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                Skijaške čizme treba da budu udobne, ali i dovoljno čvrste da pružaju dobru kontrolu. Čizme se biraju prema vrsti skijanja (npr. alpsko ili freestyle) i dužini vašeg stopala. Preporučujemo da ih isprobate pre kupovine kako biste osigurali savršen fit.
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item"><!--PETO pitanje-->
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseOne">
                                Da li mogu da iznajmim opremu?
                              </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                Da, u našoj prodavnici možete iznajmiti skije, snowboard-e, čizme, štake i druge osnovne delove opreme. Iznajmljivanje opreme je odličan izbor ako ste početnik ili želite da isprobate novu opremu pre nego što je kupite.
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item"><!--SESTO pitanje-->
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseOne">
                                Da li prodajete polovnu opremu?
                              </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                Da, nudimo i polovnu opremu koja je temeljno pregledana i servisirana. Svi proizvodi su u dobrom stanju i dolaze po povoljnijim cenama.
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item"><!--SEDMO pitanje-->
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseOne">
                                Kako da održavam svoju skijašku opremu?
                              </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                Preporučujemo redovno održavanje opreme, uključujući brušenje skija i snowboard-a, kao i povremeno servisiranje skijaških čizama. Ako niste sigurni kako da se brinete o svojoj opremi, naši stručnjaci mogu vam pomoći sa savetima i uslugama održavanja.
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item"><!--OSMO pitanje-->
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseOne">
                                Da li nudiš besplatnu dostavu?
                              </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                Nudimo besplatnu dostavu za porudžbine koje prelaze određeni iznos. Detalje o besplatnoj dostavi možete proveriti na našem sajtu ili kontaktirati naš tim za više informacija.
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item"><!--DEVETO pitanje-->
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseOne">
                                Koje opcije plaćanja su dostupne?
                              </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                Prihvatamo različite opcije plaćanja, uključujući gotovinu, kartice, kao i online plaćanje putem sigurnih platformi. Takođe, nudimo mogućnost plaćanja na rate.
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item"><!--DESETO pitanje-->
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="true" aria-controls="collapseOne">
                                Da li imate popuste na veću količinu ili sezonske akcije?
                              </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                Nudimo popuste na sezonske akcije, kao i specijalne ponude za grupe i timove. Pratite našu web stranicu i društvene mreže za obaveštenja o trenutnim akcijama i promocijama.
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