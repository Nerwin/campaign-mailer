<?php include("header.php"); 
//session_start();

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>

<head>
    <title>Mails</title>
</head>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Administration des adresses mails</h1>
                        <p>Ici la gestion import / création / update</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    
    <!-- Scripts JS -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    
</body>
</html>
