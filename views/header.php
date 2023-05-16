<!DOCTYPE html>
<html>

<head>
	<title>Wiki-Cars</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>

	<nav class="navbar navbar-expand-lg bg-body-tertiary">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php?url=home&action=home">Toutes les fiches</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<?php if (!User::isConnected()) { ?>
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="index.php?url=auth&action=login">Connexion</a>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<a href="index.php?url=cars&action=myCar" class="nav-link">Mes fiches véhicules</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?url=cars&action=favoriteCar">Mes véhicules favoris</a>
						</li>
						<?php if ($_SESSION['role'] == 1) { ?>
							<li class="nav-item">
								<a class="nav-link" href="index.php?url=admin&action=admin">Administration</a>
							</li>
						<?php } ?>
						<li class="nav-item">
							<a class="nav-link" href="index.php?url=auth&action=logout">Déconnexion</a>
						</li>

					<?php } ?>
				</ul>
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item d-flex align-items-center">
						<?php if (!User::isConnected()) { ?>
							<img src="views/upload/avatar/avatar.png" alt="Avatar de l'utilisateur" style="height: 40px; width: 40px; border-radius: 50%; margin-left: 10px; margin-right: 10px;">
							<a class="nav-link" style="color:green" href="index.php?url=auth&action=login">Invité</a>
						<?php } else if ($_SESSION['role'] == 1) { ?>
							<img src="views/upload<?= $_SESSION['avatar'] ?>" alt="Avatar de l'utilisateur" style="height: 40px; width: 40px; border-radius: 50%; margin-left: 10px; margin-right: 10px;">
							<a class="nav-link" style="color:red" href="index.php?url=auth&action=account"><?= $_SESSION['pseudo'] ?></a>
						<?php } else if ($_SESSION['role'] == 2) { ?>
							<img src="views/upload<?= $_SESSION['avatar'] ?>" alt="Avatar de l'utilisateur" style="height: 40px; width: 40px; border-radius: 50%; margin-left: 10px; margin-right: 10px;">
							<a class="nav-link" style="color:blue" href="index.php?url=auth&action=account"><?= $_SESSION['pseudo'] ?></a>
						<?php } ?>
					</li>
				</ul>
				<span class="navbar-text">
				</span>
			</div>
		</div>
	</nav>