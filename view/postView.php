<?php
$title = 'Ads Single';
require_once('models/model.php');
ob_start();
?>

<div class="row">
    <div class="col-md-6">
        <div class="news container">
            <h1>Affichage d'une annonce</h1>

            <p><a href="/">Retour à la liste des annonces</a></p>
            <br>
            <div class="image">
                <?= "<img src='" . $post['image'] . "' style='width:400px;height:auto;'>"  ?>
            </div>
            <h3>Titre : <?= htmlspecialchars($post['titre'])  ?></h3>
            <p> Contenu : <?= nl2br($post['contenu']) ?></p>
            <em>Publié le <?= $post['created_at'] ?></em>
        </div>
    </div>
    <div class="col-md-6">
        Formulaire de contact
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('base.php'); ?>