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

    //Query users
    $stmt=$user->read();
    $num=$stmt->rowCount();

    //Check if more than 0 records are found
    if($num>0){
        //Users Array
        $users_arr=array();
        $users_arr["users"]=array();

        //Get table contents
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            //extract row
            //This makes $row['u_name'] to just $name
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
            array_push($users_arr["users"],$user_item);
        }
        echo json_encode($users_arr);
    } else{
        echo json_encode(
            array("message" => "No User found.")
        );
    }
?>