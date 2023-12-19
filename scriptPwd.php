<?php

$handle = fopen("php://stdin", "r");
echo "Entrez votre mot de passe : ";
$password = trim(fgets($handle));
fclose($handle);

$hashPwd = password_hash($password, PASSWORD_BCRYPT);

echo "Mot de passe haché : " . $hashPwd . PHP_EOL;
?>