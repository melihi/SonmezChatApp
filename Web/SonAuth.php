<html>
    <h2>Please don't share your'r credentials.</h2>
    
<?php

function cred(){
  
  $username= $_POST["usern"];

  $password = $_POST["userp"];
  
  db($username,$password);    
}

function getToken(){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < 100; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
      
   return $randomString;
    
}


function db($uname,$passwd){
 

$servername = "SERVERNAME";
$username = "DBNAME";
$password = "DB PASSWORD";
$dbname = "DB NAME";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id,username,password,authority,secretKey FROM users WHERE username='$uname' AND password='$passwd'";
$result = $conn->query($sql);
$key;
$id;
$autho;



if ($result->num_rows > 0) {
  // output data of each row
  $key = getToken();
  $setSecret = $conn->query("UPDATE users SET secretKey='$key' WHERE username='$uname' AND password='$passwd'");
  while($row = $result->fetch_assoc()) {
    #echo "id: " . $row["id"]. " - Name: " . $row["username"]. " password : " . $row["password"]. " authority : ".$row["authority"] ."<br>";
    
    $id = $row["id"];
    $autho = $row["authority"];
  }
  echo "<b>success</b>";
  echo "<div class=\"key\">$key </div>";
  echo "<div class=\"id\">$id</div>";
  echo "<div class=\"autho\">$autho</div>";
 
 #$setExpire = $conn->query("UPDATE users SET date='123' WHERE username='$uname'");

 
} else {
  
  echo "Invalid username or password";
}
$conn->close();

}
function redirect(){
  echo '<script type="text/javascript">
           window.location = "YOUR 404 PAGE"
      </script>';
}

cred();


?>
</html>