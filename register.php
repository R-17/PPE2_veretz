<?php
$titre="Enregistrement";
include("identifiants.php");
include("debut.php");
include("header.php");

if(isset($_POST['forminscription']))
{
	$pseudo = $_POST['pseudo'];
	$pass = $_POST['pass'];
		
	if(!empty($_POST['pseudo']) AND !empty($_POST['pass']) )
	{
		
			$req = $pdo->prepare('SELECT * FROM compte WHERE pseudoCompte = ?');
			$req->execute(array($_POST['pseudo']));
			$donnees = $req->fetch();
			if (empty($donnees['pseudoCompte'])) 
			{
				
				$stm = $pdo->prepare("INSERT INTO compte(pseudoCompte, mdpCompte) VALUES(:pseudo, :pass)");
				$pass = password_hash($pass, PASSWORD_DEFAULT);
				$stm->execute(array(
				':pseudo' => $pseudo, 
				':pass' => $pass
				));
				echo 'Bonjour " ' . $pseudo .  ' " et ton mdp crypté est " ' . $pass;
			
			}
			
			else
			{
				
				$erreur = "Ce pseudo existe déjà !";
				
			}
		
		
	}
	else
	{
		
	
	$erreur = "Tous les champs doivent être remplit !";
        
		
	}
	
}

?>

<body class="text-center">

<div class = "container">
    <div class="wrapper">
	
<form action="register.php" method="post" class="form-signin">
	<div class="form-group">

				<label for="pseudo" class="h5">Nom d'utilisateur</label>

				<input type="text" placeholder="Nom d'utilisateur" id="pseudo" name="pseudo"  class="form-control" />
</div>
<div class="form-group">

				<label for="pass" class="h5">Mot de passe</label>
			
				<input type="password" placeholder="Mot de passe" id="pass" name="pass"  class="form-control"/>
			</div>
	
		</tr>
		
	</table>
	<br>
	<input  class="btn btn-lg btn-primary btn-block"type="submit" name="forminscription" value="Je m'inscris"/>
	<hr>
	
	<a href="index.php"><input type="button" class="btn btn-lg btn-primary btn-block" value="Retour à la page d'acceuil"/></a>
	
	
</form>
	
<?php

if(isset($erreur))
{
	echo '<font color="red">'.$erreur."</font>";
}


?>

</div>
</div>

</body>
</html>
