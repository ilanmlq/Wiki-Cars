<?php

/**
 * @author  Ilan Maleq
 * Project: Wiki-Cars
 * Page: login.php
 * Descriptif : Page de connexion
 */
if (isset($_SESSION['errorLogin'])) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['errorLogin'];
        unset($_SESSION['errorLogin']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<link rel="stylesheet" href="views/style/css/account.css">
<br>
<div class="form-container">
    <h2>Connexion</h2>
    <form action="index.php?url=auth&action=validLogin" method="post">
        <label for="email">E-mail</label>
        <input type="email" placeholder="exemple@gmail.com" id="username" name="email" value="<?= $email ?? '' ?>" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="MotDePasseSecret" required>

        <input type="submit" name="action" value="Se connecter">
    </form>
    <p>Pas encore inscrit ? <a href="./index.php?url=auth&action=register">Inscription</a></p>
</div>