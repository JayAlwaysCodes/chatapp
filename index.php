<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        header("location: users.php");
    }
?>
<?php include_once "header.php";?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Just Connect</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt">This is an error message</div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required >
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lname"  placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="New Password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Your avatar</label>
                    <input type="file" name="image">
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to chat">
                </div>
                
            </form>
            <div class="link">Already Registered? <a href="login.php">Login Now</a></div>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
    
</body>
</html>