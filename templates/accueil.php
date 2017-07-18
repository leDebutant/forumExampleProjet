<?php include_once('templates/header.php'); ?>
<?php if (!empty($success)): ?>
    <div class="alert alert-success">
        <strong><?= $success ?></strong>
    </div>
<?php endif; ?>
<?php if(!empty($posts)): ?>
    <?php foreach($posts as $p): ?>
    <div id="">
        <div>
            <div class="user-post-header">
                <a href="" lambdaeverupdated="2"><?=$p['username']?></a> <small>dit</small>
                <div>
                    <?= reformatDate($p['date_post'])?>
                    <span aria-hidden="true" class="glyphicon glyphicon-comment"></span> <?=$p['nb_comment']?>
                </div>
                <div class="user-post-header__label">
                    <a href="index.php?p=viewPost&postid=<?=$p['id']?>"><?=$p['title']?></a>
                </div>
            </div>
            <div>
                <blockquote>
                    <?=shortenText($p['description'])?>...
                </blockquote>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div id="">
    <div>
        Il n'y a pas de posts dans cette catégorie
    </div>
    </div>
<?php endif; ?>
<?php include_once('templates/footer.php'); ?>