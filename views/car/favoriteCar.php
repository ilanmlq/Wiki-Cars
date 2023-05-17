<?php
if (!User::isConnected()) {
    header("Location: ../index.php?url=home&action=home");
    exit;
}
if (isset($_SESSION['deleteFavoriteCar'])) { ?>
    <div class="alert alert-danger   alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['deleteFavoriteCar'];
        unset($_SESSION['deleteFavoriteCar']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php } ?>
<br>
<div class="table-responsive">
    <form method="post" action="index.php?url=cars&action=modifyPublic" class="mx-auto w-75">
        <table class="table table-hover">
            <caption>Fiches favorites</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">MARQUE</th>
                    <th scope="col">MODELE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">PDF</th>
                    <th scope="col">VOIR PLUS</th>
                    <th scope="col">SUPPRIMER</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($allFavoriteCar as $car) {
                ?>
                    <tr>
                        <td><?= $car->marqueVoiture ?></td>
                        <td><?= $car->modeleVoiture ?></td>
                        <td><img src="views/upload<?= $car->image ?>" alt="<?= $car->modeleVoiture ?>" style="max-width: 100px;"></td>
                        <td><a href="views/upload<?= $car->documentTechnique ?>" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ouvrir</a></td>
                        <td><a href="index.php?url=cars&action=carDetail&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-info">Voir plus</a></td>
                        <td><a href="index.php?url=cars&action=deleteFavoriteCar&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-danger">Supprimer</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>