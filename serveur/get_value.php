<?php

include_once "../client/ajax/database.php";

//$motors_folder = "/var/www/html/roby";
$motorG = "motorC";
$motorD = "motorB";
$motorTete = "motorD";                                                                                                                                                         
                                                                                                                                                                                                                                                
$motor = $_POST['motor'];

$db = init_roby_db();

$value = get_value($db, 1, $motor);

echo json_encode($value);

?>
