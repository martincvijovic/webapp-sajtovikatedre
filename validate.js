function validateStudentUpdate()
{
    var email = document.getElementById("email").value;
    var lozinka = document.getElementById("lozinka").value;;
    var ime = document.getElementById("ime").value;;
    var prezime = document.getElementById("prezime").value;;
    var indeks = document.getElementById("indeks").value;;

    var isInputValid = true;

    if (email.length <= 13 || lozinka.length == 0 || ime.length == 0 || prezime.length == 0)
    {
        window.alert("Neispravan unos!");
        return false;
    }

    isInputValid = (email.indexOf("@etf.bg.ac.rs") == (email.length - 13)); // da se @etf.bg.ac.rs nalazi na kraju mejla

    if (indeks.length != 9 || indeks[4] != '/')
    {   
        window.alert("Neispravan unos!");
        return false;
    }

    var indeksSplitted = indeks.split("/");
    if (indeksSplitted.length != 2 || isNaN(indeksSplitted[0]) || isNaN(indeksSplitted[1]))
    {       
        window.alert("Neispravan unos!");
        return false;
    }

    if (indeksSplitted[0] > new Date().getFullYear() || indeksSplitted[0] < 1900 || indeksSplitted[1] <= 0 || indeksSplitted[1] > 750)
    {       
        window.alert("Neispravan unos!");
        return false;
    }

    
    if (!isInputValid)
    {
        window.alert("Neispravan unos!");
        return false;
    }
    else
    {
        
        return true;
    }
}

function validateZaposleniUpdate()
{
    var email = document.getElementById("email").value;
    var lozinka = document.getElementById("lozinka").value;
    var ime = document.getElementById("ime").value;
    var prezime = document.getElementById("prezime").value;
    var adresa = document.getElementById("adresa").value;
    var mobilni = document.getElementById("mobilni").value;
    var licniweb = document.getElementById("licniweb").value;
    var biografija = document.getElementById("biografija").value;
    var kabinet = document.getElementById("kabinet").value;

    var isInputValid = true;

    if (email.length <= 13 || lozinka.length == 0 || ime.length == 0 || prezime.length == 0 || adresa.length == 0 || licniweb.length == 0 || kabinet.length == 0 || biografija.length == 0)
    {
        window.alert("Neispravan unos!");
        return false;
    }

    if (isNaN(mobilni) || (mobilni.length != 10))
    {
        window.alert("Neispravan unos!");
        return false;
    }

    isInputValid = (email.indexOf("@etf.bg.ac.rs") == (email.length - 13));

    if (!isInputValid)
    {
        window.alert("Neispravan unos!");
        return false;
    }
    else
    {
       
        return true;
    }
}

function validateNewUser()
{
    var email = document.getElementById("emailnewuser").value;
    var lozinka = document.getElementById("lozinkanewuser").value;
    var ime = document.getElementById("imenewuser").value;
    var prezime = document.getElementById("prezimenewuser").value;
    var status = document.getElementById("statusnewuser").value; // select, ne treba provera
    var tipkorisnika = document.getElementById("tipkorisnikanewuser").value; // select, ne treba provera

    var isInputValid = true;

    if (email.length <= 13 || lozinka.length == 0 || ime.length == 0 || prezime.length == 0)
    {
        window.alert("Neispravan unos!");
        return false;
    }

    isInputValid = (email.indexOf("@etf.bg.ac.rs") == (email.length - 13)); // da se @etf.bg.ac.rs nalazi na kraju mejla

    if (!isInputValid)
    {
        window.alert("Neispravan unos!");
    }
    

    return isInputValid;
}

function validateNewGeneralNotification()
{
    var naslov = document.getElementById("naslov").value;
    var sadrzaj = CKEDITOR.instances.sadrzaj.getData();

    if (sadrzaj.length > 0 && naslov.length > 0)
    {
        return true;
    }
    
    window.alert("Polje za unos ne sme biti prazno!");
    return false;
}

function validateNewGeneralNotificationCategory()
{
    var naziv_kat = document.getElementById("imekategorije").value;

    if (naziv_kat.length > 0)
    {
        return true;
    }

    window.alert("Polje za unos ne sme biti prazno!");
    return false;
}