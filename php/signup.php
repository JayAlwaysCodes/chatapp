<?php
    session_start();
    include "config.php";
    //include "signup.js";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
   
    
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //checking email validity
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //check if email already exists in database
            $sql = mysqli_query($conn,"SELECT email FROM users_data WHERE email = '{$email}'");
            if(mysqli_num_rows($sql)>0){//if email already exist
                echo "$email - This email already exist!";


            }else{
                //check user upload file or not
                if(isset($_FILES['image'])){//if file is uploaded
                    $img_name = $_FILES['image']['name']; //get user's uploaded image name
                    $tmp_name = $_FILES['image']['tmp_name']; //the temporary name is used to save/move file in our folder

                    //let's explode image and get the last extension like jpg or png
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode); //here we get the extension of the image uploaded
                    $extensions = ['png', 'jpeg', 'jpg', 'jfif']; //valid image extensions
                    if(in_array($img_ext, $extensions)===true){
                        $time =time(); //this will return the current time when an image was uploaded and it will be used as the temporary name for the file

                        //move the user uploaded img to our particular folder
                        $new_img_name = $time.$img_name;
                        if(
                        move_uploaded_file($tmp_name, "images/".$new_img_name)){//if user upload image, move to our folder successfully
                            $status = 'Active now';//once user signed up then his staus will be active now
                            $random_id = rand(time(), 10000000); //creating random id for user

                            //insert all user data into table
                            $sql2 = mysqli_query($conn, "INSERT INTO users_data (unique_id, fname, lname, email,password, image, status ) VALUES({$random_id}, '{$fname}','{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}' )");
                            if($sql2){//if these data inserted
                                $sql3 = mysqli_query($conn, "SELECT * FROM users_data WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0){
                                   $row = mysqli_fetch_assoc($sql3); 
                                   $_SESSION['unique_id']= $row['unique_id'];
                                   echo "success";
                                }

                            }else{
                                echo "Something went Wrong";

                            }
                        }
                        
                    }else{
                        echo "Please select a valid image file!(jpeg, jpg, png)";
                    }

                }else{
                    echo "Please select an image file!";
                }
            }

        }else{
            echo "$email - This is not a valid email";
        }

    }else{
        echo "All input fields are required";
    }
?>