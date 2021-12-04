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
    <script src="main.js" type="text/Javascript"></script>
  </head>

  <body>
    <div class="header">
      <i class="fa fa-bug"></i>
      <h1>BugMe Issue Tracker</h1>
    </div>

    <!--SideBar-->
    <div class="sidebar">
      <div>
        <i class="fa fa-home"></i>
        <a href="#" id="home-btn">Home</a>
      </div>

      <div>
        <i class="fa fa-user-plus"></i>
        <a href="#" id="add-user-btn">Add User</a>
      </div>

      <div>
        <i class="fa fa-plus"></i>
        <a href="#" id="new-issue-btn">New Issue</a>
      </div>

      <div>
        <i class="fa fa-sign-out"></i>
        <a id="logout-btn" href = "logoutfile.php">Logout</a>
      </div>
    </div>
    
    <!--Main Content-->

     <div class= "main-content" id="result-div">
        <div class = mainIssues>
          <h2>Issues</h2><a href="Issuemaker.html"><button type="issue" id="issue" class="issueButton"> Create New Issue </button></a>           
        </div>
        <br>
        <div class = "filterbtns">
          <h3>Filter By: </h3> 
          <button type="all" id="all">ALL</button>
          <button type="openI" id="openI">OPEN</button>
          <button type="ticket" id="ticket">MY TICKETS</button>
        </div>
        <div id = "result">
          <!--Table will be appear here-->
          <?php
          include "configuration.php";


          $stmt= $conn->query("SELECT * FROM `issues`");
          $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

          ?>
          <table>
              <thead>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Assigned To</th>
                  <th>Created</th>
              </thead>
              <tbody>
                  <?php foreach($results as $row):?>
                  <tr>
                    <td><?="#".$row['id']." ".$row['title'];?></td>
                    <td><?=$row['type'];?></td>
                    <td><?=$row['status'];?></td>
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
