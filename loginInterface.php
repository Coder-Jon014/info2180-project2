<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
  </head>
  <body>
    <div class="login">
      <form action="./loginfile.php" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" required />
        <label for="pass">Password</label>
        <input type="text" name="pass" id="pass" required />
        <input type="submit" value="submit" id="submit" />
      </form>
    </div>
  </body>
</html>
