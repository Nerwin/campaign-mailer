<?php include("header.php"); ?>

<head>
    <script language="Javascript">
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
                }
        }
        function checkList()
        {
            var _class = $(".is-checked");
            console.log($("#checkAll").prop('checked'));
            $.each(_class,function(index,element){
                if ($(element).prop("checked") != $("#checkAll").prop('checked'))
                {
                    $(element).prop("checked", !$(element).prop("checked"));
                }
                else
                {
                    $(element).prop("checked", $(element).prop("checked"));    
                }
                       
            });
        }
        
    </script>
    <title>Mes Contacts</title>
</head>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Mes Contactes</h1>
                    </div>
                    <div class="groups-container">
                        <!--Affichage de la liste des contact -->
                        <div class="col-md-6 div-update">
                            <table class="col-md-12 table table-hover">
                                <?php 
                                    $sql = "SELECT contact_name, contact_id, contact_mail FROM contact";
                                    foreach ($dbh->query($sql) as $row)
                                    {
                                        echo "
                                            <tr>
                                                <td id='td-contact-id-" . $row['contact_id'] . "'>" . $row["contact_id"] . "</td>
                                                <td id='td-contact-name-" . $row['contact_id'] . "'>" . $row['contact_name'] . "</td>
                                                <td id='td-contact-mail-" . $row['contact_id'] . "'>" . $row['contact_mail'] . "</td>
                                                <td>
                                                    <a title='modifier' onclick='popFormContact(" . $row['contact_id'] . ")'>
                                                        <img class='iconeImage' src='img/engrenage.png'/>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a title='Supprimer' href='manageContacts.php?type=delete&contact_id=". $row["contact_id"] . "'>
                                                        <img class='iconeImage' src='img/croix.png'/>
                                                    </a>
                                                </td>
                                            </tr>";
                                    }
                                ?>
                            </table>
                        </div>
                        <div class="col-md-6 div-list div-update">
                            <!-- TODO : Prendre en compte l'utilisateur connecté pour id_user -->
                            <!-- Formulaire d'ajout de contact -->                            
                            <form method="post" action="manageContacts.php?type=add">
                                <div class="form-group">
                                    <label>Nom du contact : </label>
                                    <input class="form-control" type="text" name="name" placeholder="Nom du contact" required><br>
                                    <label>Mail du contact : </label>
                                    <input class="form-control" type="text" name="mail" placeholder="Mail du contact" required><br>
                                    <input class="btn-info" type="submit" name="createContact" value="Créer">
                                </div>
                            </form>
                        </div>
                        <h3 class="col-md-6">Modifier</h3>
                        <h3 class="col-md-6">Importer</h3>
                        <div class="col-md-6 div-update">
                        <!-- Formulaire de modification de contact -->
                            <div name="formUpdateContact" id="formUpdateContact" style="visibility: hidden"> 
                                <form method="post" action="manageContacts.php?type=updateContact"> 
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
                        <!--IMPORT DE FICHIER CSV-->
                        <div class="col-md-6">
                            <form method="post" action="manageContacts.php?type=importer" enctype="multipart/form-data">
                                    <input onclick='checkList()' id='checkAll' type='checkBox' name=''><strong>Cocher tout</strong><br/>
                                <?php 
                                    $sql = "SELECT list_name, list_id FROM contact_list";
                                    foreach ($dbh->query($sql) as $row)
                                    {
                                        echo "<input class='is-checked' type='checkbox' name='radio_groups_name[]' value='" . $row['list_id'] . "'>" . $row['list_name'] . "<br/>";
                                    }
                                ?>    
                                <input type="file" name="csv" id='csv' accept=".csv" required/>
                                <input class="btn-info" type="submit" name="importer" value="Importer" />
                            </form>
                        </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
</body>
</html>