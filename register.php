<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>

<html>
<head>
	<title>Welcome to Slotify!</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

<div id="page-wrapper">
      <div id="modal-wrapper">
        <div id="modal">
          <div id="cards">
			  <div id="inputContainer">
            <div class="card" id="login">
              <div class="box">
				<h1><span style="font-weight: 800">Black</span><span style="color: grey">Box</span></h1>
				<?php echo $account->getError(Constants::$loginFailed); ?>
              </div>
              <form id="loginForm" action="register.php" method="POST">
                <label for="loginUsername">Username
                  <a href="#" title="Forgot email?" class="tip">Forgot Username?</a>
                </label>
                <input id="loginUsername" name="loginUsername" type="text" value="<?php getInputValue('loginUsername') ?>" required autocomplete="off" type="text" class="textbox">
                <label for="loginPassword">Password
                  <a href="#" title="Forgot password?" class="tip">Forgot password?</a>
                </label>
                <input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required type="password" class="textbox">
              <button type="submit" name="loginButton" class="proceed">Log-in to your account <i class="ion-ios-arrow-thin-right"></i></button>
              </form>
            </div>
            <div class="card" id="register">
              <div class="box">
              <div id="branding-small">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="42px" height="35px" viewBox="0 0 600 332" enable-background="new 0 0 600 332" xml:space="preserve">
                  <path id="SVGID_1_" d="M48.207,322.346H2.201l195.546-296.91l29.083,24.881L48.207,322.346L48.207,322.346z M366.916,323.3L184.581,45.545l22.235-34.362l182.337,277.754L366.916,323.3L366.916,323.3z M206.816,322.346c0,0-32.511-50.283-67.621-102.999c-7.233-10.859-14.576-21.821-21.768-32.47c-0.586-0.867,14.985-46.926,21.658-36.678c7.217,11.086,14.388,22.232,21.347,33.138c36.734,57.58,67.509,108.465,67.509,108.465L206.816,322.346L206.816,322.346z M313.043,162.238l-39.053,59.399c-31.744,48.284-57.467,87.41-57.467,87.41l-31.942-22.019c0,0,29.998-44.644,67.215-101.253c5.132-7.806,10.351-15.742,15.577-23.694c4.91-7.47,9.831-14.953,14.699-22.356C321.356,79.969,366.42,11.184,366.42,11.184h45.049C411.469,11.184,353.769,100.292,313.043,162.238L313.043,162.238z M375.986,309.048l-29.083-24.882L526.486,11.184h45.046L375.986,309.048L375.986,309.048z"></path>
                </svg>
              </div>
                <div class="box-header">Register</div>
                <form id="registerForm" action="register.php" method="POST">
					<?php echo $account->getError(Constants::$usernameCharacters); ?>
					<?php echo $account->getError(Constants::$usernameTaken); ?>
				  <label for="username">Username</label>
				  <input type="text" id="username" name="username" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('username') ?>" required class="textbox">
				  
				  <?php echo $account->getError(Constants::$firstNameCharacters); ?>
				  <label for="firstName">First Name</label>
				  <input id="firstName" name="firstName" type="text" value="<?php getInputValue('firstName') ?>" required class="textbox">
				  
				  <?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<label for="lastName">Last name</label>
						<input id="lastName" name="lastName" type="text" value="<?php getInputValue('lastName') ?>" required>

						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email') ?>" required>

						<label for="email2">Confirm email</label>
						<input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email2') ?>" required>

						<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						<label for="password">Password</label>
						<input id="password" name="password" type="password" placeholder="Your password" required>

						<label for="password2">Confirm password</label>
						<input id="password2" name="password2" type="password" placeholder="Your password" required>
						
						<button type="submit" class="proceed" name="registerButton">Create an account <i class="ion-ios-arrow-thin-right"></i></button>
				</form>
</div>
              </div>
            </div>
          </div>
          <div id="toggle-tabs">
            <div class="tab" id="toggle-login">Sign In</div>
            <div class="tab" id="toggle-register">Register</div>
          </div>
        </div>
      </div>
    </div>
	

