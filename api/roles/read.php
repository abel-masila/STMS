<?php
     //require Headers
     header("Access-Control-Allow-Origin: *");
     header("Content-Type: application/json;charset=UTF-8");
 
     //Include database config and Object files
     include_once('../config/database.php');
     include_once('../objects/roles.php');

     // instantiate database and user object
    $database=new Database();
    $db=$database->getConnection();

    //init Role Object
    $role=new Role($db);

    //query roles
    $stmt=$role->readAll();
    $num=$stmt->rowCOunt();

    //check of results is more than 0 
    if($num>0){
        //Roels array
        $roles_arr=array();
        $roles_arr['roles']=array();
        
        //retrieve table contents
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            //extract row
            extract($row);
            $role_item=array(
                "role_id"=>$role_id,
                "role_name"=>$role_name
            );
            array_push($roles_arr['roles'],$role_item);
        }
        echo json_encode($roles_arr);
    } else{
        echo json_encode(
            array("message" => "No Role found.")
        );
    }
?>