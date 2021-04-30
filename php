
                                              INTERNET PROGRAMMING
                                                CLASS ASSIGNMENT
						                                                                                    NAME: VAISHNAVI A
						                                                                                    REG.NO:953618104047
            
File transfer and php database programming to check login credentials
PHP program to check login credentials:

LoginForm.php

<html>
<head>
<title>LoginForm.php</title>
<script type="text/javascript">
    function validate()
    {
    var username = document.login.username.value;
    var password = document.login.password.value;
 
    if (username==null || username=="")
    {
      alert("Username can't be blank");
      return false;
    }
    else if (password==null || password=="")
    {
      alert("password can't be blank");
      return false;
    }
    }
</script>
</head>
<body>
 <div style="text-align:center"><h1>PHP Login Form using MySQL</h1></div>
<br>
    <form name="login" method="post" action="Login.php" onsubmit="return validate();" >
    <div>Username: <input type="text" name="username" /> </div>
    <div>Password: <input type="password" name="password" /> </div>
    <div><input type="submit" value="Login"></input> <input type="reset" value="Reset"></input></div>
</form>
</body>
</html>

Login.php

<html>
<body>
<?php 
include_once("DBConnection.php"); 
session_start(); 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{ 
    if (empty($_POST['username']) || empty($_POST['password'])) //Validating inputs using PHP code 
    { 
        echo 
        "Incorrect username or password"; 
        header("location: LoginForm.php");
    } 
 
     $inUsername = $_POST["username"]; 
     $inPassword = $_POST["password"]; 
     $stmt= $db->prepare("SELECT USERNAME, PASSWORD FROM PROFILE WHERE USERNAME = ?"); 
     $stmt->bind_param("s", $inUsername); 
     $stmt->execute();
     $stmt->bind_result($UsernameDB, $PasswordDB); 
     if ($stmt->fetch() && password_verify($inPassword, $PasswordDB)) 
     {
        $_SESSION['username']=$inUsername; 
        header("location: UserProfile.php"); 
     }
     else
     {
           echo "Incorrect username or password"; 
          ?>         
          <a href="LoginForm.php">Login</a>
       <?php 
     } 
} 
       ?>
</body> 
</html>

DBConnection.php

<?php 
    define('DB_SERVER', 'localhost:3306'); //database server url and port
    define('DB_USERNAME', 'root');  //database server username
    define('DB_PASSWORD', 'root123'); //database server password
    define('DB_DATABASE', 'profile'); //where profile is the database 
    
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); 
?>

UserProfile.php

<html>
<title>userProfile.php</title>
<body>
<?php
     session_start();
     $username = $_SESSION['username']; //retrieve the session variable
?>
<div style="text-align:center"><h1>User Profile</h1></div>
<br/>
 
<div style="font-weight:bold"> Welcome <?php echo $username ?> </div>
  
<div style="text-align: right"><a href="Logout.php">Logout</a></div> <!-- calling Logout.php to destroy the session -->
<?php
if(!isset($_SESSION['username'])) //If user is not logged in then he cannot access the profile page
{
     //echo 'You are not logged in. <a href="login.php">Click here</a> to log in.';
     header("location:LoginForm.php");
}
?>
</body>
</html>

Logout.php

<?php 
session_start();
$username = $_SESSION['username']; //retrieve the session variable
 
unset($_SESSION['username']); //to remove session variable
session_destroy(); //destroy the session
header("location: LoginForm.php"); //to redirect back to "Login.php" after logging out
exit();
 
if(!isset($_SESSION['username'])) //If user is not logged in then he cannot access the profile page
{
//echo 'You are not logged in. <a href="login.php">Click here</a> to log in.';
header("location:LoginForm.php");
}
?>



File Transfer:

Reading a file and Writing it to another file using php

<html>

   <head>
      <title>Reading a file and writing it to another file using PHP</title>
   </head>
   
   <body>
      
      <?php
         $filename = "tmp.txt";
         $file = fopen( $filename, "r" );
         
         if( $file == false ) {
            echo ( "Error in opening file" );
            exit();
         }
         
         $filesize = filesize( $filename );
         $filetext = fread( $file, $filesize );
         fclose( $file ); 
     $filename1 = "/home/user/guest/newfile.txt";
         $file1 = fopen( $filename1, "w" );
         if( $file1 == false ) {
      		echo ( "Error in opening new file" );
      		exit();
   	}
         fwrite( $file1, $filetext );
         $filetext1 = fread( $file1, $filesize );
         
         fclose( $file1 );

         echo ( "File size : $filesize bytes" );
         echo ( "$filetext1" );
         echo("file name: $filename1");

    ?>
      
   </body>
</html>






