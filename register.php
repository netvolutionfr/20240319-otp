<?php
require 'vendor/autoload.php';

use OTPHP\TOTP;

$totp = TOTP::create(null, 30, 'sha256', 6, 0);
$secret = $totp->getSecret();

echo "Secret: $secret\n";
echo "<br>";

// Save this secret in file
file_put_contents('secret.txt', $secret);

$totp->setLabel('Site de démo');
$grCodeUri = $totp->getQrCodeUri(
    'https://api.qrserver.com/v1/create-qr-code/?data=[DATA]&size=300x300&ecc=M',
    '[DATA]'
);
echo "<img src='{$grCodeUri}'>";
echo "<br>";
echo "Provisioning URI: " . $totp->getProvisioningUri() . "\n";
echo "<br>";

