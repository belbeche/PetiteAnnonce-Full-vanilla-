<?php require_once('models/model.php'); ?>
<?php $titre = 'Fly'; ?>

<?php ob_start(); ?>

<section>
    <div class="fond text-white py-20">
        <div class="container mx-auto flex flex-col md:flex-row my-6 md:my-24">
            <div class="flex flex-col w-full lg:w-1/3 p-8">
                <p class="ml-6 text-yellow-300 text-lg uppercase tracking-loose">REVOIR</p>
                <p class="text-3xl md:text-5xl my-4 leading-relaxed md:leading-snug">L'été n'est pas FINI !
                </p>
                <p class="text-sm md:text-base leading-snug text-gray-50 text-opacity-100">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis sint adipisci recusandae architecto voluptatem vitae nisi sapiente alias nobis perspiciatis minima quae tempore, quam numquam qui exercitationem enim asperiores voluptas.
                </p>
            </div>
            <div class="flex flex-col w-full lg:w-2/3 justify-center">
                <div class="container w-full px-4">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-white">
                                <div class="flex-auto p-5 lg:p-10">
                                    <h4 class="text-2xl mb-4 text-black font-semibold">#Meilleures endroit</h4>
                                    <form id="feedbackForm" action="" method="">
                                        <div class="relative w-full mb-3">
                                            <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="createdAt">Date départ</label>
                                            <input type="date" name="createdAt" id="createdAt" class="border-0 px-3 py-3 rounded text-sm shadow w-full
                    bg-gray-300 placeholder-black text-gray-800 outline-none focus:bg-gray-400" style="transition: all 0.15s ease 0s;" required />
                                        </div>
                                        <div class="relative w-full mb-3">
                                            <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="place_dispo">Nombres de places</label>
                                            <input type="number" name="nb_places_dispo" id="place_dispo" class="border-0 px-3 py-3 rounded text-sm shadow w-full
                    bg-gray-300 placeholder-black text-gray-800 outline-none focus:bg-gray-400" style="transition: all 0.15s ease 0s;" required />
                                        </div>
                                        <div class="text-center mt-6">
                                            <button id="feedbackBtn" class="bg-yellow-300 text-black text-center mx-auto active:bg-yellow-400 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all 0.15s ease 0s;">Rechercher
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PHP -->
<?php
$db = getPdo();
$all_avaibles = $db->query('SELECT * FROM chambres ORDER BY id DESC');

if (isset($_GET['nb_places_dispo'])) {
    $recherche = intval($_GET['nb_places_dispo']);
    $date = date($_GET['createdAt']);

    $all_avaibles = $db->query('SELECT * FROM chambres WHERE nb_places_dispo = "' . $recherche . '" ORDER BY id DESC');
}
?>
<!-- ./PHP -->
<div class="container w-full min-h-screen place-content-center bg-gray-900">
    <div class="row">
        <?php if ($all_avaibles->rowCount() > 0) { ?>
            <?php foreach ($all_avaibles as $data) : ?>
                <div class="col-md-4">
                    <div class="rounded-lg">
                        <div class="bg-gray-100 rounded-lg w-96">
                            <a href="<?= $data['image'] ?>"><img src="<?= $data['image'] ?>" alt="" class="w-full h-48 transition duration-300 rounded-t-lg sm:h-56 opacity-80 hover:opacity-100" /></a>

                            <div class="px-10 py-6 mb-10 text-center">
                                <div class="mb-4 text-3xl font-bold text-purple-600 uppercase"><?= htmlspecialchars($data['titre']); ?></div>
                                <span class="text-sm">
                                    <?= nl2br(htmlspecialchars($data['contenu'])); ?>
                                </span>
                            </div>
                            <button onclick="window.location.href='/post/<?= $data['id'] ?>'" class="w-full h-16 text-lg font-extrabold text-gray-100 transition duration-300 bg-purple-600 rounded-b-lg hover:bg-purple-700">VOIR LA SUITE</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php
        } else {
            echo 'Aucun enregistrement trouvé';
        } ?>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    });
</script>


<?php $content = ob_get_clean(); ?>

<?php require('base.php'); ?>