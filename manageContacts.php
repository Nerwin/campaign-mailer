<?php include("connection.php"); 
session_start();
?>
<?php
//AJOUT D'UN CONTACT A LA BDD
    if (isset($_POST['createContact']) && $_GET['type'] == 'add')
    {
        /* VALUES */
        $id_contact = uniqid();
        $nom=$_POST['name'];
        $mail=$_POST['mail'];   
        $sql = "INSERT INTO contact (contact_id, contact_mail, contact_name, id_user) VALUES ('" . $id_contact . "', '".utf8_decode($mail)."','".utf8_decode($nom)."', '" . $_SESSION['user'] . "')";
        // use exec() because no results are returned
        $dbh->exec($sql);
        header('Location: contacts.php');
    }
//SUPPRESSION D'UN CONTACT DANS LA BDD
    if ($_GET['type'] == 'delete')
    {
        /* VALUES */
        $id=$_GET['contact_id'];
        //Suppression du contact
        $sql = "DELETE FROM contact WHERE contact_id='". $id ."'";
        $dbh->exec($sql);
        //Suppression dans la table appartient
        $sql = "DELETE FROM appartient WHERE id_contact='" . $id . "'";
        $dbh->exec($sql);
        header('Location: contacts.php');
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
        header('Location: contacts.php');    
    }
//IMPORT FICHIER CSV
    if(isset($_POST['importer']) && $_GET['type'] == 'importer')
    {
        if ($_FILES['csv']['size'] > 0) { 
            //get the csv file
            $file = $_FILES['csv']['tmp_name']; 
            $handle = fopen($file,"r");
            $i=0;
            
            //loop through the csv file and insert into database

            while ($data = fgetcsv($handle,1000,",","'")) 
            {
                $id_contact = uniqid();
                foreach($_POST['radio_groups_name'] as $valeur => $id)
                {
                    $sql = "INSERT INTO appartient (appartient_id, id_contact, id_contact_list) VALUES 
                        (   '',
                            '" . $id_contact . "',
                            '" . $id . "'
                        )
                    ";
                    $dbh->exec($sql);
                }                
                if ($data[0]) 
                { 
                    $contact_name = addslashes($data[0]);
                    $contact_mail = addslashes($data[1]);
                    $contact_mail_without_semilicon = explode(";", $contact_mail);
                    $sql = "INSERT INTO contact (contact_id, contact_name, contact_mail, id_user) VALUES
                        (   '" . $id_contact . "',
                            '".$contact_name."', 
                            '".$contact_mail_without_semilicon[0]."',
                            '" . $_SESSION['user'] . "' 
                        ) 
                    ";
                    $dbh->exec($sql);
                } 
            };
        
        }
        header('Location: contacts.php');
    }
?>