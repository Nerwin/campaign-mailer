<?php include("connection.php");

session_start();

if(isset($_SESSION['user'])!="")
{
    header("Location: index.php");
}

if(isset($_POST['btn-signup']))
{
    $login = mysql_real_escape_string($_POST['login']);
    $mail = mysql_real_escape_string($_POST['mail']);
    $password = md5(mysql_real_escape_string($_POST['password']));
    
    $sql="INSERT INTO user(login,mail,password) VALUES('$login','$mail','$password')";
    $dbh->exec($sql);
    
    header('Location: index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Page de presentation des services">
        <meta name="author" content="HNN">
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/simple-sidebar.css" rel="stylesheet">
        <!-- Perso CSS -->
        <link href="css/style.css" rel="stylesheet">
        <!--ICONE-->
        <link rel="icon" type="image/png" href="img/icon_mail.png" />
        <!-- JS -->
        <script type="text/javascript\" src="js/bootstrap.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <title>Registration</title>
    </head>
    <body>
        <center>
            <div id="login-form">
                <form method="post">
                    <table align="center" width="30%" border="0">
                        <tr>
                            <td><input type="text" name="login" placeholder="Login" required /></td>
                        </tr>
                        <tr>
                            <td><input type="email" name="mail" placeholder="Email" required /></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" placeholder="Password" required /></td>
                        </tr>
                        <tr>
                            <td><button type="submit" name="btn-signup">Register</button></td>
                        </tr>
                        <tr>
                            <td><a href="index.php">Sign In Here</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>
    </body>
</html>
