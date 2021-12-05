<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <!-- <script src="issueCreation.js" type="text/Javascript"></script> -->
    <title>Document</title>
</head>
<?php

include('configuration.php');
include('loginfile.php');

session_start();

if(isset($_SESSION['user'], $_GET['context'])){
    

    $stmt= $conn->query("SELECT * FROM `users`");

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);



    ?>
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
            <select id="assignstuff" name="assign">
            <?php foreach($results as $row): ?>
                <option value="<?= $row['firstname']." ".$row['lastname']; ?>"><?= $row['firstname']." ".$row['lastname'];?></option>
            <?php endforeach; ?>
            </select>
            

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
    <?php
    if($_GET['context'] == "newIssue"){
        if(isset($_GET['title'], $_GET['description'], $_GET['assigned'], $_GET['type'], $_GET['priority'])){

            $tle = $_GET['title'];
            $descr = $_GET['description'];
            $asgn = $_GET['assigned'];
            $type = $_GET['type'];
            $prty = $_GET['priority'];
            if(filter_var($tle,FILTER_SANITIZE_STRING) !=false || filter_var($descr,FILTER_SANITIZE_STRING) != false || filter_var($asgn,FILTER_SANITIZE_STRING) != false || $type = filter_var($type,FILTER_SANITIZE_STRING) != false || filter_var($priority,FILTER_SANITIZE_STRING) != false){
                $Title = filter_var($tle,FILTER_SANITIZE_STRING);
                $Description = filter_var($descr,FILTER_SANITIZE_STRING);
                $Assigned = filter_var($asgn,FILTER_SANITIZE_STRING);
                $Type = filter_var($type,FILTER_SANITIZE_STRING);
                $Priority = filter_var($prty,FILTER_SANITIZE_STRING);
                $creator = $_SESSION['user'];

                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO `issues`(title, description, type, priority, status, assigned_to, created_by)
                        VALUES ('$Title','$Description','$Type', '$Priority', 'open', '$Assigned', '$creator')";
                
                $conn->exec($sql);
            }else{
                echo "GET VARIABLES NOT SET";
            }
            
        }
    }



}else{
    echo "SESSION HAS NOT BEEN STARTED.";
}

?>

<?php function createAssighnments($results){?> 
    <select name="assign" id="assignstuff">
    <?php foreach ($results as $row):?>
        <option value=<?=$row['id']?> ><?=$row['firstname']?> </option>
    <?php endforeach; ?>
    </select>

<?php } ?>