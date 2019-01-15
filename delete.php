<?php 

include "connexion.php";

if(!isset($_GET['id']))
	header('location: sites.php');
else
	$idSite=$_GET['id'];
		if(isset($_GET['submit']))
		{
		if($_GET['submit']=='Confirmer')
		{

		// suppression du site
	
		$pdo->query("DELETE FROM Sites WHERE idSite=$idSite") ;
		header('location: sites.php');	
		}
		else
		header('location: sites.php');	
}
else
	{
		// affiche description du site

	$result=$pdo->query("SELECT * FROM Sites WHERE idSite=$idSite") ;
	if($objligne=$result->fetch(PDO::FETCH_OBJ))
			{
			$nom=$objligne->Nom;
			$ville=$objligne->Ville;
			$lat=$objligne->Latitude;
			$long=$objligne->Longitude;
			}	
	}
?>
<html>
<head>
	<!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap theme -->
	<link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css" /> 
<title>Supprimer un site de vente</title>
</head>
<body>
	<form action="delete.php" method="get">
		<fieldset>
			<h3>Confirmation de la suppression ?</h3>
				<br><br>
				<table>
					<thead>
						<tr>
					<th scope="row"><label for="nom">Nom du magasin : </label> <?php echo "$nom <br/>";?></th>
						</tr>
						<tr>
					<th scope="row"><label for="ville">Ville : </label> <?php echo "$ville <br/>";?></th>
						</tr>
						<tr>
					<th scope="row"><label for="lat">Latitude : </label> <?php echo "$lat <br/>";?></th>
						</tr>
						<tr>
					<th scope="row"><label for="long">Longitude : </label> <?php echo "$long <br/>";?></th>
						</tr>
						<tr>
					<th scope="row"><input type="hidden" name="id" value="<?php echo $idSite;?>"></th>
						</tr>
						</thead>
					</table>
					<table>
						<tbody>
						<tr>
					<td>
					<br/><br/>
					<th scope="row"><input type="submit" class="btn btn-info btn-md" name="submit" value="Confirmer" /> </th>
						</td>
						<td>
					<th scope="row"><input  type="submit" class="btn btn-info btn-md" name="submit" value="Annuler" /></th>
					</td>
					</tr>
					</tbody>
				</table>	
		</fieldset>
	</form>
</body>
</html>