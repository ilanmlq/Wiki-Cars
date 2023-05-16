<style>
    .form-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #eee;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        font-family: Arial, sans-serif;
        font-size: 16px;
    }

    input[type=text],
    input[type=password],
    input[type=email] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        background-color: #f2f2f2;
        font-size: 16px;
    }

    input[type=submit] {
        display: block;
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }
</style>
<?php if (isset($_SESSION['errorRegister'])) { ?>
    <div class="alert alert-warning  alert-dismissible fade show" margin:auto" role="alert">
        <?php echo $_SESSION['errorRegister'];
        unset($_SESSION['errorRegister']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><br>
<?php } ?>
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