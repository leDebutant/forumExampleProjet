<?php include_once('templates/header.php'); ?>
<h2>Login</h2>
<p>
    Connectez-vous
</p>
<?php if(!empty($error)): ?>
    <div class="alert alert-danger">
        <strong>Erreur!</strong> <?=$error?>
    </div>
<?php endif; ?>
<?php if(!empty($success)): ?>
    <div class="alert alert-success">
        <strong>Validation!</strong> <?=$success?>
    </div>
<?php endif; ?>
<form action="services/serviceLogin.php" method="post">
    <div class="form-groups">
        <label>Username</label>
        <input class="form-control" type="text" name="username" value="<?php echo getUsernameField() ?>"/>
    </div>
    <div class="form-groups">
        <label>Password</label>
        <input class="form-control" type="password" name="password" value="<?php echo getPasswordField() ?>" />
    </div>

    <button class="btn btn-primary" type="submit">Se connecter</button>

</form>
<?php include('footer.php');
