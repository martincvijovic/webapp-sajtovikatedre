<?php
    $sifra = $_GET['sifra'];

    require("mysql_functions.php");
    $handle = dbConnect();
    // Pretpostavljamo ispravnu sifru predmeta (dohvata se iz baze, ne bi trebalo da ima neispravnosti)
    $row = mysqli_fetch_assoc(mysqli_query($handle, "select * from predmet where sifra_predmet='".$sifra."'"));

    // Trazimo sve zaposlene na tom predmetu
    $result = mysqli_query($handle, "select * from drzi_predmet where sifra_predmet='".$sifra."'");

    dbDisconnect($handle, false);
?>

<script src="validate.js"></script>
<script src="ckeditor/ckeditor.js"></script>


<h2><b><?php echo $row['naziv'] ?></b></h2>

<form method="POST" onSubmit="return validateProfIzmeniInfoPredmet();">
    <p>Fond casova: <input type="text" name="fond_casova" id="fond_casova" value="<?php echo $row['fond_casova'] ?>"></p>
    <p>Broj ESPB: <input type="text" name="broj_ESPB" id="broj_ESPB" value="<?php echo $row['broj_ESPB'] ?>"></p>
    <p>Cilj predmeta: <textarea class="ckeditor" rows="4" cols="50" name="cilj_predmeta" id="cilj_predmeta"><?php echo $row['cilj_predmeta'] ?></textarea></p>
    <p>Ishod predmeta: <textarea class="ckeditor" rows="4" cols="50" name="ishod_predmeta" id="ishod_predmeta"><?php echo $row['ishod_predmeta'] ?></textarea></p>
    <p>Tip predmeta: 
        <select name="tip_predmeta">
            <option value="obavezni" <?php echo (strcmp($row['tip_predmeta'], "obavezni") == 0) ? "selected" : "" ?>>Obavezni</option>
            <option value="izborni" <?php echo (strcmp($row['tip_predmeta'], "izborni") == 0) ? "selected" : "" ?>>Izborni</option>
        </select>
    </p>
    <p>Komentar: <textarea class="ckeditor" rows="4" cols="50" name="komentar" id="komentar"><?php echo $row['komentar'] ?></textarea></p>
    <input type="submit" name="izmeni" value="Izmeni">
</form>

<?php
    if (isset($_POST['izmeni']))
    {
        $handle = dbConnect();
        $result_new = mysqli_query($handle, "update predmet set fond_casova=".$_POST['fond_casova'].", broj_ESPB=".$_POST['broj_ESPB'].", cilj_predmeta='".$_POST['cilj_predmeta']."', ishod_predmeta='".$_POST['ishod_predmeta']."', tip_predmeta='".$_POST['tip_predmeta']."', komentar='".$_POST['komentar']."' where sifra_predmet='".$sifra."'");
        dbDisconnect($handle, false);
        header("Location:prof_izmeni_info_predmet.php?sifra=".$sifra);
    }
?>

