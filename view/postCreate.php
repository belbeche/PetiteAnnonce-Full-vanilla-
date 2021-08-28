<?php
require_once('model/model.php');
require_once('controller/controller.php');
$title = 'Create Annonce';
ob_start();
?>

<?php

// var_dump($username);
// die();

// var_dump($_SESSION['username']);
// die();
// $userid = null;
// if (!empty($_POST['userid']) && ctype_digit($_POST['userid'])) {
//     $userid = $_POST['userid'];
// }

// une fois le formulaire envoyé , on récupère ces valeurs sinon erreur index undefined

?>

<?php

$data = isset($_SESSION['userID']) ? !empty($_SESSION['userID']) : null;

?>
<div class="container">
    <h1>Création d'une annonce</h1>
    <form action="/create" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre de l'annonce</label>
            <input type="text" name="title" class="form-control" placeholder="Titre de l'annonce">
        </div>
        <div class="form-group">
            <label for="content">Contenu de l'annonce</label>
            <textarea name="content" id="content" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="picture_ads">L'image de l'annonce </label>
            <input type="file" name="picture_ads" class="form-control" placeholder="image de l'annonce">
        </div>
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type='hidden' name='userid' value='<?= $data ?>' class="form-control" readonly>
            <input type='text' value='<?= $_SESSION['username'] ?>' class="form-control" readonly>
        </div>
        <button type="submit" class="btn btn-primary my-4">Enregistrer</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>