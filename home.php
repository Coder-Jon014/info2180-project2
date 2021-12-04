<!DOCTYPE html>
<html>
  <head>
    <title>Info2180-Project2</title>
    <!--Stylesheet link-->
    <link rel="stylesheet" href="styles.css" />
    <!--Online Stylesheet for icons-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <!-- <script src="home.js" type="text/Javascript"></script> -->
  </head>

  <body>

    
    <!--Main Content-->
        <div class = mainIssues id="result-div">
          <h2>Issues</h2><a href="#"><button type="issue" id="issue" class="issueButton"> Create New Issue </button></a>           
            <br>
            <div class = "filterbtns">
            <h3>Filter By: </h3> 
            <button type="all" id="all">ALL</button>
            <button type="openI" id="openI">OPEN</button>
            <button type="ticket" id="ticket">MY TICKETS</button>
            </div>
            <div id="result">
            <!--Table will be appear here-->
            <?php
                include "configuration.php";
                
                
                $stmt= $conn->query("SELECT * FROM `issues`");

                if(isset($_GET['filter'])){
                    if($_GET['filter'] == "open"){
                        $stmt= $conn->query("SELECT * FROM `issues` WHERE status='open'");
                    }else if($_GET['filter'] == "my-ticket"){
                        session_start();
                        $username = (string)$_SESSION['user'];
                        $stmt= $conn->query("SELECT * FROM `issues` WHERE assigned_to='$username'");
                        // var_dump($username);
                        
                    }
                }
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //Testing data in variables
                // var_dump($stmt);
                // var_dump($results);

            ?>
            <table>
                <thead>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th>Created</th>
                </thead>
                <tbody id="ISSUES-TABLE">
                    <?php foreach($results as $row):?>
                    <tr>
                        <td><?="#".$row['id']." "?><a href="#" id="detail-issue"><?="".$row['title'];?></a></td>
                        <td><?=$row['type'];?></td>
                        <td class="status-row"><p><?=$row['status'];?></p></td>
                        <td><?=$row['assigned_to'];?></td>
                        <td><?=$row['created'];?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            </div>
        </div>
  </body>
</html>