<?php
include 'connection.php';
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){

  $usernameData= test_data($_POST["username"]);
  $paswordData= test_data($_POST["password"]);

  if(empty($usernameData)|| empty($paswordData)){
    header("location:login.html");
    header("location:registration.html");
    exit();
  }
  else{

    $password="";
    $sql="SELECT password FROM cr_student WHERE user_id= '$usernameData'" ;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $password= $row["password"];
      }
      if (password_verify($paswordData, $password)) {
            $_SESSION["username"] = $usernameData;
          echo 1;
      }else {
              echo 0;
      }
    }
    if (password_verify($paswordData, $password)) {
      $_SESSION["username"] = $usernameData;
      header("location:homepage.php");
    }else {
      echo "password not matching";
      echo "\nfetch password:".$password;
      echo "\ngiven password:".$paswordData;

  else {
      echo 2;
    }
  }
}
function test_data($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}

?>
