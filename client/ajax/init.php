<?php
include_once "database.php";

$motorG = "motorC";
$motorD = "motorB";
$motorTete = "motorD";

$db = init_roby_db();

//définition des commandes de base
$allActions = array();
$allActions[] = $motorG;
$allActions[] = $motorD;
$allActions[] = $motorTete;

reset_all($db, 1, $allActions);

echo json_encode("ok");

?>