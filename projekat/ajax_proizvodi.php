<?php
require_once 'config/db.php';

if(isset($_GET['kategorija']) && !empty($_GET['kategorija'])){

    $idKat = intval($_GET['kategorija']);

    $s = "SELECT * FROM proizvodi_kat WHERE kategorija_id = ?";
    $stmt = mysqli_prepare($dbc, $s);
    mysqli_stmt_bind_param($stmt,"i",$idKat);
    mysqli_stmt_execute($stmt);
    $rez = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($rez) > 0){
        echo '<div class="table-responsive">';
        echo '<table class="table table-dark table-striped table-hover align-middle text-center">';
        echo '<thead class="table-success text-dark">
                <tr>
                    <th>Slika</th>
                    <th>Naziv</th>
                    <th>Kategorija</th>
                    <th>Cena</th>
                    <th>Količina</th>
                    <th>Izmena</th>
                </tr>
              </thead><tbody>';

        while($r = mysqli_fetch_assoc($rez)){
            echo "<tr>
                    <td><img src='{$r['slika']}' width='80' class='img-thumbnail'></td>
                    <td>{$r['naziv']}</td>
                    <td>{$r['kategorija']}</td>
                    <td>".number_format($r['cena'],2)." RSD</td>
                    <td>{$r['kolicina_na_stanju']}</td>
                    <td>
                        <a href='izmeniProizvod.php?id={$r['id']}' class='btn btn-primary btn-sm'>Izmeni</a>
                        <a href='obrisiProizvod.php?id={$r['id']}' class='btn btn-danger btn-sm'>Obriši</a>
                    </td>
                  </tr>";
        }

        echo "</tbody></table></div>";
    } else {
        echo "<p class='text-white'>Nema proizvoda za ovu kategoriju.</p>";
    }
}
?>