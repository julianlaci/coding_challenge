<?php require('partials/head.php'); ?>

<h1>Blog Page</h1>

<?php foreach ($posts as $post) { ?>
    <hr>
    <h1><?= $post->title ?></h1>
    <h5><?= $post->username ?></h5>
    <p><?= $post->description ?></p>
<?php } ?>

<hr>
<div class="pagination">
    <a href="#">&laquo;</a>
    <a href="/?page=0">1</a>
    <a href="/?page=1">2</a>
    <a href="/?page=2">3</a>
    <a href="/?page=3">4</a>
    <a href="/?page=4">5</a>
    <a href="/?page=5">6</a>
    <a href="/?page=6">&raquo;</a>
</div>
<?php require('partials/footer.php'); ?>
