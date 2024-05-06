<?php
/*
Descrizione
Dobbiamo creare una pagina che permetta ai nostri utenti di utilizzare il nostro generatore di password (abbastanza) sicure.
L’esercizio è suddiviso in varie milestone ed è molto importante svilupparle in modo ordinato.

Milestone 1
Creare un form che invii in GET la lunghezza della password. Una nostra funzione utilizzerà questo dato per generare una password casuale (composta da lettere, lettere maiuscole, numeri e simboli) da restituire all’utente.
Scriviamo tutto (logica e layout) in un unico file index.php

Milestone 2
Verificato il corretto funzionamento del nostro codice, spostiamo la logica in un file functions.php che includeremo poi nella pagina principale

Milestone 3 (BONUS)
Invece di visualizzare la password nella index, effettuare un redirect ad una pagina dedicata che tramite $_SESSION recupererà la password da mostrare all’utente.
Milestone 4 (BONUS)
Gestire ulteriori parametri per la password: quali caratteri usare fra numeri, lettere e simboli. Possono essere scelti singolarmente (es. solo numeri) oppure possono essere combinati fra loro (es. numeri e simboli, oppure tutti e tre insieme).
Dare all’utente anche la possibilità di permettere o meno la ripetizione di caratteri uguali.
*/

$userPasswordLength = isset($_GET['pw-length']) ? intval($_GET['pw-length']) : '';
$password = '';

if(!emptty($userPasswordLength)) {

    $allAvailableChars = getAvailableChars();

    $password = generatePassword($userPasswordLength, $allAvailableChars);
}

function generatePassword($passwordLength, $passwordChars) {
    
    $password = '';

    for($i=0; $i < $passwordLength; $i++) {
        $randomIndex = rand(0, count($passwordChars) - 1);
        $password .= $passwordChars($randomIndex);
    }

    return $password;
}

function getAvailableChars() {
    $lowercaseChars = range('a', 'z');
    $uppercaseChars = range('A', 'Z');
    $numbers = range(0, 9);
    $specialChars = ('-', '!');

    $allChars = array_merge($lowercaseChars, $uppercaseChars, $numbers, $specialChars);

    return $allChars;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PW Gen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <p>
            <?php echo empty($password) ? 'Fill the form' : 'Your password is:' ?>
        </p>
    </div>
    
    <div class="container">
        <form method="get">
            <div class="mb-3">
                <label for="pw-length" class="form-label">Password Length:</label>
                <input name="pwLength" id="pw-length" type="number" class="form-control" value="<?php echo $userPasswordLength ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>    

</body>
</html>