<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Liste De Présence SIMPLON CIV</title>
    <link rel="icon" type="image/jpg" href="Logo Simplon.jpg">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style media="screen">
  		body {
  			background-image: url("Logo Simplon.jpg");
  			background-repeat: no-repeat;
  			background-position: top;
  		}
  	</style>
  </head>
  <body>
<!--
Créeation du formulaire de recherche dans la liste de présence
-->
    <form action="search.php" method="post" class="navbar-form navbar-right" style="padding-top : 100px;">
        <div class="form-group">
          <input name="search_input" type="text" class="form-control" placeholder="Rechercher dans la liste">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"</span></button>
      </form>

    <?php
    error_reporting(E_ALL);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "simplonciv";

    //On appelle le fichier dans lequel a été enregistré le code de connexion à la db
    include('connect2db.php');


    $sql1 ="SELECT * FROM simplonien";
    $result = $conn->query($sql1);

  if ($result->num_rows > 0) {
    //Afficher la liste de présence dans un tableau
    echo "<center>";
    echo "<br>";
    echo "<h3 text-align=\"center\">Liste de présence</h3>";
      echo "<table border=\"2\" cellspacing=\"0\" cellspadding=\"0\" text-align=\"center\"><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>E-mail</th><th>Numéro De Téléphone</th><th>Sexe</th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
          echo "<tr><td>".$row["id"]."</td><td>".$row["nom"]."</td><td>".$row["prenom"]."</td><td>".$row["email"]."</td><td>".$row["numTel"]."</td><td>".$row["sexe"]."</td></tr>";
      }
      echo "</table>";
      echo "</center>";
  } else {
      echo "0 results";
  }


  $conn->close();
  ?>
<br><br><br>
<!--
Code pour enregistrer la liste de présence dans le fichier userData.txt
-->
<form class="navbar-form navbar-right" method="post">
  <input class="btn btn-default" type="submit" name="save" value="Enregistrer la liste dans un fichier">
</form>

<?php
if (isset($_POST['save'])){
    $myfile = fopen("userData.txt", "a+");
    $txt = "Nom : ".$row['nom'].", Prenom : ".$row['prenom'];
    fwrite($myfile, $txt);
    if (fwrite($myfile, $txt)) {
      echo "La liste d'aujourd'hui a bien été enregistrée";
    }
    fclose($myfile);
  }
?>


  </body>
</html>
