<?php 
require_once 'config/db.php';

if(!isset($_SESSION['status']) || $_SESSION['status'] !== 'admin'){
    header("Location: index.php");
    exit();
}
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
    <title>SkiMania Shop Admin</title>
</head>

<body style="background-image: url('img/loginWallpaper.jpeg'); background-size: cover; background-repeat: no-repeat; background-position: center;">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-50 sticky-top shadow-sm"> <!--NAVIGACIJA ADMINA-->
        <div class="container-fluid">
          <a href="index1.php" class="navbar-brand"><img class="logoNav" src="img/logo1.jpg" alt="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="admin.php">Početna</a>
              </li>
              <li class="nav-item">
                <a href="poruke.php" class="nav-link" href="#svePorudzbine">Poruke</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="#sviKorisnici">Korisnici</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#sviProizvodi">Proizvodi</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="#svePorudzbine">Porudzbine</a>
              </li> 
             
          </div>
        </div>
    </nav>

<div class="container pb-5">
    <div class="row pt-5">
        <h1 class="skimania-naslov d-flex justify-content-center align-items-center pb-4 ">
        Ulogovani Admin: 
        <?php echo htmlspecialchars($_SESSION['ime'] . " " . $_SESSION['prezime']); ?>
    </h1>
    <a href="logout.php" class="btn btn-outline-warning text-black">
        <i class="fas fa-sign-out-alt"></i> Odjavite se
    </a>
    </div>
