<?php

include "service/database.php";
session_start();


if(isset($_SESSION["is_login"])){
    header("location: dashboard.php");
}

if (isset($_POST['login'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

 
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

   $result =$db->query($sql);
   if($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    
  $_SESSION["username"] = $data["username"];
  $_SESSION["is_login"] = true;

    header("location: dashboard.php");
   }else{
   echo "DATA TIDAK DI TEMUKAN";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include "layout/header.html" ?>

   <h3>akun masuk </h3>
    
    <form action="login.php" method="POST">
        <br><input type="text" placeholder="username" name="username"/>
       <br> <input type="password" placeholder="password" name="password"/>
      <br><button type="submit" name="login">masuk sekarang</button>
    </form>

    <?php include "layout/footer.html" 
    ?>


</body>
</html>