<?php include("connection.php"); 

session_start();

$sql="SELECT * FROM user WHERE id=".$_SESSION['user'];
foreach ($dbh->query($sql) as $row)
{
    $user_login = $row['login'];
    $user_mail = $row['mail'];
}    
?>
<!DOCTYPE html>
<html lang="fr">

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
    <!--FontAwesome-->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!--ICONE-->
    <link rel="icon" type="image/png" href="img/icon_mail.png" />
    <!-- JS -->
    <script type="text/javascript\" src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="logout">
        <a class="logout-a" href='logout.php?logout'>Sign Out from <?php echo $user_login . " / " . $user_mail; ?></a>           
    </div>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                        Menu d'administration
                </li>
                <li class="important_sidebar">
                    <a href="contacts.php">Contacts</a>
                </li>
                <li class="important_sidebar">
                    <a href="groups.php">Groupes</a>
                </li>                
                <li class="important_sidebar">
                    <a href="mails.php">Mails</a>
                </li>
                <li>
                    <a href="campaigns.php">Campagnes</a>
                </li>
                <li>
                    <a href="about.php">A propos</a>
                </li>
                <li>
                    <a href="contact.php">Nous contacter</a>
                </li>
                
            </ul>
            
        </div>
</html>