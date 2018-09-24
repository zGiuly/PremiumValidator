<?php
/**
 * @author zGiuly
 * Index file
 */
include 'PremiumRequest.php';
include 'settings.php';
$Premium = new PremiumRequest($_GET['username']);
if($settings['json_response'] == true) {
    header('Content-Type: application/json');
    $info = ["premium" => $Premium->validPremium(), "nicklist" => $Premium->getName(), "UUID" => $Premium->getUUID()];
    print_r(json_encode($info));
}else {
    echo "Premium: " . $Premium->validPremium() . " Nomi precedenti: " . $Premium->getName() . " UUID: " . $Premium->getUUID();
}
