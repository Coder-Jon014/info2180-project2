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
    <script src="home.js" type="text/Javascript"></script>
  </head>

  <body>

    
    <!--Main Content-->
        <div class = mainIssues>
          <h2>Issues</h2><a href="Issuemaker.html"><button type="issue" id="issue" class="issueButton"> Create New Issue </button></a>           
        </div><br>
        <div class = "filterbtns">
          <h3>Filter By: </h3> 
          <button type="all" id="all">ALL</button>
          <button type="openI" id="openI">OPEN</button>
          <button type="ticket" id="ticket">MY TICKETS</button>
        </div>
        <div id = "result">
          <!--Table will be appear here-->
        </div>
    </div>
  </body>
</html>