<script>
var login = $('#login');
var register = $('#register');
var button_login = $('#toggle-login');
var button_register = $('#toggle-register');
var box = $('.box');

$(function() {

  register.hide();

  button_register.click(function() {
    login.slideUp(1000);
    register.slideDown(1000);
  });
  button_login.click(function() {
    register.slideUp(1000);
    login.slideDown(1000);
  });
});
</script>
</body>
</html>

<style>

html, body {
    height: 100%;
  }
  
  body {
    background: url("https://res.cloudinary.com/exards/image/upload/v1447941004/Majestic_mountains_1920x1080-blue_rr4ucd.jpg");
    background-size: cover;
    font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
  }
  
  #page-wrapper {
    display: table;
    width: 100%;
    height: 100%;
  }
  #page-wrapper #modal-wrapper {
    display: table-cell;
    width: 100%;
    height: 100%;
    vertical-align: middle;
  }
  
  #modal {
    margin: 0 auto;
    box-shadow: 0px 34px 27px rgba(0, 0, 0, 0.32), inset 0 0 1px rgba(0, 0, 0, 0.2);
    max-width: 430px;
    background: white;
  }
  
  .box {
    background: #3b8686;
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CiAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjM2I4Njg2IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzc5YmQ5YSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
    background: -moz-linear-gradient(-45deg, #3b8686 0%, #79bd9a 100%);
    background: -webkit-linear-gradient(-45deg, #3b8686 0%, #79bd9a 100%);
    background: linear-gradient(135deg, #3b8686 0%, #79bd9a 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#FF3B8686", endColorstr="#FF79BD9A",GradientType=1 );
    padding: 40px;
    text-align: center;
    position: relative;
  }
  .box .box-header {
    font-size: 1.75em;
    font-weight: 300;
    color: white;
    text-align: left;
    margin: 0 0 36px;
  }
  .box svg {
    fill: white;
  }
  
  button.proceed {
    display: block;
    width: 100%;
	padding: 20px 0;
	margin-top: 20px;
    color: white;
    background: #3b8686;
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CiAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjM2I4Njg2IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzBiNDg2YiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
    background: -moz-linear-gradient(-45deg, #3b8686 0%, #0b486b 100%);
    background: -webkit-linear-gradient(-45deg, #3b8686 0%, #0b486b 100%);
    background: linear-gradient(135deg, #3b8686 0%, #0b486b 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#FF3B8686", endColorstr="#FF0B486B",GradientType=1 );
    border: 0;
    font-size: 1em;
    font-weight: bold;
    font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
    cursor: pointer;
  }
  button.proceed i {
    font-size: 0.8em;
  }
  
  #loginForm {
    padding: 40px;
  }
  #loginForm input {
    border: 1px solid #ddd;
    color: #79bd9a;
  }
  #login-form label {
    color: #777777;
  }
  
  #registerForm input {
    border: 1px solid white;
  }
  #registerForm label {
    color: white;
  }
  
  label {
    display: block;
    text-align: left;
    margin: 20px 0 6px;
    font-family: "Proxima Nova", sans-serif;
  }
  label:first-child {
    margin-top: 0;
  }
  label .tip {
    float: right;
    font-size: 13px;
    text-decoration: underline;
    cursor: pointer;
    color: #3B8686;
    font-weight: bold;
  }
  
  input {
    box-sizing: border-box;
    width: 100%;
    padding: 10px;
    font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
    font-size: 1em;
    background: transparent;
  }
  
  #toggle-tabs {
    display: table;
    width: 100%;
  }
  #toggle-tabs .tab {
    font-size: 1em;
    display: table-cell;
    width: 50%;
    padding: 20px;
    cursor: pointer;
    text-align: center;
    font-weight: bold;
  }
  #toggle-tabs .tab#toggle-login {
    color: #79bd9a;
  }
  #toggle-tabs .tab#toggle-register {
    color: white;
    background: #79bd9a;
  }
  
  #branding-small {
    position: absolute;
    top: 36px;
    right: 36px;
  }
  #branding-small svg {
    fill: white;
  }
</style>