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
    <title>SkiMania Registracija</title>
</head>
<body style="background-image: url('img/loginWallpaper.jpeg'); 
             background-size: cover; 
             background-repeat: no-repeat; 
             background-position: center;">

    <h1 class="skimania-naslov d-flex justify-content-center align-items-center">SkiMaina Registracija</h1>
    <hr>
    <div class="container col-sm-12"> 
        <form action="login.php" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-white">Ime</label>
                    <input type="text" name="ime" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label text-white">Prezime</label>
                    <input type="text" name="prezime" class="form-control" required>
                </div>
            </div>

                <div class="mb-3">
                    <label class="form-label text-white">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-white">Lozinka</label>
                        <input type="password" name="pass1" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label text-white">Potvrdi lozinku</label>
                        <input type="password" name="pass2" class="form-control" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 pt-4">
                            <button type="submit" name="btnReg" class="btn btn-success w-100 mt-2"> Registruj se </button>
                    </div>
                </div>
            </form>
        </div>

      <script src="./js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="./fontawesome/js/all.min.js"></script>
    </body>
</html>
