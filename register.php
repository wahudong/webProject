<!-- To display a registration form for a user to register, and gether the information about registration. -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <fieldset>
    <legend>Uer Registation</legend>
    <form action="saveRegistration.php" method="post" name="regForm" id="regForm">
    <label for="userName">Please Enter Your Email Address as Your User Name</label>
    <input type="email" name="userName" id="userName">
    <br>
    <label for="password1">Please Enter Your Password</label>
    <input type="password" name="password1" id="password1">
    <br>
    <label for="password2">Please Confirm Your Password</label>
    <input type="password" name="password2" id="password2">
    <br>
    <input type="submit" name="submit" id="sumbit">
    <input type="reset" name="reset" id="reset">     
    </fieldset>
    </form>
</body>
</html>