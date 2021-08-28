<?php
$title = 'Connexion';

ob_start();

?>

<div class="container">
    <h1>Page de connection </h1>
    <form action="/login_post" method="POST">
        <div class="form-group">
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" name="pwd" class="form-control">
        </div>
        <input type="submit" value="Envoyer" class="btn btn-primary my-4">
    </form>
</div>

<?php
$content = ob_get_clean();
require('template.php');
?>