<?php 
require_once 'config/db.php';

if(!isset($_SESSION['status']) || $_SESSION['status'] !== 'admin'){
    header("Location: index.php");
    exit();
}
$s = "SELECT p.id as idPoruke, u.ime as ime, u.prezime as prezime, p.naslov as naslov, p.sadrzaj as sadrzaj, p.datum_slanja as datum
      FROM poruke_klijenata p JOIN users u
      ON p.user_id = u.id
      ORDER BY datum ASC";
$stmt = mysqli_prepare($dbc,$s);
mysqli_stmt_execute($stmt);
$rez = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Prodaja skija, snowboard-ova i opreme za zimske sportove">
    <meta name="keywords" content="Ski, Skije, Snowboard, Pancerice, Čizme, Oprema">
    <meta name="author" content="Djordje Gobeljic">

    <link rel="stylesheet" href="css/style.css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <title>Poruke klijenata</title>
</head>

<body style="background-image: url('img/loginWallpaper.jpeg'); background-size: cover; background-repeat: no-repeat; background-position: center;">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 sticky-top shadow-sm"> <!--NAVIGACIJA-->
        <div class="container-fluid">
          <a href="index1.php" class="navbar-brand"><img class="logoNav" src="img/logo1.jpg" alt="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="admin.php">Početna</a>
              </li> 
              <li class="nav-item">
                <a href="poruke.php" class="nav-link active" href="#svePorudzbine">Poruke</a>
              </li> 
          </div>
        </div>
</nav>

    <?php if(mysqli_num_rows($rez)!=0):?> <!-- Stampanje poruka ukoliko ih ima -->
    <section id="porukeSekcija" style="margin: 20px 0px;">
        <div class="container">
            <h1 class="display-5 text-center mark" style="color: #005e6e;">Poruke klijenata</h1>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="accordion" id="accordionExample"> 
                        <?php while($r = mysqli_fetch_assoc($rez)):?>
                        <div class="accordion-item"> <!--PORUKE-->
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $r['idPoruke'];?>" aria-expanded="true" aria-controls="collapse<?php echo $r['idPoruke'];?>">
                                <?php echo "{$r['ime']} {$r['prezime']} : {$r['naslov']}";?>
                            </button>
                          </h2>
                          <div id="collapse<?php echo $r['idPoruke'];?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                               <?php 
                               $datum = date_create($r['datum']);
                               echo "{$r['sadrzaj']} - " . date_format($datum, 'd.m.Y')
                               ?> 
                            </div>
                          </div>
                        </div>
                        <?php endwhile;?>
                   </div>  
                </div>
            </div>
        </div>

    </section>
    <?php else:?>
      <section style="margin: 20px;" id="izlaznaStranaSekcija">
      <div class="container">
        <h1 class="display-4 text-center mark" style="color: #005e6e;">
            Obaveštenje o porukama klijenata
        </h1>
        <hr>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading" style="color:#217c92">Sanduce sa porukama je prazno </h4>
            <p class="lead">Trenutno nema ostavljenih poruka</p>
            </div>
      </div>
    </section>
    <?php endif;?>
    
</div>

<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./fontawesome/js/all.min.js"></script>
</body>
</html>

