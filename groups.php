<?php include("header.php"); ?>
<head>
    <script language="Javascript">
        function popFormList(listId)
        {
                if(document.getElementById('formUpdateList').style.visibility="hidden")
                {
                    var name = document.getElementById('row-list-'+listId).innerHTML;
                    console.log(name, listId);
                    $('#input_update_list').val(name);
                    $('#input_update_list2').val(listId);
                    document.getElementById('formUpdateList').style.visibility="visible";
                    document.getElementById('formUpdateContact').style.visibility="hidden";
                }
        }
        
        function popFormContact(contactId)
        {
                if(document.getElementById('formUpdateContact').style.visibility="hidden")
                {
                    var name = document.getElementById('td-contact-name-'+contactId).innerHTML;
                    var mail = document.getElementById('td-contact-mail-'+contactId).innerHTML;
                    console.log(name, mail, contactId);
                    $('#input_update_contact1').val(name);
                    $('#input_update_contact3').val(mail);
                    $('#input_update_contact2').val(contactId);
                    document.getElementById('formUpdateContact').style.visibility="visible";
                    document.getElementById('formUpdateList').style.visibility="hidden";
                }
        }
        function popFormContactOther(contactId)
        {
                if(document.getElementById('formUpdateContact').style.visibility="hidden")
                {
                    var name = document.getElementById('td-contact2-name-'+contactId).innerHTML;
                    var mail = document.getElementById('td-contact2-mail-'+contactId).innerHTML;
                    console.log(name, mail, contactId);
                    $('#input_update_contact1').val(name);
                    $('#input_update_contact3').val(mail);
                    $('#input_update_contact2').val(contactId);
                    document.getElementById('formUpdateContact').style.visibility="visible";
                    document.getElementById('formUpdateList').style.visibility="hidden";
                }
        }
    </script> 
    <title>Mes groupes</title>
