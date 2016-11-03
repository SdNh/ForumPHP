<?php
  //connection au serveur
  $cnx = mysql_connect( "localhost", "root", "" ) ;
 
  //sélection de la base de données:
  $db  = mysql_select_db( "forumphp" ) ;
 
  //récupération des valeurs des champs:
  //nom:
  $title     = $_POST["title"] ;
  //prenom:
  $description = $_POST["description"] ;
  //adresse:
  $image = $_POST["image"] ;
  
 
  //création de la requête SQL:
  $sql = "INSERT  INTO forum (title, description, image)
            VALUES ( '$title', '$description', '$image') " ;
 
  //exécution de la requête SQL:
  $requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
 
  //affichage des résultats, pour savoir si l'insertion a marchée:
  if($requete)
  {
    echo("L'insertion a été correctement effectuée") ;
  }
  else
  {
    echo("L'insertion à échouée") ;
  }
?>