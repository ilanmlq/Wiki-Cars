<?php

/**
 * @author : Ilan Maleq
 * Project: Wiki-Cars
 * Page: index.php
 * Description : Page d'index qui redirige en fonction de l'url
 **/

?>
<?php
if (isset($_SESSION['validRegister'])) { ?>
    <div class="alert alert-success  alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['validRegister'];
        unset($_SESSION['validRegister']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php } ?>

<?php if (isset($_SESSION['validLogin'])) { ?>
    <div class="alert alert-success  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['validLogin'];
        unset($_SESSION['validLogin']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['addFavoriteCar'])) { ?>
    <div class="alert alert-success  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['addFavoriteCar'];
        unset($_SESSION['addFavoriteCar']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['validAccount'])) { ?>
    <div class="alert alert-success  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['validAccount'];
        unset($_SESSION['validAccount']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php } ?>
<div class="form-group" style>
    <form action="index.php" method="GET">
        <input type="hidden" name="url" value="cars">
        <input type="hidden" name="action" value="searchCars">
        <div class="form-group">
            <label for="brand">Marque</label>
            <input value="<?= $brand ?>" type="text" class="form-control" id="brand" name="brand">
        </div>
        <div class="form-group">
            <label for="model">Modèle</label>
            <input value="<?= $model ?>" type="text" class="form-control" id="model" name="model">
        </div>
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select id="category" class="form-control" name="category">
                <option value="">Tous</option>
                <?php foreach (Car::getCategory() as $category) { ?>
                    <option value="<?= $category->idCategorie ?>"><?= $category->categorie ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="motorisation">Motorisation</label>
            <select id="motorisation" class="form-control" name="motorisation">
                <option value="">Tous</option>
                <?php foreach (Car::getMotorisation() as $motor) { ?>
                    <option value="<?= $motor->idMotorisation ?>"><?= $motor->moteur ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="transmission">Transmission</label>
            <select id="transmission" class="form-control" name="transmission">
                <option value="">Tous</option>
                <?php foreach (Car::getTransmission() as $transmission) { ?>
                    <option value="<?= $transmission->idTransmission ?>"><?= $transmission->transmission ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="minYear">Date de fabrication (de)</label>
            <input id="minYear" type="date" class="form-control" name="minYear">
        </div>
        <div class="form-group">
            <label for="maxYear">Date de fabrication (à)</label>
            <input id="maxYear" type="date" class="form-control" name="maxYear">
        </div><br>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>
</div>


<?php if (!empty($searchCar)) { ?>
    <h1 class="h1 text-center p-4 font-weight-bold text-underline">Résultats</h1>
    <div class="card-group">
        <?php foreach ($searchCar as $car) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card mb-4">
                    <img src="views/upload<?= $car->image ?>" class="card-img-top imgCar" alt="<?= $car->modeleVoiture ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $car->marqueVoiture ?> <?= $car->modeleVoiture ?></h5>
                        <div class="flex-row text-end">
                            <?php if (isset($_SESSION['isConnected'])) {
                                $isFavorite = Car::isFavorite($_SESSION['idUser'], $car->idVoiture); ?>
                                <a href="index.php?url=cars&action=duplicateCar&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-success">Dupliquer</a>
                                <?php if (!$isFavorite || ($_SESSION['idUser'] != $isFavorite['idUser'])) { ?>
                                    <a href="index.php?url=cars&action=addFavoriteCar&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-primary">Ajouter au favoris</a>
                                <?php } ?>
                            <?php } ?>
                            <a href="index.php?url=cars&action=carDetail&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-dark">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<h1 class="h1 text-center p-4 font-weight-bold text-underline">Dernière fiches</h1>
<div class="card-group">
    <?php
    foreach ($lastCar as $car) { ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-4">
                <img src="views/upload<?= $car->image ?>" class="card-img-top imgCar" alt="<?= $car->modeleVoiture ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $car->marqueVoiture ?> <?= $car->modeleVoiture ?></h5>
                    <div class="flex-row text-end">
                        <?php
                        if (isset($_SESSION['isConnected'])) {
                            $isFavorite = Car::isFavorite($_SESSION['idUser'], $car->idVoiture);
                        ?>
                            <a href="index.php?url=cars&action=duplicateCar&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-success">Dupliquer</a>
                            <?php
                            if ((!$isFavorite || ($_SESSION['idUser'] != $isFavorite['idUser']))) { ?>
                                <a href="index.php?url=cars&action=addFavoriteCar&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-primary">Ajouter au favoris</a>
                        <?php }
                        } ?>
                        <a href="index.php?url=cars&action=carDetail&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-dark">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<h1 class="h1 text-center p-4 font-weight-bold text-underline">Toutes les fiches</h1>
<div class="card-group">
    <?php
    foreach ($allCar as $car) { ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card mb-4">
                <img src="views/upload<?= $car->image ?>" class="card-img-top imgCar" alt="<?= $car->modeleVoiture ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $car->marqueVoiture ?> <?= $car->modeleVoiture ?></h5>
                    <div class="flex-row text-end">
                        <?php
                        if (isset($_SESSION['isConnected'])) {
                            $isFavorite = Car::isFavorite($_SESSION['idUser'], $car->idVoiture);
                        ?>
                            <a href="index.php?url=cars&action=duplicateCar&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-success">Dupliquer</a>
                            <?php
                            if ((!$isFavorite || ($_SESSION['idUser'] != $isFavorite['idUser']))) { ?>
                                <a href="index.php?url=cars&action=addFavoriteCar&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-primary">Ajouter au favoris</a>
                        <?php }
                        } ?>
                        <a href="index.php?url=cars&action=carDetail&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-dark">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<style>
    .imgCar {
        height: 250px;
        object-fit: cover;
    }
</style>