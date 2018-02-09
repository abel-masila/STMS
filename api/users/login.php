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
    $stmt=$user->login();
    $num=$stmt->rowCount();
    if($num>0){
        $user_arr=array();
        $user_arr["user"]=array();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user_item=array(
                "user_id" =>$user_id,
                "u_name" => $u_name,
                "u_email" => $u_email,
                "u_password" =>$u_password,
                "u_role" => $u_role,
                "u_roleName"=>$u_roleName,
                "created" => $created
            );
            array_push($user_arr["user"],$user_item);
        }
        print_r(json_encode($user_arr));
    } else{
        echo json_encode(
            array("message" => "No User found.")
        );
    }

 
   

    

?>