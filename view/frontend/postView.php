<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h3 class="font-weight-bold">Jean Forteroche</h3>
<h6 class="text-muted">Billet simple pour l'Alaska</h6>
<p><a href="index.php">Retour à la liste des articles</a></p>

<div class="news">
    <small class="text-muted">
        <?= strftime("%A %d %B %Y", strtotime($post['date'])) ?>
    </small>
    <h2 >
        <?= htmlspecialchars($post['title']) ?>
    </h2>
    
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2 class="my-5 text-center font-weight-bold">Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
?>
    <p>
        <strong><?= htmlspecialchars($comment['author']) ?></strong> 
        <small> - <?= strftime("%A %d %B %Y", strtotime($comment['date'])) ?> </small>
    </p>
    <p class="font-weight-light"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
<?php
}
?>

<h2 class="my-5 text-center font-weight-bold">Ajouter un commentaire</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="content">Commentaire</label><br />
        <textarea id="content" name="content"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
