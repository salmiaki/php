<?php

include "connexion.php";
 
?>

<html>
<head>
	<!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap theme -->
	<link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css" /> 
<title>Sites de vente de chaussures</title>
</head>
<body>
	<h2>Listing sites de vente</h2>
	<br><br>
	<table class="table table-bordered">
		<thead class="thead-dark">
			<th scope="col">Identifiant Site</th>
			<th scope="col">Nom du magasin</th>
			<th scope="col">Ville</th>
			<th scope="col">Latitude</th>
			<th scope="col">Longitude</th>
		
			<th></th>
			<th></th>
		</thead>
		<tbody>

<?php 

	$data = $pdo->query('SELECT * from Sites');

	while($objetLigne=$data->fetch(PDO::FETCH_OBJ)) {

		echo "<tr><th scope=\"row\">" . $objetLigne->idSite . "</th>";
		echo "<th scope=\"row\">" . $objetLigne->Nom . "</th>";
		echo "<th scope=\"row\">" . $objetLigne->Ville . "</th>";
		echo "<th scope=\"row\">" .$objetLigne->Latitude . "</th>";
		echo "<th scope=\"row\">" .$objetLigne->Longitude . "</th>";
		echo '<th scope=\"row\"><a href="modif.php?id=' .$objetLigne->idSite . '" class="btn btn-warning">Modifier</a></th>';
		echo '<th scope=\"row\"><a href="delete.php?id=' .$objetLigne->idSite . '" class="btn btn-danger">Supprimer</a></th></tr>';
	}

$data->closeCursor();

?>
		</tbody>
	</table>
<br/>
		<form action="ajout.php" method="get">
			Ajouter un nouveau site de vente de chaussures : <input type="submit" class="btn btn-info btn-md" name="Ajouter" value="Nouveau">
		</form>
</body>
</html>