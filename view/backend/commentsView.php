<?php setlocale(LC_TIME, "fr_FR");?>
<?php $title="Commentaires" ?>

<?php ob_start() ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
        <h1 class="h2">Commentaires</h1>
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
              if ($comment->status() == 0) {
                $status = 'visible';
                $html = $status;
              } elseif ($comment->status() == 1) {
                $status = 'approuvé';
                $html = '<span class=\'text-success\'>approuvé</span>';
              } else {
                $status = 'modéré';
                $html = '<span class=\'text-danger\'>modéré</span>';
              }
            ?>
              <tr>
              <td><?= $comment->id() ?></td>
              <td><?= $comment->author() ?></td>
              <td><?= $comment->email() ?></td>
              <td><?= $comment->content() ?></td>
              <td><?= $html ?></td>

              <td>
              <div class="btn-group mr-2">
              <?php if ($status == 'modéré') { ?>
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=1" class="btn btn-sm btn-outline-secondary">
                  Approuver
                </a>
              <?php } elseif($status == 'approuvé' ) { ?>
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=2" class="btn btn-sm btn-outline-secondary">
                  Modérer
                </a>
              <?php } else { ?>
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=1" class="btn btn-sm btn-outline-success">
                  Approuver
                </a>
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=2" class="btn btn-sm btn-outline-danger">
                  Modérer
                </a>
              <?php }  ?>
              </div>
              </td>
            </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>

      <?php
      if ($totalPages > 1) {
        include 'partials/pagination.php';
      }
      ?>

    </main>
  </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php') ?>
