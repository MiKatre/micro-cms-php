<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title = 'Blog de Jean Forteroche'; ?>
<?php ob_start(); ?>
<h1 class="font-weight-bold">Jean Forteroche</h1>
<h4 class="text-muted">Billet simple pour l'Alaska</h4>

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