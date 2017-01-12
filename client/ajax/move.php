<?php

include_once "database.php";

//$motors_folder = "/var/www/html/roby";
$motorG = "motorC";
$motorD = "motorB";
$motorTete = "motorD";                                                                                                                                                                 
                                                                                                                                                                                                                                                
$direction = $_POST['direction'];

$db = init_roby_db();
$vitesse = 255;

if($direction == "haut"){
    set_value($db, 1, $motorG, $vitesse);
    set_value($db, 1, $motorD, $vitesse);
}
else if($direction == "bas"){
    set_value($db, 1, $motorG, -1*$vitesse);
    set_value($db, 1, $motorD, -1*$vitesse);
}
else if($direction == "gauche"){
    set_value($db, 1, $motorD, $vitesse/2);
    set_value($db, 1, $motorG, -1*$vitesse/2);
}
else if($direction == "droite"){
    set_value($db, 1, $motorD, -1*$vitesse/2);
    set_value($db, 1, $motorG, $vitesse/2);
}
else if($direction == "stop"){
    set_value($db, 1, $motorD, 0);
    set_value($db, 1, $motorG, 0);
    set_value($db, 1, $motorTete, 0);
}
else if($direction == "teteHaut"){
    set_value($db, 1, $motorTete, 50);
}
else if($direction == "teteBas"){
    set_value($db, 1, $motorTete, -50);
}else{
  echo "0";
}

echo json_encode("ok");

?>
