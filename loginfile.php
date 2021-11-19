<?php      

    include('configuration.php');  
    if(!isset($_SESSION)){
    session_start();
    $usn = $_GET['user'];  
    $pwrd = $_GET['pass'];  
      
        $usn = filter_var($usn,FILTER_SANITIZE_EMAIL);
        $pwrd = filter_var($pwrd,FILTER_SANITIZE_STRING);  
        $statement  = $conn -> query("SELECT * FROM `users` WHERE  email = '$usn'");  
        $res = $statement -> fetchAll(PDO::FETCH_ASSOC); 

        if (count($res) != 0){
            $row = $res[0];
            if(password_verify($pwrd,$row['password'])){

                $_SESSION['user'] = $row['id'];
                echo('redirect');
        }else{
            echo('Password Incorrect');
        }
    }else{
        echo('Username Incorrect');
    }
   
}else{

}