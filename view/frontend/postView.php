<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Jean Forteroche</h1>
<h4 class="text-muted">Billet simple pour l'Alaska</h4>
<p><a href="index.php">Retour à la liste des articles</a></p>

<div class="news">
    <small class="text-muted">
        <?= strftime("%A %d %B %Y", strtotime($post['date'])) ?>
    </small>
    <h3>
        <?= htmlspecialchars($post['title']) ?>
    </h3>
    
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
