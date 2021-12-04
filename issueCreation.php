<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <script src="issueCreation.js" type="text/Javascript"></script>

    <title>Document</title>
</head>
<?php
session_start();
include('configuration.php');
include('loginfile.php');



$context = $_GET['context'];
$user = (int)$_SESSION['user'];
// checks if user is logged in
if(isset($_SESSION['user'])){
    //adds new user to sql after data is sanitized 
if ($context == 'newUser'){
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $pass = $_GET['password'];
    $email = $_GET['email'];
    
    if(filter_var($fname,FILTER_SANITIZE_STRING) !=false || filter_var($lname,FILTER_SANITIZE_STRING) != false || filter_var($email,FILTER_SANITIZE_EMAIL) != false || filter_var($pass,FILTER_SANITIZE_STRING) != false){
    $sanitizedFName = filter_var($fname,FILTER_SANITIZE_STRING);
    $sanitizedLName = filter_var($lname,FILTER_SANITIZE_STRING);
    $sanitizedEmail = filter_var($email,FILTER_SANITIZE_EMAIL);
    $sanitizedPassword = filter_var($pass,FILTER_SANITIZE_STRING);
    $hashedPassword = password_hash($sanitizedPassword,PASSWORD_DEFAULT);

    $stmt = $conn -> query("INSERT INTO `users` (firstname,lastname,password,email) VALUES ('$sanitizedFName','$sanitizedLName','$hashedPassword','$sanitizedEmail')");
    echo("User Entered");
    // something goes wrong with date entered by user
    }else{
        echo("An error has occured");
    }
}
if($context == 'homeScreen'){
    $title = $_GET['title'];
    $description = $_GET['description'];
    $assigned = $_GET['assigned'];
    $type = $_GET['type'];
    $priority = $_GET['priority'];
    if(filter_var($title,FILTER_SANITIZE_STRING) !=false || filter_var($description,FILTER_SANITIZE_STRING) != false || filter_var($assigned,FILTER_SANITIZE_STRING) != false || $type = filter_var($type,FILTER_SANITIZE_STRING) != false || filter_var($priority,FILTER_SANITIZE_STRING) != false){
        $sanitizedTitle = filter_var($title,FILTER_SANITIZE_STRING);
        $sanitizedDescription = filter_var($description,FILTER_SANITIZE_STRING);
        $sanitizedassigned = (int)filter_var($assigned,FILTER_SANITIZE_STRING);
        $sanitizedType = $type = filter_var($type,FILTER_SANITIZE_STRING);
        $sanitizedPriority = filter_var($priority,FILTER_SANITIZE_STRING);
        $userID = (int)$_SESSION['user'];

        $stmt = $conn ->query("INSERT INTO `issues` (title,description,type,priority,assigned_to,created_by) VALUES ('$sanitizedTitle','$sanitizedDescription','$sanitizedType','$sanitizedPriority','$sanitizedassigned','$userID')");
        echo("Issue Created");
    }
}
if($context == 'dashboard'){
    //if the open filter is selected 
    if($_GET['filter'] == "open"){
        $stmt = $conn ->query("SELECT * FROM `issues` WHERE status = 'Open'");
        $results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    //if my tickets filter is selected
    }else if($_GET['filter'] == "myticket"){
        $stmt = $conn ->query("SELECT * FROM `issues` WHERE assigned_to = '$user'");
        $results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    // open filter is selected or page is first visited
    }else{
        $stmt = $conn ->query("SELECT * FROM `issues`");
        $results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
    // returs a html table that contains the data requested via fileter
    createIssuesPage($results);

}

if ($context == 'getNames'){
    $stmt = $conn -> query("SELECT id,firstname FROM `users`");
    $results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    createAssighnments($results);
}
if($context == 'details'){
    $id = $_GET['id'];
    $sanitizedID = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
    $stmt = $conn -> query("SELECT * FROM `issues` WHERE id = '$id'");
    $results = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    echo(json_encode($results[0]));
}

if($context == 'setStatus'){
    $status = $_GET['status'];
    $id =$_GET['id'];

    if($status == 'inProgress'){
        $stmt = $conn -> query("UPDATE `issues` SET status='In Progress' WHERE id = '$id'");
        exit();
    }else{
        $stmt = $conn -> query("UPDATE `issues` SET status='Closed' WHERE id = '$id'");
        exit();
    }
}

}else{
    echo("no Session detected");
}
?>
<body>
<div class= "body">
            <h2>Create Issue</h2>
            <form>
                <label for="title">Title</label><br>
                <input type="text" id="title" name="title">
                <br><br>

                <label for="description">Description</label><br>
                <textarea type="text" id="description" name="description"></textarea>
                <br><br>

                <label for="assign">Assign To</label><br>
                <div id=assignContainer>
                <select id="assignstuff" name="assign"></select>

                </div>
                <br><br>
                <label for="bug">Bug</label><br>
                <select id="bugstuff" name="bug">
                    <option value="bug">Bug</option>
                    <option value="proposal">Propsal</option>
                    <option value="task">Task</option>
                  </select><br><br>
                

                <label for="priority">Priority</label><br>
                <select id="prioritystuff" name="priority">
                    <option value="minor">Minor</option>
                    <option value="major">Major</option>
                    <option value="critical">Critical</option>
                  </select><br><br>
                
            <button type="submit" id="searchbtn">Submit</button>
            
              </form>
        </div>

</body>
</html>