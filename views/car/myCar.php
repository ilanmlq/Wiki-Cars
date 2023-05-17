<?php
if (!User::isConnected()) {
    header("Location: ../index.php?url=home&action=home");
    exit;
}
if (isset($_SESSION['validateModifyCar'])) { ?>
    <div class="alert alert-success  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['validateModifyCar'];
        unset($_SESSION['validateModifyCar']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['validateModifyCar'])) { ?>
    <div class="alert alert-success  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['validateModifyCar'];
        unset($_SESSION['validateModifyCar']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['duplicateCar'])) { ?>
    <div class="alert alert-success  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['duplicateCar'];
        unset($_SESSION['duplicateCar']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['modifyPublic'])) { ?>
    <div class="alert alert-success  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['modifyPublic'];
        unset($_SESSION['modifyPublic']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['modifyPrivate'])) { ?>
    <div class="alert alert-success  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['modifyPrivate'];
        unset($_SESSION['modifyPrivate']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['errorAddCar'])) { ?>
    <div class="alert alert-danger  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['errorAddCar'];
        unset($_SESSION['errorAddCar']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php } ?>
<br>
<div class="table-responsive">
    <form method="post" action="index.php?url=cars&action=modifyPublic" class="mx-auto w-75">
        <table class="table table-hover">
            <caption>Fiches véhicules public</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">MARQUE</th>
                    <th scope="col">MODELE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">PDF</th>
                    <th scope="col">VOIR PLUS</th>
                    <th scope="col">MODIFIER</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($allMyPublicCar as $car) {
                ?>
                    <tr>
                        <th><?= $car->idVoiture ?></th>
                        <td><?= $car->marqueVoiture ?></td>
                        <td><?= $car->modeleVoiture ?></td>
                        <td><img src="views/upload<?= $car->image ?>" alt="<?= $car->modeleVoiture ?>" style="max-width: 100px;"></td>
                        <td><a href="views/upload<?= $car->documentTechnique ?>" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ouvrir</a></td>
                        <td><a href="index.php?url=cars&action=carDetail&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-info">Voir plus</a></td>
                        <td><button type="submit" name="modify" class="btn btn-outline-warning" value="<?= $car->idVoiture ?>">Modifier</button></td>
                        <td><button type="submit" name="private" class="btn btn-outline-danger" value="<?= $car->idVoiture ?>">Cacher</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>
<div class="table-responsive">
    <form method="post" action="index.php?url=cars&action=modifyPrivate" class="mx-auto w-75">
        <table class="table table-hover">
            <caption>Fiches véhicules privé</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">MARQUE</th>
                    <th scope="col">MODELE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">PDF</th>
                    <th scope="col">VOIR PLUS</th>
                    <th scope="col">MODIFIER</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($allMyPrivateCar as $car) {
                ?>
                    <tr>
                        <th><?= $car->idVoiture ?></th>
                        <td><?= $car->marqueVoiture ?></td>
                        <td><?= $car->modeleVoiture ?></td>
                        <td><img src="views/upload<?= $car->image ?>" alt="<?= $car->modeleVoiture ?>" class="img-fluid" style="max-width: 100px;"></td>
                        <td><a href="views/upload<?= $car->documentTechnique ?>" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ouvrir</a></td>
                        <td><a href="index.php?url=cars&action=carDetail&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-info">Voir plus</a></td>
                        <td><button type="submit" name="modify" class="btn btn-outline-warning" value="<?= $car->idVoiture ?>">Modifier</button></td>
                        <td><button type="submit" name="public" class="btn btn-outline-danger" value="<?= $car->idVoiture ?>">Afficher</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>
<h1 class="h1 text-center p-4 font-weight-bold text-underline">Crée une fiche</h1>
<form action="index.php?url=cars&action=addCar" method="POST" enctype="multipart/form-data">
    <label for="brand">Marque :</label>
    <input type="text" class="form-control" name="brand" placeholder="BMW" value="<?= $brand ?? '' ?>"><br><br>

    <label for="modelCar">Modèle :</label>
    <input type="text" class="form-control" name="modelCar" placeholder="M3 Compétition" value="<?= $modelCar ?? '' ?>"><br><br>

    <label for="fabricationDate">Date de fabrication:</label>
    <input type="date" name="fabricationDate" class="form-control" value="<?= !empty($fabricationDate) ? date('Y-m-d', strtotime($fabricationDate)) : '' ?>"><br><br>

    <label for="category">Categorie</label>
    <select class="form-select" name="idCategory">
        <?php foreach (Car::getCategory() as $category) { ?>
            <option <?= $category->idCategorie == isset($idCategory) && $category->idCategorie == $idCategory ? 'selected' : '' ?> value="<?= $category->idCategorie ?>"><?= $category->categorie ?></option>
        <?php } ?>
    </select><br><br>
    <label for="motorisation">Motorisation</label>
    <select class="form-select" name="idMotor">
        <?php foreach (Car::getMotorisation() as $motor) { ?>
            <option <?= $motor->idMotorisation == isset($idMotor) && $motor->idMotorisation == $idMotor ? 'selected' : '' ?> value="<?= $motor->idMotorisation ?>"><?= $motor->moteur ?></option>
        <?php } ?>
    </select><br><br>

    <label for="energy">Energie</label>
    <select class="form-select" name="idEnergy">
        <?php foreach (Car::getEnergy() as $energy) { ?>
            <option <?= $energy->idEnergie == isset($idEnergy) && $energy->idEnergie == $idEnergy ? 'selected' : '' ?> value="<?= $energy->idEnergie ?>"><?= $energy->energie ?></option>
        <?php } ?>
    </select><br><br>

    <label for="transmission">Transmission</label>
    <select class="form-select" name="idTransmission">
        <?php foreach (Car::getTransmission() as $transmission) { ?>
            <option <?= $transmission->idTransmission == isset($idTransmission) && $transmission->idTransmission == $idTransmission ? 'selected' : '' ?> value="<?= $transmission->idTransmission ?>"><?= $transmission->transmission ?></option>
        <?php } ?>
    </select><br><br>

    <label for="gearBox">Boîte de vitesse</label>
    <select class="form-select" name="idGearBox">
        <?php foreach (Car::getGearBox() as $gearBox) { ?>
            <option <?= $gearBox->idBoiteVitesse == isset($idGearBox) && $gearBox->idBoiteVitesse == $idGearBox ? 'selected' : '' ?> value="<?= $gearBox->idBoiteVitesse ?>"><?= $gearBox->boiteVitesse ?></option>
        <?php } ?>
    </select><br><br>

    <label for="weight">Poids en kg :</label>
    <input type="number" class="form-control" placeholder="1604" name="weight" value="<?= $weight ?? '' ?>"><br><br>

    <label for="nbDoors">Nombres de portes :</label>
    <input type="number" class="form-control" name="nbDoors" placeholder="3" value="<?= $nbDoors ?? '' ?>"><br><br>

    <label for="nbSeats">Nombres de sièges:</label>
    <input type="number" class="form-control" name="nbSeats" placeholder="5" value="<?= $nbSeats ?? '' ?>"><br><br>

    <label for="comment">Commentaire :</label>
    <textarea name="comment" class="form-control" rows="4"><?= $comment ?? '' ?></textarea><br><br>

    <label for="image1">Image descriptive :</label><br>
    <div class="input-group mb-3">
        <input type="file" name="image" class="form-control" id="inputGroupFile01" accept="image/png, image/jpeg, image/jpg">
    </div>

    <label for="image2">Document technique :</label>
    <div class="input-group mb-3">
        <input type="file" name="technicalDocument" class="form-control" id="inputGroupFile01" accept="application/pdf">
    </div>
    <label for="visibility">Visibiliter</label>
    <select class="form-select" name="idVisibility">
        <?php foreach (Car::getVisibility() as $visibility) { ?>
            <option <?= $visibility->idVisibilite == isset($idVisibility) ? 'selected' : '' ?> value="<?= $visibility->idVisibilite ?>"><?= $visibility->visibilite ?></option>
        <?php } ?>
    </select><br><br>
    <button type="submit" class="btn btn-primary" name="action">Envoyer</button>
</form>