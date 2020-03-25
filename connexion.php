<?php
$titre="connexion";
include("identifiants.php");
include("debut.php");
include("header.php");


if(isset($_POST['formconnexion']))
{	
	$reponse = $pdo->query('SELECT * FROM compte');
	$donnees = $reponse->fetch();
	
	$pseudo = $_POST['pseudo'];
	$pass = $_POST['pass'];
	
	
		
	if(!empty($_POST['pseudo']) AND !empty($_POST['pass']))
	{
		$req = $pdo->prepare('SELECT * FROM compte WHERE pseudoCompte = ?');
		$req->execute(array($_POST['pseudo']));
		$donnees = $req->fetch();
		
		if(!empty($donnees['pseudoCompte'] == 'admin'))
		{
			
			$req = $pdo->prepare('SELECT * FROM compte WHERE mdpCompte = ?');
			$req->execute(array($_POST['pass']));
			$donnees = $req->fetch();
			
			if (!empty($donnees['mdpCompte']== 'truc'))
			{
				
				header('Location: admin.php');
				exit;
			}
			
			
			else
			{
				$erreur = "le mot de passe n'est pas bon !";
			}
		}
		
		elseif(!empty($donnees['pseudoCompte']))
		{
			$req = $pdo->prepare('SELECT * FROM compte WHERE mdpCompte = ?');
			$req->execute(array($_POST['pass']));
			$donnees = $req->fetch();
			if(!empty($donnees['mdpCompte']))
			{
				
				header('Location: index.php');
				exit;
				
			}
			else
			{
				$erreur = "le mot de passe n'est pas bon !";
			}
			
			
		}
		
		else 
		{
			$erreur = "Ce compte n'existe pas !";
		}
	}

	else
	{
		$erreur = "Tous les champs doivent être renplit !";
	}
}


?>

<body class="text-center">

<div class = "container">
    <div class="wrapper">
<form action="connexion.php" method="post" class="form-signin">


	
	<form method="POST" action="" >	
		
		<img src="images/user.png" width="150" height="150" class="d-inline-block align-top" alt=""><br>
				<?php

	if(isset($erreur))
	{
	echo '<font color="red">'.$erreur."</font>";
	}


?>
		

		
			<hr>
		<div class="form-group">
                              <label class="h5">Nom d'utilisateur</label>
										<input type="text" placeholder="Nom d'utilisateur" id="pseudo" name="pseudo" class="form-control"/>
									</div>
						   <div class="form-group">
                              <label class="h5">Mot de passe</label>
										<input type="password" placeholder="Mot de passe" id="pass" name="pass" class="form-control"/>
									</div>
		<div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
  <label class="form-check-label" for="exampleRadios1">
    Rester connecté
  </label>
  
</div>
<br>
								<input class="btn btn-lg btn-primary btn-block" type="submit" name="formconnexion" value="Connexion" href="index.php"/>
									
<hr>
		<a href="register.php"><input type="button" class="btn btn-lg btn-primary btn-block" value="Créer un compte"/></a>
        <p class="mt-5 mb-3 text-muted">&copy; 2020 Véretz</p>
      </form>
	  
		
							
							
	</form>

    </div>
  </div>	
</body>	
	
</center>

</html>
