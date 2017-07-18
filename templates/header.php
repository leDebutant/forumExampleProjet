<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Forum PHP</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
		<div id="body-wrapper">
			<div class="page-header">
				<h2>Mon Forum</h2>
				<?php if(isSessionSet()==true): ?>
				<div class="btn-group" role="group" aria-label="...">
					<a href="index.php?p=acceuil"><button type="button" class="btn btn-info">Liste de poste</button></a>
					<a href="index.php?p=newPost"><button type="button" class="btn btn-info">New Post</button></a>
					<a href="index.php?p=deconnexion"><button type="button" class="btn btn-warning">Deconnexion</button></a>
				</div>
                    <br/><br/>
                <div class="form-group" role="group">
                    <select name="value" class="form-control" style="width: 300px;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                            <option value=""></option>
                    <?php foreach ($categories as $c): ?>
                            <option value="index.php?p=acceuil&categ=<?= $c['id'] ?>" <?= !empty($categorySelected) ? ($categorySelected == $c['id'] ? "selected":""):"" ?>><?= $c['category_name']?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
				<?php else: ?>
				<div class="btn-group" role="group" aria-label="...">
					<a href="index.php"><button type="button" class="btn btn-default">Login</button></a>
					<a href="index.php?p=signup"><button type="button" class="btn btn-default">Sing up</button></a>
				</div>
				<?php endif; ?>
			</div>
			
			<div id="content">
			
			
		 