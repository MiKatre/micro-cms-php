<?php $title="Tableau de bord" ?>

<?php ob_start() ?>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Tableau de bord</a>
  <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="index.php?action=logout">
        Déconnexion
      </a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Tableau de bord <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Articles
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="message-square"></span>
              Commentaires
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tableau de bord</h1>
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

            <tr>
              <td>1</td>
              <td>Introduction</td>
              <td>Brouillon</td>
              <td>Lundi 02 juillet 2018</td>
              <td>
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-success">Publier</button>
                <button class="btn btn-sm btn-outline-secondary">Modifier</button>
                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
              </div>
              </td>
            </tr>
            <?php 
              foreach($posts as $post) { 
              if($comment->flagged()) {
            ?>
              <tr>
              <td><?= $comment->id() ?></td>
              <td><?= $comment->title() ?></td>
              <td><?= $comment->state() ?></td>
              <td><?= $comment->date() ?></td>

              <td>
              <div class="btn-group mr-2">
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=1" class="btn btn-sm btn-outline-success">
                  Autoriser
                </a>
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=2" class="btn btn-sm btn-outline-danger">
                  Modérer
                </a>
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
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=1" class="btn btn-sm btn-outline-success">
                  Autoriser
                </a>
                <a href="index.php?action=updateComment&amp;commentId=<?= $comment->id() ?>&amp;status=2" class="btn btn-sm btn-outline-danger">
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

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<!-- <script>
  var ctx = document.getElementById("myChart");
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
      datasets: [{
        data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false,
      }
    }
  });
</script> -->
<!-- <script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Fevrier", "Mars", "Avril", "Mail", "Juin", "Juillet"],
        datasets: [{
            label: '# Commentaires au cours des 6 derniers mois',
            data: [0, 0, 0, 0, 2, 7],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script> -->

<?php $content = ob_get_clean(); ?>

<?php require('template.php') ?>
