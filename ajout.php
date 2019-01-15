<?php 

include "connexion.php";

$nom="";
$ville="";
$lat="";
$long="";
$star_nom="";
$star_ville="";
$star_lat="";
$star_long="";
$erreur_msg="";
$true_star = "<b>*</b>";
$erreur_msg=='<kbd><font size="1">Les champs suivis d\'un * sont obligatoires !</kbd><br/><br/>';

if(isset($_GET['submit']))
	{
	if($_GET['submit']=='Annuler')
		header('location: sites.php');
	if($_GET['submit']=='Ajouter')
		{
		if(isset($_GET['nom']) && isset($_GET['ville']) && isset($_GET['lat']) && isset($_GET['long']))
			{	
			if(empty($_GET['nom']))
				$star_nom=$true_star;
			if(empty($_GET['ville']))
				$star_ville=$true_star;
			if(empty($_GET['lat']))
				$star_lat=$true_star;
			if(empty($_GET['long']))
				$star_long=$true_star;
			if(empty($star_nom) && empty($star_ville) && empty($star_lat) && empty($star_long))
				{
				//insérer
				$nom=htmlentities($_GET['nom']);
				$ville=htmlentities($_GET['ville']);
				$lat=htmlentities($_GET['lat']);
				$long=htmlentities($_GET['long']);
				$insert_stmt = $pdo->prepare("INSERT INTO Sites (Nom,Ville,Latitude,Longitude) VALUES(:nom,:ville,:lat,:long)");
				$insert_stmt->execute(array('nom'=>$nom,'ville'=>$ville,'lat'=>$lat,'long'=>$long)) ;
				
				header("location: sites.php");
				}
			else
				{
				$nom=$_GET['nom'];
				$ville=$_GET['ville'];
				$lat=$_GET['lat'];
				$long=$_GET['long'];
				$erreur_msg='<kbd><font size="2">Les champs suivis d\'un * sont obligatoires !</kbd><br/><br/>';
				}			
			}
		else
			header('location: sites.php');
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
<title>Ajouter un nouveau site de vente de chaussures</title>
</head>
<body>
	<form action="ajout.php" method="get">
		<fieldset>
			<legend><strong>Ajouter un site de vente</strong></legend>
				<table>
				<thead>
				<tr>
				<th scope="row"><label for="nom">Nom du magasin <?php echo $star_nom;?> : </label><input type="text" class="form-control" id="usr" name="nom" id="nom" value="<?php echo $nom;?>"/>
				</th>
				</tr>
				<tr>
				<th scope="row"><label for="ville">Ville <?php echo $star_ville;?> : </label><input type="text" class="form-control" id="usr" name="ville" id="ville" value="<?php echo $ville;?>"/>
				</th>
				</tr>
				<tr>
				<th scope="row"><label for="lat">Latitude <?php echo $star_lat;?> : </label><input type="number" class="form-control" id="usr" step="0.01" name="lat" id="lat" size="7" value="<?php echo $lat;?>"/>
				</th>
				</tr>
				<tr>
				<th scope="row"><label for="ville">Longitude <?php echo $star_long;?> : </label><input type="number" class="form-control" id="usr" step="0.01" name="long" id="long" size="7" value="<?php echo $long;?>"/>
				<br>
				</th>
				</tr>
				</thead>
				</table>

				<table>
				<tbody>
				<tr>
				<?php echo $erreur_msg;?>
				</tr>
				
				<tr>
				<input class="btn btn-info btn-md" type="submit" name="submit" value="Ajouter" />
				</tr>
				<tr>			
				<input class="btn btn-info btn-md" type="submit" name="submit" value="Annuler" />
				</tr>
				
				</tbody>
				</table>
		</fieldset>
	</form>
</body>
</html>