<?php include("connection.php"); 
session_start();
?>
<?php
//AJOUT D'UN GROUPE A LA BDD
    if (isset($_POST['createGroup']) && $_GET['type'] == 'add')
    {
        /* VALUES */
        $nom=$_POST['name'];   
        $sql = "INSERT INTO contact_list (list_name, id_user) VALUES ( '".utf8_decode($nom)."', '" . $_SESSION['user'] . "')";
        // use exec() because no results are returned
        $dbh->exec($sql);
        header('Location: groups.php');
    }
//SUPPRESSION D'UN GROUPE DANS LA BDD
    if ($_GET['type'] == 'delete')
    {
        /* VALUES */
        $id=$_GET['list_id'];   
        $sql = "DELETE FROM contact_list WHERE list_id='". $id ."'";
        // use exec() because no results are returned
        $dbh->exec($sql);
        header('Location: groups.php');
    }
//SUPPRESSION D'UN UTILISATEUR D'UN GROUPE    
    if($_GET['type'] == 'deleteUser'&& !empty($_GET['id']) && !empty($_GET['id_list']))
    {
        $id=$_GET['id'];
        $id_list=$_GET['id_list'];
        
        $sql="DELETE FROM appartient WHERE id_contact_list='" . $id_list . "' AND id_contact='".$id."'";
        $dbh->exec($sql);
        header('Location: groups.php?id=' . $id_list);
    }
//AJOUT D'UN UTILISATEUR DANS UN GROUPE    
    if($_GET['type'] == 'addUser'&& !empty($_GET['id']) && !empty($_GET['id_list']))
    {
        $id=$_GET['id'];
        $id_list=$_GET['id_list'];
        
        $sql="INSERT INTO appartient (id_contact, id_contact_list) VALUES ('" . $id . "' ,'" . $id_list . "')";
        $dbh->exec($sql);
        header('Location: groups.php?id=' . $id_list);
    }
//EDIT D'UN GROUPE    
    if(isset($_POST['updateGroup']) && $_GET['type'] == 'updateList')
    {
        $id_list=$_POST['input_id_list'];
        $name=$_POST['name'];
  
        $sql ="UPDATE contact_list SET list_name='" . $name . "' WHERE list_id='" .$id_list . "'";
        $dbh->exec($sql);
        header('Location: groups.php');    
    }
//EDIT D'UN CONTACT    
    if(isset($_POST['updateContact']) && $_GET['type'] == 'updateContact')
    {
        $id_list=$_GET['id_list'];
        $id_contact=$_POST['id'];
        $name=$_POST['name_contact'];
        $mail=$_POST['mail_contact'];
  
        $sql2 ="UPDATE contact SET contact_name='" . $name . "', contact_mail='" . $mail . "' WHERE contact_id='" . $id_contact . "'";
        $dbh->exec($sql2);
        header('Location: groups.php');    
    }
?>