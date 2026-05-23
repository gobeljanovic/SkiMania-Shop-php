<?php require_once 'config/db.php';

    if(isset($_POST['dodajBtnDodaj']))
    {
        $ime = trim($_POST['dodajIme']);
        $prezime = trim($_POST['dodajPrezime']);
        $email = trim($_POST['dodajEmail'] ?? '');
        $pass1 =  trim($_POST['dodajPass1']);
        $pass2 =  trim($_POST['dodajPass2']);
        $uloga = $_POST['dodajUloga'];

        if($pass1!==$pass2){
            header("Location: admin.php");
            exit();
        }
        

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            header("Location: admin.php");
            exit();
        }
        $hash = password_hash($pass1,PASSWORD_DEFAULT); //hashujemo sifru

        $s = "INSERT INTO users (ime,prezime,email,password,uloga)
                VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($dbc,$s);
        mysqli_stmt_bind_param($stmt,"sssss",$ime,$prezime,$email,$hash,$uloga);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: admin.php");

    } else{
         header("Location: admin.php");
    }

?>