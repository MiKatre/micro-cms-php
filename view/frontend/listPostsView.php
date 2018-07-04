<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title = 'Blog de Jean Forteroche'; ?>
<?php ob_start(); ?>
<h1 class="font-weight-bold">Jean Forteroche</h1>
<h4 class="text-muted">Billet simple pour l'Alaska</h4>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Accueil</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Blog <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">À Propos <span class="sr-only">(current)</span></a>
      </li>

    </ul>
  </div>
</nav>
<p class="lead mt-3">Derniers articles :</p>

<?php
foreach($posts as $post)
{
?>
    <div class="news">
        <h3 class="mb-0">
            <a href="index.php?action=post&amp;id=<?= $post->id(); ?>">
                <?= htmlspecialchars($post->title()) ?>
            </a>
        </h3>
        
        <small class="text-muted"><?= strftime("%A %d %B %Y", strtotime($post->date()))?></small>
        <p class="mt-1">
            <?= htmlspecialchars($post->excerpt()) ?>
        </p>
    </div>
<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>