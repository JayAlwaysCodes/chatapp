<?php
       while($row = mysqli_fetch_assoc($sql)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_id = {$row['unique_id']} OR outgoing_id = {$row['unique_id']}) AND (outgoing_id = {$outgoing_id} OR incoming_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2) ;
        if(mysqli_num_rows($query2) > 0){
            $result = $row2['msg'];
        }else{
            $result = "No message available";
        }
        
        //trming message if the words are more than 28
        (strlen($result) > 20) ? $msg = substr($result, 0,20).'...' : $msg = $result;
        //adding YOU text before your message
        // ($outgoing_id == $row2['outgoing_id']) ? $sender = "You: " : $sender ="";
    
        

        //check user is online or offline
        ($row['status']== "Offline now") ? $offline = "offline" : $offline = "";


        $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                        <div class="content">
                            <img src="php/images/'. $row['image'].' " alt="">
                            <div class="details">
                                <span>'.$row['fname']. " ". $row['lname'].'</span>
                                <br>
                                <P>' .$msg.'</P>
                            </div>
                        </div>
                        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                    </a>';
    }
?>
<!-- // <p>'. $you . $message .'</p> -->