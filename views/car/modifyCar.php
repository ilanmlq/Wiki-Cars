<?php if ($_SESSION['errorModifyCar']) { ?>
    <div class="alert alert-warning  alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['errorModifyCar'];
        unset($_SESSION['errorModifyCar']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php } ?>
<h1 class="h1 text-center p-4 font-weight-bold text-underline">Modifier la fiche <?= $selectedCar->marqueVoiture ?> <?= $selectedCar->modeleVoiture ?></h1>
<form method="POST" action="index.php?url=cars&action=modifyCar&idCar=<?= $selectedCar->idVoiture ?>" enctype="multipart/form-data">
    <label for="brand">Marque :</label>
    <input type="text" class="form-control" name="brand" value="<?= $selectedCar->marqueVoiture ?>"><br><br>

    <label for="modelCar">Modèle :</label>
    <input type="text" class="form-control" name="modelCar" value="<?= $selectedCar->modeleVoiture ?>"><br><br>

    <label for="fabricationDate">Date de fabrication:</label>
    <input type="date" name="fabricationDate" value="<?= date('Y-m-d', strtotime($selectedCar->dateFabrication)) ?>"><br><br>

    <label for="category">Categorie</label>
    <select class="form-select" name="idCategory">
        <?php foreach (Car::getCategory() as $category) { ?>
            <option <?= $category->idCategorie == $selectedCar->idCategorie ? 'selected' : '' ?> value="<?= $category->idCategorie ?>"><?= $category->categorie ?></option>
        <?php } ?>
    </select><br><br>
    <label for="motorisation">Motorisation</label>
    <select class="form-select" name="idMotor">
        <?php foreach (Car::getMotorisation() as $motor) { ?>
            <option <?= $motor->idMotorisation == $selectedCar->idMotorisation ? 'selected' : '' ?> value="<?= $motor->idMotorisation ?>"><?= $motor->moteur ?></option>
        <?php } ?>
    </select><br><br>

    <label for="energy">Energie</label>
    <select class="form-select" name="idEnergy">
        <?php foreach (Car::getEnergy() as $energy) { ?>
            <option <?= $energy->idEnergie == $selectedCar->idEnergie ? 'selected' : '' ?> value="<?= $energy->idEnergie ?>"><?= $energy->energie ?></option>
        <?php } ?>
    </select><br><br>

    <label for="transmission">Transmission</label>
    <select class="form-select" name="idTransmission">
        <?php foreach (Car::getTransmission() as $transmission) { ?>
            <option <?= $transmission->idTransmission == $selectedCar->idTransmission ? 'selected' : '' ?> value="<?= $transmission->idTransmission ?>"><?= $transmission->transmission ?></option>
        <?php } ?>
    </select><br><br>

    <label for="gearBox">Boîte de vitesse</label>
    <select class="form-select" name="idGearBox">
        <?php foreach (Car::getGearBox() as $gearBox) { ?>
            <option <?= $gearBox->idBoiteVitesse == $selectedCar->idBoiteVitesse ? 'selected' : '' ?> value="<?= $gearBox->idBoiteVitesse ?>"><?= $gearBox->boiteVitesse ?></option>
        <?php } ?>
    </select><br><br>

    <label for="weight">Poids en kg :</label>
    <input type="number" class="form-control" name="weight" value="<?= $selectedCar->poids ?>"><br><br>

    <label for="nbDoors">Nombres de portes :</label>
    <input type="number" class="form-control" name="nbDoors" value="<?= $selectedCar->nbrPortes ?>"><br><br>

    <label for="nbSeats">Nombres de sièges:</label>
    <input type="number" class="form-control" name="nbSeats" value="<?= $selectedCar->nbrPlaces ?>"><br><br>

    <label for="comment">Commentaire :</label>
    <textarea name="comment" class="form-control" rows="4"><?= $selectedCar->commentaire ?></textarea><br><br>

    <label for="visibility">Visibiliter</label>
    <select class="form-select" name="idVisibility">
        <?php foreach (Car::getVisibility() as $visibility) { ?>
            <option <?= $visibility->idVisibilite == $selectedCar->idVisibilite ? 'selected' : '' ?> value="<?= $visibility->idVisibilite ?>"><?= $visibility->visibilite ?></option>
        <?php } ?>
    </select><br><br>
    <button type="submit" class="btn btn-primary" name="action" value="modify">Modifier</button>
</form>