</div>
    <div class="row mx-auto" id="sviKorisnici">
    
        <!-- TABELA KORISNIKA -->
        <div class="col-md-7 col-sm-12 " >
             <h4 class="display-4 d-flex justify-content-center align-items-center" style="color: #ffffff;">Tabela svih korisnika</h4>
            <hr> 
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Email</th>
                        <th>Uloga</th>
                        <th>Datum kreiranja</th>
                        <th>Akcija</th>
                        <th>Izmena</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $s = "SELECT id,ime, prezime, email, uloga, created_at 
                          FROM users 
                          ORDER BY created_at DESC";

                    $rez = mysqli_query($dbc, $s);

                    while($r = mysqli_fetch_assoc($rez)): 
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($r['ime']); ?></td>
                            <td><?php echo htmlspecialchars($r['prezime']); ?></td>
                            <td><?php echo htmlspecialchars($r['email']); ?></td>
                            <td><?php echo htmlspecialchars($r['uloga']); ?></td>
                            <td>
                                <?php 
                                $datum = date_create($r['created_at']);
                                echo date_format($datum, 'd.m.Y');
                                ?>  
                            </td>
                            <td>
                                <?php if($r['id'] != $_SESSION['korisnik']): ?>
                                <a href="obrisiKorisnika.php?id=<?php echo $r['id']; ?>" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Da li ste sigurni da želite da obrišete korisnika?');"> <i class="fas fa-trash"></i>
                                Obriši
                                </a>
                                <?php else: ?>
                                <span class="text-muted">Ne možeš obrisati sebe</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="izmenaKorisnika.php?id=<?php echo $r['id']; ?>" 
                                    class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Izmeni</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
        </div>

        <!-- DODAVANJE KORISNIKA -->
        <div class="col-md-5 col-sm-12">
            <h4 class="display-4 d-flex justify-content-center align-items-center " style="color: #ffffff;">Dodaj korisnika</h4>
            <hr> 

            <form action="dodajKorisnika.php" method="POST">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-white">Ime</label>
                    <input type="text" name="dodajIme" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label text-white">Prezime</label>
                    <input type="text" name="dodajPrezime" class="form-control" required>
                </div>
            </div>

                <div class="mb-3">
                    <label class="form-label text-white">Email</label>
                    <input type="email" name="dodajEmail" class="form-control" required>
                </div>
                
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label text-white">Lozinka</label>
                        <input type="password" name="dodajPass1" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label text-white">Potvrdi lozinku</label>
                        <input type="password" name="dodajPass2" class="form-control" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="mb-3 col-md-5">
                        <label class="form-label text-white">Uloga</label>
                        <select name="dodajUloga" class="form-select" required>
                            <option value="">Izaberite...</option>
                            <?php
                            $s = "SELECT DISTINCT uloga FROM users";
                            $rez = mysqli_query($dbc, $s);

                            while($r = mysqli_fetch_assoc($rez)):
                            ?>
                                <option value="<?php echo htmlspecialchars($r['uloga']); ?>"><?php echo htmlspecialchars($r['uloga']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-7 pt-4">
                            <button type="submit" name="dodajBtnDodaj" class="btn btn-success w-100 mt-2"> Dodaj korisnika </button>
                    </div>
                </div>
            </form>
        </div>
    <hr>
    <div class="container" id="sviProizvodi"> <!-- Prikaz svih artikala izabrane kategorije -->
        <div class="row mx-auto">
            <form class="mb-3 row" id="formaKategorija"> <!-- Ovo radimo pomocu ajaxa -->
                <div class="col-md-4">
                    <select name="kategorija" id="kategorijaSelect" class="form-select">
                        <option value="">Izaberite kategoriju</option>
                        <?php $rez = mysqli_query($dbc,"SELECT * FROM kategorije");
                            while($r = mysqli_fetch_assoc($rez)):?>
                        <option value="<?php echo $r['id'];?>"><?php echo $r['naziv'];?></option>
                        <?php endwhile;?>
                    </select>
                </div>
            </form>
            <div id="rezultatProizvodi">
                
            </div>
            
            <div class="col-md-12"> <!-- Dodavanje proizvoda -->
                <div class="card shadow-lg p-4 bg-dark text-white">
                    <h3 class="mb-4 text-center">Dodaj novi proizvod</h3>
                    <form action="dodajProizvod.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Naziv -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Naziv proizvoda</label>
                                <input type="text" name="naziv" class="form-control" placeholder="Unesite naziv" required>
                            </div>
                            <!-- Cena -->
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Cena (RSD)</label>
                                <input type="number" step="0.01" name="cena" class="form-control" placeholder="0.00" required>
                            </div>
                            <!-- Količina -->
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Količina</label>
                                <input type="number" name="kolicina" class="form-control" placeholder="0" required>
                            </div>
                        </div>
                        <!-- Dužina skija -->
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="form-label">Velicina (Skije i Snowboard u cm/Ostalo po velicinama xl,l..)</label>
                                <input type="text" name="duzina" class="form-control" placeholder="npr. 170 / XL L" required>
                            </div>
                        </div>
                        <!-- Opis -->
                        <div class="mb-3">
                            <label class="form-label">Opis proizvoda</label>
                            <textarea name="opis" rows="4" class="form-control"
                                placeholder="Unesite detaljan opis proizvoda..."></textarea>
                        </div>
                        <div class="row">
                            <!-- Kategorija -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kategorija</label>
                                <select name="kategorija_id" class="form-select" required>
                                    <option value="">Izaberi kategoriju</option>
                                    <?php
                                    $rez = mysqli_query($dbc,"SELECT * FROM kategorije");
                                    while($r = mysqli_fetch_assoc($rez)): ?>
                                        <option value="<?php echo $r['id']; ?>">
                                            <?php echo $r['naziv']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <!-- Upload slike -->
                            <div class="col-md-4 mb-4">
                                <label for="slika" class="form-label">Slika proizvoda</label>
                                <input class="form-control" type="file" id="slika" name="slika" required>
                            </div>
                            <!-- Dugme -->
                            <div class="col-md-4 text-center pt-4">
                                <button type="submit" class="btn btn-success btn-lg" name="dodajProizvod">
                                    <i class="fas fa-plus-circle "></i> Dodaj proizvod
                                </button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div> <hr>
    <div class="container">
        <h1 class="display-4 d-flex justify-content-center align-items-center" style="color: #ffffff;" id="svePorudzbine">Neisporucene porudzbine</h1>
          <table class="table table-dark table-striped table-hover align-middle text-center">
                <thead class="table-success text-dark">
                    <tr>
                        <th>Narudzbina</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Cena</th>
                        <th>Datum porucivanja</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $s = "SELECT p.id as idNarudzbine, u.ime as ime, u.prezime as prezime, p.user_id as idKorisnika, p.datum as datum, p.ukupna_cena as cena, p.status as status
                          FROM porudzbine p JOIN users u
                          ON  p.user_id = u.id
                          ORDER BY p.datum";

                    $rez = mysqli_query($dbc, $s);

                    while($r = mysqli_fetch_assoc($rez)): 
                    ?>
                        <tr>
                            
                            <td><?php echo htmlspecialchars($r['idNarudzbine']); ?></td>
                            <td><?php echo htmlspecialchars($r['ime']); ?></td>
                            <td><?php echo htmlspecialchars($r['prezime']); ?></td>
                            <td><?php echo htmlspecialchars(ceil($r['cena'])); ?></td>
                            <td>
                                <?php 
                                $datum = date_create($r['datum']);
                                echo date_format($datum, 'd.m.Y');
                                ?>  
                            </td>
                            <td><?php echo htmlspecialchars($r['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>                                  
    </div>
    
</div>

<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./fontawesome/js/all.min.js"></script>

<script>//Ajax deo koda za izabranu kategoriju za prikaz artikala
document.getElementById("kategorijaSelect").addEventListener("change", function(){

    let kategorija = this.value;

    if(kategorija === ""){
        document.getElementById("rezultatProizvodi").innerHTML = "";
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "ajax_proizvodi.php?kategorija=" + kategorija, true);

    xhr.onload = function(){
        if(this.status === 200){
            document.getElementById("rezultatProizvodi").innerHTML = this.responseText;
        }
    };

    xhr.send();
});
</script>
</body>
</html>

