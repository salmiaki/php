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

if(!isset($_GET['id']))
	header('location: sites.php');
else
	$idSite=$_GET['id'];
if(isset($_GET['submit']))
	{
	if($_GET['submit']=='Annuler')
		header('location: sites.php');
	if($_GET['submit']=='Enregistrer')
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
				$nom=htmlentities($_GET['nom']);
				$ville=htmlentities($_GET['ville']);
				$lat=htmlentities($_GET['lat']);
				$long=htmlentities($_GET['long']);
				$insert_stmt = $pdo->prepare("UPDATE  Sites SET Nom=:nom,Ville=:ville,Latitude=:lat,Longitude=:long WHERE idSite=$idSite");
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
	else		// chargement du site a modifier
		{
		$result = $pdo->query("SELECT * from Sites WHERE idSite=$idSite") ;
		
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
	<title>Modifier un site de vente</title>
</head>
<body>
	<form action="modif.php" method="get">
		<fieldset>
			<h3>Modifier un site de vente</h3>
				<br><br>
				<table>
					<thead>
						<tr>
						<input type="hidden" name="id" value="<?php echo $idSite;?>">
			
						<th scope="row"><label for="nom">Nom <?php echo $star_nom;?> :</label><input type="text" class="form-control" id="usr" name="nom" id="nom" value="<?php echo $nom;?>"/>
						</tr>
						<tr>
						<th scope="row"><label for="ville">Ville <?php echo $star_ville;?> :</label><input type="text" class="form-control" id="usr" name="ville" id="ville" value="<?php echo $ville;?>"/>
						</tr>
						<tr>
						<th scope="row"><label for="lat">Latitude <?php echo $star_lat;?> :</label><input type="number" class="form-control" id="usr" step="0.01" name="lat" id="lat" size="7" value="<?php echo $lat;?>"/>
						</tr>
						<tr>
						<th scope="row"><label for="long">Longitude <?php echo $star_long;?> :</label><input type="number" class="form-control" id="usr" step="0.01" name="long" id="long" size="7" value="<?php echo $long;?>"/>
						</thead>
						</table>

						<table>	
						<tbody>
						<tr>
						<td>
						<?php echo $erreur_msg;?>
						</td>
						</tr>
						<tr>
						<td>
					<input type="submit" class="btn btn-info btn-md" name="submit" value="Enregistrer"/>
					
					<input type="submit" class="btn btn-info btn-md" name="submit" value="Annuler"/>
				</td>
				</tr>
				</tbody>
				</table>
		</fieldset>
	</form>
</body>
</html>