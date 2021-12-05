<!DOCTYPE html>
<html>
    <head>
    <title>Info2180-Project2</title>
        <!--Stylesheet link-->
         <link rel="stylesheet" href="styles.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <!-- <script src="scripts/Indepth.js"></script> -->
    </head>


     <body>    
         <!---->
         <?php 

            include "./configuration.php";

            if(isset($_GET['query'])){
                $title = $_GET['query'];

                $stmt= $conn->query("SELECT * FROM `issues` WHERE title='$title'");


                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                ?>
                    <div class= "body">
                        <div class= "bodygrid">
                            <div id="bodymain">
                                <h2 id =title><?= $results[0]['title'];?></h2>
                                <div id=issue>
                                    <!--issue goes here-->
                                    <?= "Issue #".$results[0]['id']; ?>
                                </div>
                
                                <div id=para>
                                    <p><?= $results[0]['description'];?></p>
                                </div>
                
                                <div id=dates>
                                    <!--dates go here-->
                                    <p><?= "Issue created on ".$results[0]['created']." by ".$results[0]['created_by']; ?></p>
                                    <p><?= "Last updated on ".$results[0]['updated']; ?></p>
                                </div>
                            </div>
                
                            <div id=asidemain>
                                <div id="aside">
                                    <label>Assigned To:</label>
                                    <p id="assigned"><?=$results[0]['assigned_to']; ?></p>
                                    <br>
                
                                    <label>Type:</label>
                                    <p id="type"><?=$results[0]['type']; ?></p>
                                    <br>
                
                                    <label>Priority:</label>
                                    <p id="prio"><?=$results[0]['priority']; ?></p>
                                    <br>
                
                                    <label>Status:</label>
                                    <p id="status"><?=$results[0]['status']; ?></p>
                                    <br>
                                </div>          
                
                                <button type="submit" id="markclosed">Mark as Closed</button>
                                <button type="submit" id="markinprog">Mark in Progress</button>
                            </div>
                    </body>
                <?php
            }else{
                echo "No files were selected";
            }


         
         ?>
        

</html>

<?php
    if(isset($_GET['update'], $_GET['search'])){
        $search = $_GET['search'];
        if($_GET['update'] == "closed"){
            
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `issues` SET status='closed', updated=now()
                    WHERE title='$search'";
            $conn->exec($sql);

        }   

        if($_GET['update'] == "progress"){

            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `issues` SET status='in progress', updated=now()
                    WHERE title='$search'";
            $conn->exec($sql);

        }
    }



?>