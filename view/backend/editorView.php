<?php $title="Éditeur" ?>

<?php ob_start() ?>


<script type="text/javascript">
tinymce.init({
  selector: 'textarea',
  language : 'fr_FR',
  branding: false,
  menubar: false,
  height: 400,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'media table contextmenu paste code help wordcount'
  ],
  toolbar: 'insert | undo redo |  formatselect | bold italic | alignleft aligncenter alignright alignjustify blockquote | bullist numlist outdent indent | removeformat',
});
// tinymce.get('editor').getContent()
</script>

<div class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
  <h1 class="text-center font-weight-bold my-4">Éditeur</h1>

  <?php 
  if(isset($_GET['errorMessage'])) {
      if (!empty($_GET['errorMessage'])) {
          echo '
          <div class="alert alert-danger alert-dismissible fade show text-left" role="alert">
            <h5 class="alert-heading">Erreur</h5>    
            <p>' . $_GET['errorMessage'] . ' </p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>';
      }
  } else if(isset($_GET['successMessage'])) {
    if (!empty($_GET['successMessage'])) {
        echo '
        <div class="alert alert-success alert-dismissible fade show text-left" role="alert">
          <h5 class="alert-heading">Succès !</h5>    
          <p>' . $_GET['successMessage'] . ' </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
} 
?>

  <form method="post" action="index.php?action=updatePost&amp;id=<?= $post->id() ?>">
    <label for="title" class="h5">Titre</label>
    <input type="text" name="title" id="title" class="form-control mb-4" value=<?= $post->title() ?>>
    <label for="editor" class="h5">Article</label>
    <textarea id="editor" name="content">
    <?= $post->content() ?>
    </textarea>
    <div class="btn-group m-2 w-100 justify-content-end">
      <button type="submit" class="btn btn-sm btn-secondary">
        Sauvegarder
      </button>
      <?php if ($post->status() == 0) { ?>
        <a href="index.php?action=updatePost&amp;postId=<?= $post->id() ?>&amp;status=1&amp;return=showEditor" class="btn btn-sm btn-outline-success">
        Publier
        </a>
        <?php } elseif ($post->status() == 1) { ?>
        <a href="index.php?action=updatePost&amp;postId=<?= $post->id() ?>&amp;status=0&amp;return=showEditor" class="btn btn-sm btn-outline-warning">
        Dépublier
        </a>
      <?php } ?>
    </div>
  </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php') ?>