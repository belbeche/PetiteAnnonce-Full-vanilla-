<?php
$title = 'Ads Single';
require_once('model/model.php');
ob_start();
?>

<h1>Affichage d'une annonce</h1>

<p><a href="/">Retour à la liste des annonces</a></p>
<br>

<?php
/*

if ($result['id'] == $result) { ?>
    <a href="<?= $result['id'] ?>">Modifier le post</a>
<?php } ?>
*/
?>


<div class="news">

    <?= "<img src='../uploads/" . $post['picture_ads'] . "' style='width:100%;height:auto;'>"  ?>
    <h3>Titre : <?= htmlspecialchars($post['title'])  ?></h3>
    <p> Contenu : <?= nl2br($post['content']) ?></p>
    <em>Publié le <?= $post['created_at'] ?></em>

</div>


<h2>Commentaires</h2>

<?php foreach ($comments as $comment) : ?>
    <p> Utilisateur: <?= htmlspecialchars($comment['author']) ?></p>
    <em>publié le <?= $comment['comment_date'] ?></em>
    <p>Message : <?= nl2br($comment['comment']) ?></p>
<?php endforeach ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>