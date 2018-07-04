<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title = htmlspecialchars($post->title()); ?>

<?php ob_start(); ?>
<h3 class="font-weight-bold">Jean Forteroche</h3>
<h6 class="text-muted">Billet simple pour l'Alaska</h6>
<p><a href="index.php">Retour à la liste des articles</a></p>

<div class="news">
    <small class="text-muted">
        <?= strftime("%A %d %B %Y", strtotime($post->date())) ?>
    </small>
    <h2 >
        <?= htmlspecialchars($post->title()) ?>
    </h2>
    
    <p>
        <?= nl2br(htmlspecialchars($post->content())) ?>
    </p>
</div>

<h2 class="my-5 text-center font-weight-bold">Commentaires</h2>

<?php
foreach($comments as $comment)
{
?>
    <div class="mx-md-4 mb-2 py-3 pl-3 bg-light rounded">
    <p>
        <strong><?= htmlspecialchars($comment->author()) ?></strong> 
        <small> - <?= strftime("%A %d %B %Y", strtotime($comment->date())) ?> </small>
    </p>
    <p class="font-weight-light mb-0"><?= nl2br(htmlspecialchars($comment->content())) ?></p>
    </div>
<?php
}
?>

<h2 class="my-5 text-center font-weight-bold">Ajouter un commentaire</h2>

<form action="index.php?action=addComment&amp;id=<?= $post->id() ?>" method="post" class="m-sm-5 ">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="author">Nom</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Nom">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email">
        </div>
    </div>

    <div class="form-group">
        <label for="content">Commentaire</label><br />
        <textarea id="content" class="form-control" rows="5" name="content"></textarea>
    </div>
    <div class="text-right">
        <input type="submit" class="btn btn-success" />
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
