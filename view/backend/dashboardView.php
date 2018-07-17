<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title="Tableau de bord" ?>

<?php ob_start() ?>

<?php $url='index.php?action=showDashboard' ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tableau de bord</h1>
        <div class="btn-group mr-2">
          <a href="index.php?action=showEditor&amp;id=0" class="btn btn-sm btn-outline-secondary">
            Nouvel article
          </a>
        </div>
      </div>
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

  

      <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

      <h2> Articles  </h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Status</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php 
              foreach($posts as $post) { 
              if($post->status() != 2) {
                $status = ($post->status() == 0 ? 'Brouillon' : 'Publié' )
            ?>
              <tr>
              <td><?= $post->id() ?></td>
              <td><?= $post->title() ?></td>
              <td><?= $status ?></td>
              <td><?= strftime("%A %d %B %Y", strtotime($post->date())) ?></td>

              <td>
              <div class="btn-group mr-2">
                <?php if ($post->status() == 0) { ?>
                <a href="index.php?action=updatePost&amp;postId=<?= $post->id() ?>&amp;status=1&amp;return=showDashboard" class="btn btn-sm btn-outline-success">
                Publier
                </a>
                <?php } elseif ($post->status() == 1) { ?>
                <a href="index.php?action=updatePost&amp;postId=<?= $post->id() ?>&amp;status=0&amp;return=showDashboard" class="btn btn-sm btn-outline-warning">
                Dépublier
                </a>
                <?php } ?>

                <a 
                href="index.php?action=showEditor&amp;id=<?= $post->id() ?>"
                class="btn btn-sm btn-outline-secondary">
                  Modifier
                </a>

                <?php if ($post->status() == 0) { ?>
                <a href="index.php?action=updatePost&amp;postId=<?= $post->id() ?>&amp;status=2&amp;return=showDashboard" class="btn btn-sm btn-outline-danger">
                Supprimer
                </a>
                <?php } ?>
              </div>
              </td>
            </tr>
            <?php }} ?>

          </tbody>
        </table>
      </div>

      <h2> Commentaires </h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Auteur</th>
              <th>Email</th>
              <th>Contenu</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php 
              foreach($comments as $comment) { 
              if($comment->flagged()) {
            ?>
              <tr>
              <td><?= $comment->id() ?></td>
              <td><?= $comment->author() ?></td>
              <td><?= $comment->email() ?></td>
              <td><?= $comment->content() ?></td>
              <td><?= ($comment->flagged() ? '<span class="red" data-feather="flag"></span>' : '<span data-feather="flag"></span>' ) ?></td>

              <td>
              <div class="btn-group mr-2">
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=1&amp;url=<?= rawurlencode($url) ?>" class="btn btn-sm btn-outline-success">
                  Autoriser
                </a>
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=2&amp;url=<?= rawurlencode($url) ?>" class="btn btn-sm btn-outline-danger">
                  Modérer
                </a>
              </div>
              </td>
            </tr>
            <?php }} ?>

          </tbody>
        </table>
      </div>


    </main>
  </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php') ?>
