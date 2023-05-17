<?php

/**
 * @author  Ilan Maleq
 * Project: Wiki-Cars
 * Page: account.php
 * Descriptif : Page de modification du compte
 */
if (!User::isConnected()) {
    header("Location: ../index.php?url=home&action=home");
    exit;
}

?>
<?php if (isset($_SESSION['errorAccount'])) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['errorAccount'];
        unset($_SESSION['errorAccount']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<link rel="stylesheet" href="views/style/css/account.css">
<br>
<div class="form-container">
    <h2>Modifier mes informations</h2>
    <form action="index.php?url=auth&action=account" method="post" enctype="multipart/form-data">

        <label for="email">Email</label>
        <input type="email" placeholder="exemple@gmail.com" name="email" value="<?= $_SESSION['email'] ?>" readonly>

        <label for=" username">Pseudo</label>
        <input type="text" name="pseudo" placeholder="Super Pseudo" value="<?= $_SESSION['pseudo'] ?>">

        <label for=" password">Ancien mot de passe</label>
        <input type="password" name="oldPassword" placeholder="MotDePasseSecret" required>

        <label for=" password">Nouveau mot de passe</label>
        <input type="password" name="password" placeholder="MotDePasseSecret" required>

        <label for="password_confirm">Confirmer mot de passe</label>
        <input type="password" name="confirmPassword" placeholder="MotDePasseSecret" required>

        <input type="submit" name="action" value="Sauver mon profil">
    </form>
</div>