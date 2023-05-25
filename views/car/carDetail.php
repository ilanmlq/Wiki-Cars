<?php
/**
 * @author  Ilan Maleq
 * Project: Wiki-Cars
 * Page: carDetail.php
 * Descriptif : Page qui affiche le détail d'une fiche
 */

if ($carDetail->idVisibilite == 1 && ($_SESSION['idUser'] != $carDetail->idUser && $_SESSION['role'] != 1)) {
    header("Location: index.php?url=home&action=home");
}
?>
<div class="container">
    <div class="mt-5"></div>
    <div class="row">
        <div class="col">
            <h1 class="h1 text-primary"><?= $carDetail->marqueVoiture ?> <?= $carDetail->modeleVoiture ?></h1>
            <div>
                <img src="./views/upload<?= $carDetail->image ?>" alt="<?= $carDetail->image ?>" style="width:540px;" class="img-fluid float-end">
                <p class="fw-semibold">Date de fabrication : <?= date('d.m.Y', strtotime($carDetail->dateFabrication)) ?></p>
                <p class="fw-semibold">Categorie : <?= $carDetail->categorie ?></p>
                <p class="fw-semibold">Motorisation : <?= $carDetail->moteur ?></p>
                <p class="fw-semibold">Energie : <?= $carDetail->energie ?></p>
                <p class="fw-semibold">Transmission : <?= $carDetail->transmission ?></p>
                <p class="fw-semibold">Boîte de vitesse : <?= $carDetail->boiteVitesse ?></p>
                <p class="fw-semibold">Poids : <?= $carDetail->poids ?>kg</p>
                <p class="fw-semibold">Nombre de portes : <?= $carDetail->nbrPortes ?></p>
                <p class="fw-semibold">Nombre de places : <?= $carDetail->nbrPlaces ?></p>
                <p class="mt-3"><?= $carDetail->commentaire ?></p>
                <td><a href="views/upload<?= $carDetail->documentTechnique ?> " class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Document technique</a></td>
                <p class="text-muted mb-2 text-end">Fiche crée le <?= $carDetail->dateCreationFiche ?></p>
                <p class="text-muted mb-3 text-end">Écrit par <?= $carDetail->pseudo ?></p>
            </div>

        </div>

    </div>
</div>