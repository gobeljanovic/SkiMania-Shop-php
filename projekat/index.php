<?php require_once 'config/db.php';?>
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
    <title>SkiMania Shop Login</title>
</head>
<body style="background-image: url('img/loginWallpaper.jpeg'); 
             background-size: cover; 
             background-repeat: no-repeat; 
             background-position: center;">

    <h1 class="skimania-naslov d-flex justify-content-center align-items-center">SkiMaina Prijava</h1>
    <hr>
    <div class="container h-100 d-flex justify-content-center align-items-center pt-5">
        <div class="logDiv px-5">
        <form action="login.php" method="POST">
            <div class="mt-3 mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text text-white">Necemo podeliti vasu email adresu.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" >Lozinka</label>
                <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="zapamtiMe" value="1" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Zapamti me</label>
            </div>
            <div class="row mb-3 pb-5">
                <div class="col-md-4 d-flex  align-items-center">
                    <button type="submit" class="btn btn-outline-info" name="btnLogin">Prijavite se</button>
                </div>
                <div class="col-md-4 d-flex  align-items-center ">
                    <a href="registracija.php" class="btn btn-outline-info">Registrujte se</a></p>
                </div>
                <div class="col-md-4 d-flex  align-items-center ">
                    <button type="submit" class="btn btn-outline-info" name="btnGost">Posetite kao gost</button>
                </div>
            </div>
        </form> 
        </div>   
    </div>

      <script src="./js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="./fontawesome/js/all.min.js"></script>
    </body>
</html>