</head>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Mes groupes de mails</h1>
                    </div>
                    <div class="groups-container">
                        <h3 class="col-md-6">Mes groupes</h3>
                        <h3 class="col-md-6">Contacts : <?php if(!empty($_GET['id'])) echo $_GET['id']; ?></h3>
                        <!--Affichage de la liste des contact_list -->
                        <div class="col-md-6 div-contact-list">
                            <table class="col-md-12 table table-hover">
                                <?php 
                                    $sql = "SELECT list_name, list_id FROM contact_list";
                                    foreach ($dbh->query($sql) as $row)
                                    {
                                        echo "
                                            <tr>
                                                <td>" . $row["list_id"] . "</td>
                                                <td>
                                                    <a id='row-list-" . $row['list_id'] . "' cursor='pointer' href='?id=".$row['list_id']."'>" . $row['list_name'] . "</a>
                                                </td>
                                                <td>
                                                    <a title='modifier' onclick='popFormList(" . $row['list_id'] . ")'>
                                                        <img class='iconeImage' src='img/engrenage.png'/>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a title='Supprimer' href='manageGroups.php?type=delete&list_id=". $row["list_id"] . "'>
                                                        <img class='iconeImage' src='img/croix.png'/>
                                                    </a>
                                                </td>
                                            </tr>";
                                    }
                                ?>
                            </table>
                        </div>
                        <!--Affichage de la liste des contact de la contact_list -->
                        <div class="col-md-6 div-contact">
                            <table class="col-md-12 table table-hover">
                            <?php 
                            if(!empty($_GET['id']))
                            {
                                $sql = "SELECT contact_name, contact_mail, contact_id FROM contact, appartient, contact_list WHERE appartient.id_contact_list = contact_list.list_id AND contact.contact_id = appartient.id_contact AND contact_list.list_id =". $_GET['id'];
                                foreach ($dbh->query($sql) as $row)
                                {
                                    echo "
                                        <tr>
                                            <td id='td-contact-id-" . $row['contact_id'] . "'>" . $row['contact_id'] . "</td>
                                            <td id='td-contact-name-" . $row['contact_id'] . "'>" . $row["contact_name"] ." </td>
                                            <td id='td-contact-mail-" . $row['contact_id'] . "'> ". $row["contact_mail"] ."</td>
                                            <td>
                                                <a title='modifier' onclick='popFormContact(\"" . $row['contact_id'] . "\")'>
                                                    <img class='iconeImage' src='img/engrenage.png'/>
                                                </a>
                                            </td>
                                            <td>
                                                <a title='Supprimer' href='manageGroups.php?type=deleteUser&id=". $row['contact_id'] ."&id_list=" . $_GET['id'] ."'>
                                                    <img class='iconeImage' src='img/croix.png'/>
                                                </a>
                                            </td>
                                        </tr>";
                                }
                            }
                            ?>
                            </table>
                        </div>
                    </div>
                    <div>
                        <h3 class="col-md-6">Créer un groupe</h3>
                        <h3 class="col-md-6">Mes contacts</h3>
                        <div class="col-md-6 div-list div-ajout">
                            <!-- TODO : Prendre en compte l'utilisateur connecté pour id_user -->
                            <!-- Formulaire d'ajout de contact_list -->                            
                            <form method="post" action="manageGroups.php?type=add">
                                <div class="form-group">
                                    <label>Nom du groupe : </label>
                                    <input class="form-control" type="text" name="name" placeholder="Nom du groupe" required><br>
                                    <input class="btn-info" type="submit" name="createGroup" value="Créer">
                                </div>
                            </form>
                        </div>
                        <div class='col-md-6 div-other-contact'>
                        <!--Affichage de la liste des contact pour ajout dans une contact_list -->                            
                            <table class="col-md-12 table table-hover">
                            <?php 
                            if(!empty($_GET['id']))
                            {
                                $sql = "SELECT distinct (contact.contact_name), contact.contact_id, contact.contact_mail FROM contact WHERE contact_name not in (SELECT contact_name FROM contact, appartient, contact_list WHERE appartient.id_contact_list = contact_list.list_id AND contact.contact_id = appartient.id_contact AND contact_list.list_id ='" . $_GET['id'] . "')";
                                foreach ($dbh->query($sql) as $row)
                                {
                                    echo "
                                        <tr>
                                            <td id='td-contact2-id-" . $row['contact_id'] . "'>" . $row['contact_id'] . "</td>
                                            <td id='td-contact2-name-" . $row['contact_id'] . "'>" . $row["contact_name"] ." </td>
                                            <td id='td-contact2-mail-" . $row['contact_id'] . "'> ". $row["contact_mail"] ."</td>
                                            <td>
                                                <a title='modifier' onclick='popFormContactOther(" . $row['contact_id'] . ")'>
                                                    <img class='iconeImage' src='img/engrenage.png'/>
                                                </a>
                                            </td>
                                            <td>
                                                <a title='Ajouter' href='manageGroups.php?type=addUser&id=". $row['contact_id'] ."&id_list=" . $_GET['id'] ."'>
                                                    <img class='iconeImage' src='img/plus.png'/>
                                                </a>
                                            </td>
                                        </tr>";
                                }
                            }
                            ?>
                            </table>
                        </div>
                    </div>
                    <h3 class="col-md-12">Modifier</h3>
                    <div class="col-md-6 div-update">
                        <!-- Formulaire de modification de contact-list -->
                        <div name="formUpdateList" id="formUpdateList" style="visibility: hidden"> 
                            <form method="post" action="manageGroups.php?type=updateList"> 
                                <div class="form-group">
                                    <input style="visibility: hidden" class="form-control" name = "input_id_list" id="input_update_list2"></input>
                                    <label>Nom du groupe : </label>
                                    <input class="form-control" id="input_update_list" type="text" name="name" placeholder="Nom du groupe" required><br>
                                    <input class="btn-info" type="submit" name="updateGroup" value="Modifier">
                                </div>
                            </form>
                        </div>
                        <!-- Formulaire de modification de contact -->
                        <div name="formUpdateContact" id="formUpdateContact" style="visibility: hidden"> 
                            <form method="post" action="manageGroups.php?type=updateContact"> 
                                <div class="form-group">
                                    <input style="visibility: hidden" class="form-control" id="input_update_contact2" name = "id"></input>
                                    <label>Nom du contact : </label>
                                    <input class="form-control" id="input_update_contact1" type="text" name="name_contact" placeholder="Nom du groupe" required><br>
                                    <label>Email du contact : </label>
                                    <input class="form-control" id="input_update_contact3" type="text" name="mail_contact" placeholder="Email du contact" required><br>
                                    <input class="btn-info" type="submit" name="updateContact" value="Modifier">
                                </div>
                            </form>
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>