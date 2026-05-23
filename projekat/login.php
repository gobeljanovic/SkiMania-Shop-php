<?php
require_once 'config/db.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){

    //prilikom pritiska na ulogujte se dugme, vrsi se provera postojanja korisnika u bazi
    if(isset($_POST['btnLogin']))  {

        $email = trim($_POST['email'] ?? '');
        $pass = trim($_POST['pass']);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            die("Los format emaila");
        }

        $s = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($dbc, $s);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $rez = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($rez)){
            if(password_verify($pass, $row['password'])){
                // Uspešan login
                $_SESSION['korisnik'] = $row['id'];
                $_SESSION['ime'] = $row['ime'];
                $_SESSION['prezime'] = $row['prezime'];
                $_SESSION['status'] = $row['uloga'];
                $_SESSION['email'] = $row['email'];

                if(isset($_POST['zapamtiMe'])){
                    setcookie( $_SESSION['ime'], $_SESSION['korisnik'], time() + 86400, "/");
                }

                mysqli_stmt_close($stmt);

                // Preusmeravanje na osnovu uloge
                if($_SESSION['status'] === 'admin'){
                    header("Location: admin.php");
                } else {
                    header("Location: index1.php");
                }
                exit();
            } else {
                // Pogrešna lozinka
                header("Location: index.php?error=wrongpass");
                exit();
            }
        } else {
            // Email ne postoji
            header("Location: index.php?error=noemail");
            exit();
        }

    }
    //prilikom pritiska na dugme gost, dobija se status gosta
    else if(isset($_POST['btnGost'])){

        $_SESSION['status'] = "guest";
        header("Location: index1.php");
        exit();

    } 
    //prilikom pritiska na dugme registracija, registruje se i upisuje novi korisnik u bazu
    else if(isset($_POST['btnReg'])){
    
        $ime = trim($_POST['ime'] ?? '');
        $prezime = trim($_POST['prezime'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $pass1 =  trim($_POST['pass1'] ?? '');
        $pass2 =  trim($_POST['pass2'] ?? '');
        $uloga = "user";

        if($pass1!==$pass2){
                header("Location: index.php");
                exit();
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                header("Location: index.php");
                exit();
        }

        $hash = password_hash($pass1,PASSWORD_DEFAULT);

        $s = "INSERT INTO users (ime,prezime,email,password,uloga)
                    VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($dbc,$s);
        mysqli_stmt_bind_param($stmt,"sssss",$ime,$prezime,$email,$hash,$uloga);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: index.php");
    }

}


?>