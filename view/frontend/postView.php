<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title = htmlspecialchars($post->title()); ?>

<?php ob_start(); ?>
<h3 class="font-weight-bold">Jean Forteroche</h3>
<h6 class="text-muted">Billet simple pour l'Alaska</h6>
<p><a href="index.php">Retour à la liste des articles</a></p>

<?php $currentURL = 'index.php?action=post&amp;id=' . $post->id(); ?>

<?php 
    if(isset($_GET['successMessage'])) {
        if (!empty($_GET['successMessage'])) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> Succès </strong>' . $_GET['successMessage'] . '.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
    }
?>

<div class="news">
    <small class="text-muted">
        <?= strftime("%A %d %B %Y", strtotime($post->date())) ?>
    </small>
    <h2 class="font-weight-bold">
        <?= htmlspecialchars($post->title()) ?>
    </h2>
    
 
        <?= htmlspecialchars_decode($post->content()) ?>
   
</div>

<h2 class="my-5 text-center font-weight-bold"> <span> <?= sizeof($comments) ?> </span> Commentaires</h2>

<?php
foreach($comments as $comment){
    if(!$comment->responseId()) {
?>
    <div class="mx-md-4 mb-2 py-3 pl-3 bg-light rounded">
    <p>
        <strong><?= htmlspecialchars($comment->author()) ?></strong> 
        <small> - <?= strftime("%A %d %B %Y", strtotime($comment->date())) ?> </small>
        <a href="<?= $currentURL . '&amp;responseId=' . $comment->id() ?>#addComment">
            <span class="response icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 9V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"/></svg> </span>							
        </a>
        <a href="index.php?action=flagComment&amp;commentId=<?= $comment->id() ?>&amp;postId=<?= $post->id() ?>&amp;status=<?= $comment->status() ?>" method="post" class="m-sm-5 ">
            <span class="flag flag-parent icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14.4 6L14 4H5v17h2v-7h5.6l.4 2h7V6z"/></svg> </span>
        </a>
    </p>
    <p class="font-weight-light mb-0"><?= nl2br(htmlspecialchars($comment->content())) ?></p>
    
    <?php
    foreach($comments as $response) {
        if($response->responseId() == $comment->id()) {
    ?>
        <div class="mx-md-4 my-2 py-3 pl-3 bg-white rounded">
            <p>
                <strong><?= htmlspecialchars($response->author()) ?></strong> 
                <small> - <?= strftime("%A %d %B %Y", strtotime($response->date())) ?> </small>
                <a href="index.php?action=flagComment&amp;commentId=<?= $response->id() ?>&amp;postId=<?= $post->id() ?>&amp;status=<?= $response->status() ?>" method="post" class="m-sm-5 ">
                    <span class="flag flag-child icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14.4 6L14 4H5v17h2v-7h5.6l.4 2h7V6z"/></svg> </span>
                </a>
            </p>
            <p class="font-weight-light mb-0"><?= nl2br(htmlspecialchars($response->content())) ?></p>
        </div>
    <?php
    }}
    ?>
    </div>
<?php
}}
?>

<h2 class="my-5 text-center font-weight-bold" id="addComment">Ajouter un commentaire</h2>

<form action="index.php?action=addComment&amp;id=<?= $post->id() ?>" method="post" class="m-sm-5 ">
    <input type="hidden" name="responseId" id="responseId" value="<?= (isset($_GET['responseId']) ? $_GET['responseId'] : null ) ?>">
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
