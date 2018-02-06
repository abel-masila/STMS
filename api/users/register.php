<?php
    //require Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json;charset=UTF-8");

    //Include database config and Object files
    include_once('../config/database.php');
    include_once('../objects/user.php');

    // instantiate database and user object
    $database=new Database();
    $db=$database->getConnection();

    //Init user Object
    $user=new User($db);

    //get posted data
    $data=json_decode(file_get_contents("php://input"));
    
    //set user property values
    $user->u_name=$data->u_name;
    $user->u_email=$data->u_email;
    $user->u_password=$data->u_password;
    $user->u_role=$data->u_role;
    $user->created=date('Y-m-d H:i:s');

    //Create the user
    if($user->register()){
        echo '{';
            echo '"message": "User was created."';
        echo '}';
    }
    // if unable to create the user, tell the user
    else{
        echo '{';
            echo '"message": "Unable to create User."';
        echo '}';
    }
?>