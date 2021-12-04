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