<?php include_once('templates/header.php'); ?>
    <h2>Nouveau Poste</h2>
    <p>
        Écrivez votre histoire
    </p>
<?php if(!empty($error)): ?>
    <div class="alert alert-danger">
        <strong>Erreur!</strong> <?=$error?>
    </div>
<?php endif; ?>
<?php if(!empty($success)): ?>
    <div class="alert alert-success">
        <strong>Vous avez bien été enregistré!</strong> <?=$success?>
    </div>
<?php endif; ?>
    <div class="container">
        <div class="row">
        <form action="services/serviceNewPost.php" method="post" >
            <input type="hidden" name="poster" value="<?php echo $myid?>" />
            <div class="form-group">
                <label>Title:</label>
                <input class="form-control" type="text" name="title" value="<?php echo getSessionTitle() ?>" />
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" name="description"><?php echo getSessionDescription() ?></textarea>
            </div>
            <div class="form-group">
                <select name="category" class="form-control">
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['category_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Poster</button>
        </form>
        </div>
    </div>
<?php include('footer.php');