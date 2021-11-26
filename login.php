<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

$account = new Account($con);

if (isset($_POST["submitButton"])) {
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $success = $account->login($username, $password);
    if ($success) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
}

function getInputValue($name) {
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Welcome to Reeceflix!</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
    <style>
        .signInContainer {
            background-color: #efefee;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .separator {
            width: 3px;
            background-color: black;
            height: 350px;
        }

    </style>
</head>
<body>
    <div class="signInContainer">
    <div>
        <img src="assets/images/logo2.png" title="Logo" alt="Site logo">
    </div>
    <div class="separator">
    </div>
    <div class="column">
        <div class="header">
        <img src="assets/images/logo2.png" title="Logo" alt="Site logo">
        <h3>Sign In</h3>
        <span>to continue to Reeceflix</span>
        </div>
        <form class="" method="POST">
        <?php echo $account->getError(Constants::$loginFailed); ?>
        <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username");?>" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="submitButton" value="SUBMIT">
        </form>
        <a href="register.php" class="signInMessage">Need an account? Sign in here</a>
    </div>
    </div>
</body>
</html>
