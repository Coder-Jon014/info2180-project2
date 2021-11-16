<?php

$page = $_GET['page'];




if($page == "adduser"){
    ?>
    <div class= "body">
        <h2>New User</h2>


        <form>
            <label for="fname">First name</label><br>
            <input type="text" id="fname" name="fname">
            <br><br>

            <label for="lname">Last name</label><br>
            <input type="text" id="lname" name="lname">
            <br><br>

            <label for="password">Password</label><br>
            <input type="int" id="password" name="password">
            <br><br>
            <label for="email">Email</label><br>
            <input type="text" id="email" name="email"><br><br>

            
            <button type="submit" id="searchbtn">Submit</button>
        
        </form>
    </div>
<?php
}else if($page == "createissue"){
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
<?php
}else if($page == "home"){
    ?>
    <div class="homescreenhead">
      <div class="bigissues">
        <h2>Issues</h2>
        <a href="createIssue.html"
          ><button type="issue" id="issue" class="issueButton">
            Create New Issue
          </button></a>
      </div>
      <br />

      <!--Table issue-->
      <div class="filterbtns">
        <h3>Filter By:</h3>
        <button type="allissue" id="allissue">ALL</button>
        <button type="openissue" id="openissue">OPEN</button>
        <button type="ticket" id="ticket">MY TICKETS</button>
      </div>
<?php
}



?>