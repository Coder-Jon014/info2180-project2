<?php
session_start();
include('configuration.php');
include('loginfile.php');
if(isset($_GET['context'],$_SESSION['user'])){
    
    $context = $_GET['context'];
    $usr = (int)$_SESSION['user'];
}else{
    $context = "Not set";
    $usr = "Not set";
}

// checks if user is logged in
if(isset($_SESSION['user'])){
    //adds new user to sql after data is sanitized 
    if ($context == 'newUser'){
        $firstname = $_GET['fname'];
        $lastname = $_GET['lname'];
        $paasword = $_GET['password'];
        $emaill = $_GET['email'];
        
        if(filter_var($firstname,FILTER_SANITIZE_STRING) !=false || filter_var($lastname,FILTER_SANITIZE_STRING) != false || filter_var($eml,FILTER_SANITIZE_EMAIL) != false || filter_var($pswrd,FILTER_SANITIZE_STRING) != false){
        $Email = filter_var($eml,FILTER_SANITIZE_EMAIL);
        $Pwrds = filter_var($pswrd,FILTER_SANITIZE_STRING);
        $Pwrds = password_hash($Pwrds,PASSWORD_DEFAULT);
        $FName = filter_var($firstname,FILTER_SANITIZE_STRING);
        $LName = filter_var($lastname,FILTER_SANITIZE_STRING);


        $statement = $conn -> query("INSERT INTO `users` (firstname,lastname,password,email) VALUES ('$FName','$LName','$Pwrds','$Email')");
        echo("User Entered");
        // something goes wrong with date entered by user
        }else{
            echo("An error has occured");
        }
    }
    // adds new issue to table after data is sanitized 
    if($ctext == 'createIssue'){
        $tle = $_GET['title'];
        $descr = $_GET['description'];
        $asgn = $_GET['assigned'];
        $type = $_GET['type'];
        $prty = $_GET['priority'];
        if(filter_var($tle,FILTER_SANITIZE_STRING) !=false || filter_var($descr,FILTER_SANITIZE_STRING) != false || filter_var($asgn,FILTER_SANITIZE_STRING) != false || $type = filter_var($type,FILTER_SANITIZE_STRING) != false || filter_var($priority,FILTER_SANITIZE_STRING) != false){
            $Title = filter_var($tle,FILTER_SANITIZE_STRING);
            $Description = filter_var($descr,FILTER_SANITIZE_STRING);
            $Assigned = (int)filter_var($asgn,FILTER_SANITIZE_STRING);
            $Type = $type = filter_var($type,FILTER_SANITIZE_STRING);
            $Priority = filter_var($prty,FILTER_SANITIZE_STRING);
            $ID = (int)$_SESSION['user'];

            $statement = $conn ->query("INSERT INTO `issues` (tle,descr,type,prty,assignedto,createdby) VALUES ('$Title','$Description','$Type','$Priority','$Assigned','$ID')");
            echo("Issue Created");
        }
    }
    if($ctext == 'dashboard'){
        //if the open filter is selected 
        if($_GET['filter'] == "open"){
            $statement = $conn ->query("SELECT * FROM `issues` WHERE status = 'Open'");
            $res = $statement -> fetchAll(PDO::FETCH_ASSOC);
        //if my tickets filter is selected
        }else if($_GET['filter'] == "myticket"){
            $statement = $conn ->query("SELECT * FROM `issues` WHERE assignedto = '$user'");
            $res = $statement -> fetchAll(PDO::FETCH_ASSOC);
        // open filter is selected or page is first visited
        }else{
            $statement = $conn ->query("SELECT * FROM `issues`");
            $res = $statement -> fetchAll(PDO::FETCH_ASSOC);
        }
        // returs a html table that contains the data requested via fileter
        createIssuesPage($res);

    }

    if ($ctext == 'getNames'){
        $statement = $conn -> query("SELECT id,firstname FROM `users`");
        $res = $statement -> fetchAll(PDO::FETCH_ASSOC);
        createAssighnments($res);
    }
    if($ctext == 'details'){
        $id = $_GET['id'];
        $ID = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        $statement = $conn -> query("SELECT * FROM `issues` WHERE id = '$id'");
        $res = $statement -> fetchAll(PDO::FETCH_ASSOC);
        echo(json_encode($res[0]));
    }

    if($ctext == 'setStatus'){
        $stats = $_GET['status'];
        $id =$_GET['id'];

        if($stats == 'inProgress'){
            $statement = $conn -> query("UPDATE `issues` SET stats='In Progress' WHERE id = '$id'");
            exit();
        }else{
            $statement = $conn -> query("UPDATE `issues` SET stats='Closed' WHERE id = '$id'");
            exit();
        }
    }

}else{
    echo("no Session detected");
}
?>

<?php function createIssuesPage($result){?>
    <table>
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Created</th>
        </tr>
        <?php foreach($result as $row):?>
            <tr id="row" data-issueid=<?=$row['id']?>>
                <th><?=$row['title']?></th>
                <th><?=$row['type']?></th>
                <?php if ($row['status'] == 'Open') { ?>
                <th id='open'><?=$row['status']?></th>
                
                <?php }else if($row['status'] == 'Closed') { ?>
                <th  id='closed'><?=$row['status']?></th>

                <?php }else if($row['status'] == 'In Progress') { ?>
                <th  id='inprogress'><?=$row['status']?></th>
                <?php } ?>

                <th><?=$row['assigned_to']?></th>
                <th><?=$row['created']?></th>
            </tr>
            <?php endforeach?>
    </table>
        <?php } ?>

<?php function createAssighnments($results){?> 
    <select name="assign" id="assignstuff">
    <?php foreach ($results as $row):?>
        <option value=<?=$row['id']?> ><?=$row['firstname']?> </option>
    <?php endforeach; ?>
    </select>

<?php } ?>