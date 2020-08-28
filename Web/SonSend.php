<html>
<?php


function getInf(){
  $data = $_POST["token"];
  $data2 = $_POST["id"];
  $data3 = $_POST["message"];
  
  
  
  db($data,$data2,$data3);
}

function db($tok,$i,$mes){
  

  
  $servername = "SERVERNAME";
  $username = "USERNAME";
  $password = "PASSWORD";
  $dbname = "DBNAME";
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "SELECT id,secretKey,username FROM users WHERE id='$i' AND secretKey='$tok'";
  $result = $conn->query($sql);
  
  
  if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Token: " . $row["secretKey"] . "<br>";
      

      $username = $row['username'];
    }
  
    send($mes,$username);
  } else {
    
    echo "Invalid username or password";
  }
  $conn->close();
    
    }
function send($messageTaken,$usernameTaken){

$chatMes = fopen("chat.txt","a");
$date = date("Y-m-d H:i:s");
$lastMessage = "$date $usernameTaken : $messageTaken \n";
fwrite($chatMes,$lastMessage);

echo"<br> message sending succes";

}
getInf();



?>
<html>