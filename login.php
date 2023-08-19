<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        header("location: users.php");
    }
?>

<?php include_once "header.php";?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Just Connect</header>
            <form action="#">
                <div class="error-txt"></div>
              
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password">
                    <i class="fas fa-eye"></i>
                </div>
                
                <div class="field button">
                    <input type="submit" value="Continue to chat">
                </div>
                
            </form>
            <div class="link">Not Registered yet?<a href="index.php">Register Now</a></div>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
    
</body>
</html>