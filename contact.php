<?php include("header.php"); 
//session_start();

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>

<head>
    <title>Nous contacter</title>
</head>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Nous contacter</h1>
                        <p>Ici le formulaire de contact</p>
                       
                    </div>
                </div>
            </div>
        </div>
    <!-- /#wrapper -->
    
    <!-- Scripts JS -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
