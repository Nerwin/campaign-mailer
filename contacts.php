<?php include_once("header.php"); 
?>

<head>
    <title>Mes Contacts</title>
</head>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Mes contacts</h1>
                        <br>
                        <h2>Ici la liste de nos contacts</h2>
                        <br />
                        <div id="contacts">
                        <?php $sql = "SELECT mail, name FROM contact";
                            foreach ($dbh->query($sql) as $row)
                            {
                                echo $row["name"] ." - ". $row["mail"] ."<br/>";
                            }
                            $dbh = Null;
                        ?>
                        </div>  
                        <br>
                        <h2>Création de contact</h2>
                        <br />
                        <form method="post" action="contacts.php">
                            Name: <input type="text" name="name" placeholder="name" required><br>
                            Email: <input type="email" name="mail" placeholder="mail" required><br>
                            ListId: <select name="listId"><option>1</option></select><br>
                            <input type="submit" name="createContact" value="Créer">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    
    <!-- Scripts JS -->
    <script src="../js/jquery.js"></script>
    <script src="../js/function.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>


<?php

if (isset($_POST['createContact']))
{
    /* VALUES */
    $nom=$_POST['name'];
    $email=$_POST['mail'];
    $listId=$_POST['listId'];
    
    
    
    try 
    {
        
         $sql = "INSERT INTO contact (name, mail, id_list) VALUES ( '".utf8_decode($nom)."',  '".utf8_decode($email)."', '".utf8_decode($listId)."')";
        // use exec() because no results are returned
        $dbh->exec($sql);
        echo "New record created successfully";
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

    $dbh = null;


//     $sql = "INSERT INTO contact (name, mail, id_list) VALUES ( '".utf8_decode($nom)."',  '".utf8_decode($email)."', '".utf8_decode($listId)."')";
//     //$dbh->query($sql);
//     
//     $res = $sql->fetch(PDO::FETCH_ASSOC);
// 
//     if ($dbh->query($sql) === TRUE) {
//         echo "New record created successfully";
//     } else {
//         echo "Error: " . $sql . "<br>" . $dbh->error;
//     }
// 
//     $dbh->close();

    /*
    $sql = "UPDATE fmail SET nom='?', email='?', numero='?' WHERE id='?'";
    $req = $this->db->prepare($sql);
    $d = array($nom, $email,$listId);     
    $req->execute($d);*/
}
?>