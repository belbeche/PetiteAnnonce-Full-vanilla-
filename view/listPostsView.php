<?php
session_start();

$title = 'MyApp';
// if (isset($_POST['username']) && !empty($_POST['username'])) {
//     echo $_POST['username'];
// }
ob_start();
?>

<?php
$db = getPdo();
$reqs = $db->prepare("SELECT * FROM posts INNER JOIN users ON user_id = users.id ORDER BY posts.id DESC");
$reqs->execute();
$reqs->fetch();

?>
<div class="jumbotron jumbotron-fluid container">
    <div class="container">
        <h1 class="display-4">Site en construction</h1>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique voluptas soluta voluptatibus illum expedita maiores, exercitationem placeat voluptate nemo consectetur autem eum aliquam aut fuga sapiente itaque error sequi ad..</p>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php foreach ($reqs as $data) : ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($data['title']); ?></h5>
                        <h6 class="card-subtitle text-muted">TAGS</h6>
                    </div>
                    <?= "<img src='../uploads/" . $data['picture_ads'] . "'>" ?>
                    <div class="card-body">
                        <p class="card-text"><?= nl2br(htmlspecialchars($data['content'])); ?></p>
                    </div>
                    <div class="card-body">
                        <em><a href="/post/<?= $data['id'] ?>">Voir la suite</a></em>
                    </div>
                    <div class="card-footer text-muted">
                        Publié le <?= $data['created_at']; ?>
                    </div>
                    <div class="card-footer text-muted">
                        <!-- Je récupere ma valeur dans la BDD -->
                        Publié par <?php echo $data['username']; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>