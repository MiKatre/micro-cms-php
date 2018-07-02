<?php $title = 'Blog de Jean Forteroche'; ?>
<?php ob_start(); ?>
<h1 class="font-weight-bold">Jean Forteroche</h1>
<h4 class="text-muted">Billet simple pour l'Alaska</h4>

<p class="lead mt-3">Derniers billets du blog :</p>

<?php require_once('helpers/helpers.php'); ?>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3 class="mb-0">
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">
                <?= htmlspecialchars($data['title']) ?>
            </a>
        </h3>
        <?php setlocale(LC_TIME, "fr_FR");?>
        <small class="text-muted"><?= strftime("%A %d %B %Y", strtotime($data['date'])) ?></small>
        <p class="mt-1">
            <?= htmlspecialchars(getExcerpt($data['content'])) ?>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>