<?php      

include('configuration.php');  
if(isset($_POST['email'], $_POST['pass'])){
    
    session_start();
    $raw_email = $_POST['email'];  
    $raw_password = $_POST['pass'];  
    
    $email = filter_var($raw_email,FILTER_SANITIZE_EMAIL);
    $pwrd = filter_var($raw_password,FILTER_SANITIZE_STRING);  
    // echo $email."\n";    THIS WAS USED FOR TESTING
    // echo $pwrd;
    $statement  = $conn -> query("SELECT * FROM `users` WHERE  email = '$email'");  
    $res = $statement -> fetchAll(PDO::FETCH_ASSOC); 

    if (count($res) != 0){
        $row = $res[0];
        if(password_verify($pwrd,$row['password'])){

            $usr = $row['firstname']." ".$row['lastname'];
            $_SESSION['user'] = $usr;
            echo('redirect');
            header("Location: ./homeScreen.php");
            exit();
        }else{
            echo('Password Incorrect');
            header("Location: ./loginInterface.html");
            exit();
        }
    }else{
        echo('Username Incorrect');
        header("Location: ./loginInterface.html");
        exit();
    }

}else{

}
?>