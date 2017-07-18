<?php include_once('templates/header.php'); ?>

<div class="container">
    <img src="https://www.gravatar.com/avatar/<?=gravatar($post['email'])?>" alt="..." class="img-circle pull-left">
    <div >
        <h4><?= $post['username']?></h4>
        <h3><?= $post['title']?></h3>
        <p><?= $post['description']?></p>
    </div>
</div>
<h3>Réponses:</h3>
<div class="row">
    <?php if(!empty($comments)):?>
    <?php foreach($comments as $c):?>
    <div class="col-sm-1">
        <div class="thumbnail">
            <img src="https://www.gravatar.com/avatar/<?=gravatar($c['email'])?>" class="img-responsive user-photo">
        </div>
    </div>

    <div class="col-sm-11">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><?=$c['username']?></strong> <span class="text-muted">A commenté il y a <?=time_elapsed_string($c['date_com'])?> jours</span>
            </div>
            <div class="panel-body">
                <?=$c['comment']?>
            </div>
        </div>
    </div>
    <?php endforeach;?>
    <?php endif;?>
</div>
<!-- le formulaire pour poster des commentaires -->
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
    <form action="services/serviceComment.php" method="post">
        <div class="form-groups">
            <label>Répondre:</label>
            <input name="commentator_id" value="<?= getMyId()?>" type="hidden" />
            <input name="subjet_id" value="<?=$post['id']?>" type="hidden" />
            <textarea name="comment" class="form-control"><?=getSessionComment()?></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Répondre</button>
    </form>
<?php include_once('templates/footer.php'); ?>