<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output ="";
        
        $sql = "SELECT * FROM messages LEFT JOIN users_data ON users_data.unique_id = messages.outgoing_id WHERE (outgoing_id = {$outgoing_id} AND incoming_id = {$incoming_id}) OR (outgoing_id = {$incoming_id} AND incoming_id = {$outgoing_id}) ORDER BY msg_id";

        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_id']===$outgoing_id){//if this is equal then he is a sender
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';

                }else{//he is a receiver
                    $output .= '<div class="chat incoming">
                                    <img src="php/images/'.$row['image'].'" alt="">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';

                }
            }
            echo $output;
        }
    }else{
        header("../login.php");

    }
?>