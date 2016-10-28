<html>
  <head>
  <link rel="stylesheet" href="assets/css/loginSignin.css" />
  <link rel="stylesheet" href="assets/css/navigationBar.css" />

    <title>Login</title>
  </head>
<body>

<ul id="horiz_menu">

	<li class="bouton_menu"><a href="loginPage.php"><img src="assets/images/login.png" alt="Login" />Login</a></li>

	<li class="bouton_menu"><a href="signinPage.php"><img src="assets/images/register.png" alt="SingIn" />Sing In</a></li>

	<li class="bouton_menu"><a href="index.html"><img src="assets/images/home.png" alt="home" />Home</a></li>
</ul>

<h1 align ="center">SIGN IN TO SCRUM MANAGER</h1>

<form name="SIGNIN" action="registration.php" method="POST">
  <table border="0" align="center" cellspacing="2" cellpadding="2">
    <tr align="center">
      <td><input type="text" name="login" placeholder="login"></td>
    </tr>
    <tr align="center">
      <td><input type="password" name="password" placeholder="password"></td>
    </tr>
    <tr align="center">
      <td><input type="text" name="name" placeholder="name"></td>
    </tr>
    <tr align="center">
      <td><input type="text" name="surname" placeholder="surname"></td>
    </tr>
     <tr align="center">
      <td><input type="email" name="email" placeholder="email"></td>
    </tr>
    <tr align="center">

      <td colspan="2"><input type="submit" value="Sign in" class="myButton"></td> 
    </tr>

  </table>
</form>
 <footer align="center">By signing up, you agree to the Terms of Service and Privacy Policy, 
    including Cookie Use. 
    Others will be able to find you by email or phone number when provided.
  </footer>
</body>
</html>
