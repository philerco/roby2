<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function openDB($hote, $nom_bd, $utilisateur, $mdp){
         
        try{
        echo 'mysql:host='.$hote.';dbname='.$nom_bd;
                $db = new PDO('mysql:host='.$hote.';dbname='.$nom_bd, $utilisateur, $mdp);
        }catch(Exception $e){
                echo 'Erreur : '.$e->getMessage().'<br />';
                echo 'No : '.$e->getCode();
        }
        
        return $db;
}


function init_roby_db(){

    //connection à la base de données ovh

    //$db_handle = openDB("mysql55-64.perso", "ercolessqj713705", "ercolessqj713705", "Ovh230185");
     try
    {
            $bdd = new PDO('mysql:host=ercolessqj713705.mysql.db;dbname=ercolessqj713705', 'ercolessqj713705', 'Ovh230185');
            //$bdd = new PDO('mysql:host=localhost;dbname=gestioncadeaux', 'root', '');
    }
    catch (PDOException  $e)
    {
                    die('Erreur : ' . $e->getMessage());
    }
        
    return $bdd;
 
}

function remove_all($db, $robyname){
    
    try
    {
            $stmt = $db->prepare("DELETE FROM RobyControls WHERE _idRobyName=$robyname");
            $stmt->execute();
    }
    catch (PDOException  $e)
    {
                    die('Erreur : ' . $e->getMessage());
    }

}

function get_all($db, $robyname){

    try
    {
            $stmt = $db->prepare("SELECT * FROM RobyControls WHERE _idRobyName=$robyname");
            $stmt->execute();
    }
    catch (PDOException  $e)
    {
                    die('Erreur : ' . $e->getMessage());
    }
    
    return $stmt->fetchAll();
}

function create_command($db, $robyname, $action, $value){

    try
    {
            $stmt = $db->prepare("INSERT INTO RobyControls (_idRobyName, controll, value) VALUES (?, ?, ?)");
            $stmt->execute(array($robyname, $action, $value));
    }
    catch (PDOException  $e)
    {
                    die('Erreur : ' . $e->getMessage());
    }
    
}

function set_value($db, $robyname, $action, $value){
    try
    {
            $stmt = $db->prepare("UPDATE RobyControls SET `controll`=?, `value`=? WHERE _idRobyName=? AND controll=?");
            $resultat = $stmt->execute(array($action, $value, $robyname, $action));
    }
    catch (PDOException  $e)
    {
                    die('Erreur : ' . $e->getMessage());
    }
}

function get_value($db, $robyname, $action){
    try
    {
            //echo "SELECT value FROM RobyControls WHERE _idRobyName=$robyname AND controll='$action'---";
            $stmt = $db->prepare("SELECT value FROM RobyControls WHERE _idRobyName=? AND controll=?");
            $stmt->execute(array($robyname, $action));
            
            $resultat = $stmt->fetch();
            
    }
    catch (PDOException  $e)
    {
                    die('Erreur : ' . $e->getMessage());
    }
    
    return $resultat[0];
    
}

function reset_all($db, $robyname, $tabActions){

    remove_all($db, $robyname);
    
    foreach($tabActions as $action){
    //echo "creating command for $action <br> ";
        create_command($db, $robyname, $action, 0);
    }

}

?>