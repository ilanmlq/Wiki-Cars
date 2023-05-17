<?php
if (!User::isConnected()) {
    header("Location: ../index.php?url=home&action=home");
    exit;
}
if (isset($_SESSION['modifyPublicAdmin'])) { ?>
    <div class="alert alert-danger   alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['modifyPublicAdmin'];
        unset($_SESSION['modifyPublicAdmin']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['modifyPrivateAdmin'])) { ?>
    <div class="alert alert-danger   alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['modifyPrivateAdmin'];
        unset($_SESSION['modifyPrivateAdmin']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['adminUserInactiv'])) { ?>
    <div class="alert alert-danger   alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['adminUserInactiv'];
        unset($_SESSION['adminUserInactiv']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php }
if (isset($_SESSION['adminUserActiv'])) { ?>
    <div class="alert alert-danger   alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['adminUserActiv'];
        unset($_SESSION['adminUserActiv']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php } ?>
<br>
<div class="table-responsive">
    <form method="post" action="index.php?url=admin&action=adminUserInactiv" class="mx-auto w-75">
        <table class="table table-hover">
            <caption>Utilisateurs Actif</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOM</th>
                    <th scope="col">PRÉNOM</th>
                    <th scope="col">PSEUDO</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">AVATAR</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // List all the users in the db
                foreach ($allUsers as $user) {
                ?>
                    <tr>
                        <th scope="row"><?= $user->idUser ?></th>
                        <td><?= $user->nom ?></td>
                        <td><?= $user->prenom ?></td>
                        <td><?= $user->pseudo ?></td>
                        <td><?= $user->email ?></td>
                        <td><img src="views/upload<?= $user->avatar ?>" alt="<?= $user->email ?>" style="max-width: 40px;"></td>
                        <td>
                            <?php if ($_SESSION['idUser'] != $user->idUser) { ?>
                                <button type="submit" class="btn btn-outline-danger" name="inactiv" value="<?= $user->idUser ?>">Désactiver</button>

                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>
<div class="table-responsive">
    <form method="post" action="index.php?url=admin&action=adminUserActiv" class="mx-auto w-75">
        <table class="table table-hover">
            <caption>Utilisateurs Désactivés</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOM</th>
                    <th scope="col">PRÉNOM</th>
                    <th scope="col">PSEUDO</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">AVATAR</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // List all the users in the db
                foreach ($inactivUsers as $user) {
                ?>
                    <tr>
                        <th scope="row"><?= $user->idUser ?></th>
                        <td><?= $user->nom ?></td>
                        <td><?= $user->prenom ?></td>
                        <td><?= $user->pseudo ?></td>
                        <td><?= $user->email ?></td>
                        <td><img src="views/upload<?= $user->avatar ?>" alt="<?= $user->email ?>" style="max-width: 40px; max-height: 40px"></td>
                        <td>
                            <button type="submit" class="btn btn-outline-danger" name="activ" value="<?= $user->idUser ?>">Activer</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>
<div class="table-responsive">
    <form method="post" action="index.php?url=admin&action=modifyPrivateAdmin" class="mx-auto w-75">
        <table class="table table-hover">
            <caption>Fiches véhicules publique</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">MARQUE</th>
                    <th scope="col">MODELE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PDF</th>
                    <th scope="col">VOIR PLUS</th>
                    <th scope="col">MODIFIER</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // List all the cars in the db
                foreach ($allCars as $car) {
                ?>
                    <tr>
                        <th><?= $car->idVoiture ?></th>
                        <td><?= $car->marqueVoiture ?></td>
                        <td><?= $car->modeleVoiture ?></td>
                        <td><img src="views/upload<?= $car->image ?>" alt="<?= $car->modeleVoiture ?>" style="max-width: 100px;"></td>
                        <td><?= $car->email ?></td>
                        <td><a href="views/upload<?= $car->documentTechnique ?> " class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ouvrir</a></td>
                        <td><a href="index.php?url=cars&action=carDetail&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-info">Voir plus</a></td>
                        <td><button type="submit" class="btn btn-outline-warning" name="modify" value="<?= $car->idVoiture ?>">Modifier</button></td>
                        <td><button type="submit" class="btn btn-outline-danger" name="private" value="<?= $car->idVoiture ?>">Cacher</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>
<div class="table-responsive">
    <form method="post" action="index.php?url=admin&action=modifyPublicAdmin" class="mx-auto w-75">
        <table class="table table-hover">
            <caption>Fiches véhicules privés</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">MARQUE</th>
                    <th scope="col">MODELE</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PDF</th>
                    <th scope="col">VOIR PLUS</th>
                    <th scope="col">MODIFIER</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // List all the cars in the db
                foreach ($allCarsPrivate as $car) {
                ?>
                    <tr>
                        <th><?= $car->idVoiture ?></th>
                        <td><?= $car->marqueVoiture ?></td>
                        <td><?= $car->modeleVoiture ?></td>
                        <td><img src="views/upload<?= $car->image ?>" alt="<?= $car->modeleVoiture ?>" style="max-width: 100px;"></td>
                        <td><?= $car->email ?></td>
                        <td><a href="views/upload<?= $car->documentTechnique ?>" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ouvrir</a></td>
                        <td><a href="index.php?url=cars&action=carDetail&idCar=<?= $car->idVoiture ?>" class="btn btn-outline-info">Voir plus</a></td>
                        <td><button type="submit" class="btn btn-outline-warning" name="modify" value="<?= $car->idVoiture ?>">Modifier</button></td>
                        <td><button type="submit" class="btn btn-outline-danger" name="public" value="<?= $car->idVoiture ?>">Afficher</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>