<?php
require 'vendor/autoload.php';

use OTPHP\TOTP;

$secret = file_get_contents('secret.txt');
$totp = TOTP::createFromSecret($secret, 30, 'sha256', 6, 0);

// Pour vérifier un code TOTP
$code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT);
if ($code !== null) {
    $isValid = $totp->verify($code);

    if ($isValid) {
        echo 'Le code TOTP est valide.';
        echo "<br>";
    } else {
        echo 'Le code TOTP est invalide.';
        echo "<br>";
    }
    exit;
} else {
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vérif code</title>
</head>
<body>
<form action="verif.php" method="get">
    <label for="code">Code TOTP :</label>
    <input id="code" name="code" type="number">
    <input type="submit" value="Vérifier">
</form>
</body>
</html>
<?php
}
