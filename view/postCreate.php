<?php
session_start();
require_once('model/model.php');
$title = 'Create Annonce';
ob_start();
?>

<?php

$titre = null;
if (!empty($_POST['title'])) {
    $titre = $_POST['title'];
}

$content = null;
if (!empty($_POST['content'])) {
    $content = htmlspecialchars($_POST['content']);
}

// var_dump($username);
// die();

// var_dump($_SESSION['username']);
// die();
// $userid = null;
// if (!empty($_POST['userid']) && ctype_digit($_POST['userid'])) {
//     $userid = $_POST['userid'];
// }

// une fois le formulaire envoyé , on récupère ces valeurs sinon erreur index undefined
if (isset($_FILES['picture_ads']) and $_FILES['picture_ads']['error'] == 0) {
    // Testons si le fichier n'est pas trop gros
    if ($_FILES['picture_ads']['size'] <= 1000000) {
        // Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES['picture_ads']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
        if (in_array($extension_upload, $extensions_autorisees)) {
            // On peut valider le fichier et le stocker définitivement
            move_uploaded_file($_FILES['picture_ads']['tmp_name'], './uploads/' . $_FILES['picture_ads']['name']);

            $db = getPdo();
            $req = $db->prepare('INSERT INTO posts (title,content,picture_ads,user_id) VALUES (?, ?, ?, ?) ');
            $req->execute([$titre, $content, $_FILES['picture_ads']['name'], $_SESSION['userID']]);
            // if ($_POST) {
            //     var_dump($_POST);
            //     die();
            // }
            header('Location: /');
            exit();
        }
    } else {
        echo 'La taille du fichier est supérieur à la limit autorisée';
    }
}
?>
<?php
if (isset($_SESSION['username']) and !empty($_SESSION['username'])) {
    // echo 'vous êtes connectè(e)' . '<br>';
} else {
    echo "vous êtes pas connecté(e)" . '<br>';
}


$data = isset($_SESSION['userID']) ? !empty($_SESSION['userID']) : null;
// var_dump($data);
// die();



?>
<div class="container">
    <h1>Création d'une annonce</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
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