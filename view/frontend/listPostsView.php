<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title = 'Blog de Jean Forteroche'; ?>
<?php ob_start(); ?>


<div id="main" class="px-3">

<h1 id="accueil">Derniers Articles</h1>

<div id="carouselExampleIndicators" class="carousel slide rounded mt-5" >
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">

    <div class="carousel-item active">
      <img class="d-block w-100 rounded" src="static/img/alaska-1.jpg" alt="First slide">
      <a href="index.php?action=post&id=1">
        <div class="carousel-caption d-none d-md-block">
          <p>Billet Simple pour l'alaska</p>
        </div>
      </a>
    </div>

    <div class="carousel-item rounded">
      <img class="d-block w-100 rounded" src="static/img/alaska-3.jpg" alt="First slide">
      <a href="index.php?action=post&id=2">
        <div class="carousel-caption d-none d-md-block">
          <h5>Chapitre 0</h5>
          <p>Un aperclçu de l'Alaska</p>
        </div>
      </a>
    </div>

    <div class="carousel-item rounded">
      <img class="d-block w-100  rounded" src="static/img/alaska-2.jpg" alt="First slide">
      <a href="index.php?action=post&id=3">
        <div class="carousel-caption d-none d-md-block">
          <h5>Chapitre Premier</h5>
          <p>La grande arrivée</p>
        </div>
      </a>
    </div>




  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Précédant</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Suivant</span>
  </a>
</div>

  <p class="lead mt-3"> 5 derniers articles :</p>

  <?php
  $i = 0;
  foreach($posts as $post) {
    if($i < 5) {
      $i++;
  ?>
      <div class="news">
          <h3 class="mb-0">
              <a href="index.php?action=post&amp;id=<?= $post->id(); ?>">
                  <?= htmlspecialchars($post->title()) ?>
              </a>
          </h3>
          
          <small class="text-muted"><?= strftime("%A %d %B %Y", strtotime($post->date()))?></small>
          <p>
          <?= strip_tags(htmlspecialchars_decode($post->excerpt())) ?>
          </p>
      </div>
  <?php }} ?>

  <a href="index.php?action=showBlog"><p class="lead mt-3">Voir plus &rarr;</p></a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>