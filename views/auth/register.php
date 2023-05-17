<?php 
/**
 * @author  Ilan Maleq
 * Project: Wiki-Cars
 * Page: register.php
 * Descriptif : Page d'inscription  
 */
if (isset($_SESSION['errorRegister'])) { ?>
    <div class="alert alert-warning  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['errorRegister'];
        unset($_SESSION['errorRegister']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php } ?>
<link rel="stylesheet" href="views/style/css/account.css">
<br>
<div class="form-container">
    <h2>Inscription</h2>
    <form action="index.php?url=auth&action=validRegister" method="post" enctype="multipart/form-data">
        <label for="last_name">Nom</label>
        <input type="text" placeholder="Maleq" name="name" value="<?= $name ?? '' ?>" required>

        <label for="first_name">Prénom</label>
        <input type="text" placeholder="Ilan" name="firstName" value="<?= $firstName ?? '' ?>" required>

        <label for="email">E-mail</label>
        <input type="email" placeholder="exemple@gmail.com" name="email" value="<?= $email ?? '' ?>" required>

        <label for=" username">Pseudo</label>
        <input type="text" name="pseudo" placeholder="Super Pseudo" value="<?= $pseudo ?? '' ?>" required>

        <label for=" password">Mot de passe</label>
        <input type="password" name="password" placeholder="MotDePasseSecret" required>

        <label for="password_confirm">Confirmer mot de passe</label>
        <input type="password" name="confirmPassword" placeholder="MotDePasseSecret" required>

        <label for="avatar">Avatar</label>
        <input type="file" name="file" accept="image/png, image/jpeg, image/jpg">

        <input type="submit" name="action" value="S'inscrire">
    </form>
    <p>Déjà inscrit ? <a href="index.php?url=auth&action=login">Connexion</a></p>
</div>