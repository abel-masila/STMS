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

    //set email of user to be logged in
    //$user->u_email=isset($_POST['u_email']) ? $_POST['u_email']:die();
    $data=json_decode(file_get_contents("php://input"));
    $user->u_email=$data->u_email;
    $user->u_password=$data->u_password;


    //get user info
    
    if($user->login()){
        
        $user_arr=array(
            "user_id"=>$user->user_id,
            "u_name"=> $user->u_name,
            "u_email"=> $user->u_email
        );
        //make it json format
        print_r(json_encode($user_arr));
    } else{
        echo '{';
            echo '"message": "Unable to login User."';
        echo '}';
    }
 
   

    

?>