<?php
$title = 'Edit article';
ob_start();
?>

<h1>Faire l'insertion par users d'abord <a href="/edit">cliquez ici une fois fini</a></h1>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>