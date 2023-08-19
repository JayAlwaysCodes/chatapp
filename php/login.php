<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if(!empty($email) && !empty($password)){
        //check if user entered email and password
        $sql = mysqli_query($conn, "SELECT * FROM users_data WHERE email = '{$email}' AND password='{$password}'");
        if (mysqli_num_rows($sql)>0){//if users credentails method
            $row = mysqli_fetch_assoc($sql);
            $status = "Active now";
            $sql2 = mysqli_query($conn, "UPDATE users_data SET status='{$status}' WHERE unique_id = {$row['unique_id']} ");
            if($sql2){
                $_SESSION['unique_id']= $row['unique_id'];
                echo "success";
            }

        }else{
            echo "Email or Password is incorrect!";
        }

    }else{
        echo "All input fields are required!";
    }
?>