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
<?php
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