<?php
$title = 'MyApp';
// if (isset($_POST['username']) && !empty($_POST['username'])) {
//     echo $_POST['username'];
// }
ob_start();
?>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/simplex/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<main>
    <h1>Resize your browser to preview okayNav</h1>
</main>

<div class="container">
    <div class="row">
        <?php foreach ($posts as $data) : ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($data['title']); ?></h5>
                        <h6 class="card-subtitle text-muted">TAGS</h6>
                    </div>
                    <!-- "<img src='../uploads/" . $data'picture_ads' . "'>" ?> -->
                    <a href="../uploads/<?= $data['picture_ads'] ?>"><img src="../uploads/<?= $data['picture_ads'] ?>" alt="pas cher" style="width:100%;height:auto;"></a>
                    <div class="card-body">
                        <p class="card-text"><?= nl2br(htmlspecialchars($data['content'])); ?></p>
                    </div>
                    <div class="card-body">
                        <em><a href="/post/<?= $data['id'] ?>">Voir la suite</a></em>
                    </div>
                    <div class="card-footer text-muted">
                        Publié le <?= $data['created_at'] ?>
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