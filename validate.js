function validateUserUpdate()
{
    var email = document.getElementById("email").value;
    var lozinka = document.getElementById("lozinka").value;;
    var ime = document.getElementById("ime").value;;
    var prezime = document.getElementById("prezime").value;;
    var indeks = document.getElementById("indeks").value;;

    var isInputValid = true;

    if (email.length == 0 || lozinka.length == 0 || ime.length == 0 || prezime.length == 0)
    {
        isInputValid = false;
    }

    if (indeks.length != 9 || indeks[4] != '/')
    {   
        isInputValid = false;
    }

    var indeksSplitted = str.split(indeks);
    if (indeksSplitted.length != 2 || isNaN(indeksSplitted[0]) || isNaN(indeksSplitted[1]))
    {       
        isInputValid = false;
    }

    if (indeksSplitted[0] > new Date().getFullYear() || indeksSplitted[0] < 1900 || indeksSplitted[1] <= 0 || indeksSplitted[1] > 750)
    {       
        isInputValid = false;
    }

    if (!isInputValid)
    {
        window.alert("Neispravan unos!");
    }

    window.alert(indeks);

    return isInputValid;
}