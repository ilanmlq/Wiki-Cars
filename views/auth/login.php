<?php



?>
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

<?php if (isset($_SESSION['errorLogin'])) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['errorLogin'];
        unset($_SESSION['errorLogin']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
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