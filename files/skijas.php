<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        Hello <?php session_start(); echo $_SESSION['ime']?>
        <br/>
        <b>Pretraga opreme:</b>
        <form method="get" action=''>
            Naziv: <input type='text' name='naziv'>
            Vrsta:<input type='text' name='vrsta'>
            <input type='submit' name='pretraga' value='Pretraga'>
        
        <table>
        <?php
         if(isset($_GET['pretraga'])){?>
            <tr>
                <td>Idopreme</td>
                <td>Naziv</td>
                <td>Vrsta</td>
                <td>Kolicina</td>
            </tr><?php
             $con = mysqli_connect('localhost', 'root', '', 'skiskolica');
             if(mysqli_connect_errno()){
                 echo "Greska pri konektovanju";
                 exit();
             }
             $result = mysqli_query($con, "select * from skioprema where naziv like '%".$_GET['naziv']."%'"
                     . " and vrsta like '%".$_GET['vrsta']."%'");
             
             if(mysqli_num_rows($result)>0){
                 while($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?php echo $row['idopreme']?></td>
                        <td><?php echo $row['naziv']?></td>
                        <td><?php echo $row['vrsta']?></td>
                        <td><?php echo $row['kolicina']?></td>
                        <td>
                            <input type='checkbox' name='narucivanje[]' 
                                   value='<?php echo $row['idopreme']?>'>
                        </td>
                        <?php
                            if($row['kolicina']==0) { ?>
                                <td>
                                    <span style='color:red'>Nema na stanju</span>
                                </td>
                            <?php
                            
                            }
                        ?>
                    </tr><?php
                 }
             }
             else{
                 echo 'Nema opreme';
             }
             
             mysqli_free_result($result);
             mysqli_close($con);
         }
        ?>
        </table>
        <input type='submit' name='naruci' value='Naruci'>
        </form>
        <?php
            if(isset($_GET['naruci'])){
                if(isset($_GET['narucivanje'])){
                    if(sizeof($_GET['narucivanje'])>=3){
                        $imapopust = 1;
                    }
                    else {
                        $imapopust = 0;
                    }
                    for($i=0; $i<sizeof($_GET['narucivanje']); $i++){
                        $con = mysqli_connect('localhost', 'root', '', 'skiskolica');
                        if(mysqli_connect_errno()){
                            echo "Greska pri konektovanju";
                            exit();
                        }
                        $result = mysqli_query($con, "insert into iznajmljivanje (datumpreuz, idkorisnik,"
                                . " idopreme, imapopust, razduzeno) values ('".date('Y-m-d')."','".$_SESSION['user']."',"
                                . "".$_GET['narucivanje'][$i].",".$imapopust.",0)");
                        
                        if(!$result){
                            echo 'Greska pri ubacivanju u bazu';
                        }
                        
                        $result = mysqli_query($con, "update skioprema set kolicina=kolicina-1"
                                . " where idopreme=".$_GET['narucivanje'][$i]);
                        
                        mysqli_close($con);
                    }
                }
                else{
                    echo 'Niste izabrali opremu';
                }
            }
        ?>
        <form method="get" action=''>
            <select name='racun'>
                <?php
                    $con = mysqli_connect('localhost', 'root', '', 'skiskolica');
                    if(mysqli_connect_errno()){
                        echo "Greska pri konekciji sa bazom";
                        exit();
                    }
                    $result = mysqli_query($con, "select * from iznajmljivanje where"
                            . " idkorisnik='".$_SESSION['user']."' and razduzeno=0");
                    
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <option value="<?php echo $row['idracun']?>"><?php echo $row['idracun']?></option>
                        <?php
                        
                        }
                    }
                    else{
                        echo 'Nema racuna';
                    }
                    
                    mysqli_free_result($result);
                    mysqli_close($con);
                ?>
            </select>
            <input type="submit" name="vracanje" value="Vracanje">
        </form>
        <?php
            function razlikaudanima($datum){
                $niz = explode('-', $datum);
                $datum = mktime(0,0,0,$niz[1], $niz[2], $niz[0]);
                $trenutni = time();
                
                $razlika = $trenutni - $datum;
                
                $dan = floor($razlika/(24*60*60));
                if($dan == 0) return 1; else $dan;
            }
            if(isset($_GET['vracanje'])){
                $con = mysqli_connect('localhost', 'root', '', 'skiskolica');
                if(mysqli_connect_errno()){
                    echo "Greska pri konekciji sa bazom";
                    exit();
                }
                
                $result = mysqli_query($con, "select * from iznajmljivanje where idracun=".$_GET['racun']);
                $row = mysqli_fetch_assoc($result);
                
                $result2 = mysqli_query($con, "select cenapodanu from skioprema where idopreme=".$row['idopreme']);
                $row2 = mysqli_fetch_assoc($result2);
                
                if($row['imapopust']==1){
                    $cena = razlikaudanima($row['datumpreuz'])*$row2['cenapodanu']*0.8;
                }
                else{
                    $cena = razlikaudanima($row['datumpreuz'])*$row2['cenapodanu'];
                }
                
                $result = mysqli_query($con, "update iznajmljivanje set razduzeno=1, "
                        . "ukupno_naplata=".$cena." where idracun=".$_GET['racun']);
                
                $result = mysqli_query($con, "update skioprema set kolicina=kolicina+1 "
                        . "where idopreme=".$row['idopreme']);
                
                mysqli_close($con);
            }
        ?>
    </body>
</html>
