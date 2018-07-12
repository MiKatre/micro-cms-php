<div class="d-flex justify-content-center mt-3">
  <?= $paginationInfo ?>
</div>
<div class="d-flex justify-content-center">
  <nav class="my-4 pt-2">
    <ul class="pagination mb-0">
      <?php if($currentPage > 1) { ?>
        <li class="page-item">
            <a class="page-link" aria-label="Previous" href="<?= $url ?>&page=1" title="First page">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Précédent</span>
        </a>
        </li>
        <li class="page-item">
            <a class="page-link" aria-label="Previous" href="<?= $url ?>&page= <?= ($currentPage - 1)  ?>" title="Previous page">
            <span aria-hidden="true">&lsaquo;</span>
            <span class="sr-only">Précédent</span>
        </a>
        </li>
      <?php } else { ?>
        <li class="page-item disabled">
            <a class="page-link" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Précédent</span>
        </a>
        </li>
        <li class="page-item disabled">
            <a class="page-link" aria-label="Previous">
            <span aria-hidden="true">&lsaquo;</span>
            <span class="sr-only">Précédent</span>
        </a>
        </li>
      <?php } ?>

      <!-- Pagination -->
      
      <?php 
        if( ($totalPages <= 5) || ($currentPage < 5) ) { 
          for($i = 1; $i <= 5; $i++) {
            $class = ($i == $currentPage) ? 'page-item active' : 'page-item' ; 
            if ( $i <= $totalPages ) {
      ?>
        <li class="<?= $class ?>">
          <a class="page-link" href="<?= $url ?>&page= <?= $i  ?>"> 
            <?= $i ?> 
          </a>
        </li>
      <?php }}} elseif(($totalPages - $currentPage) <= 5) {?>
        <?php for ($i = ($totalPages - 5); $i <= $totalPages; $i++) { ?>
          <?php $class = ($i == $currentPage) ? 'page-item active' : 'page-item' ;  ?>
          <li class="<?= $class ?>">
            <a class="page-link" href="<?= $url ?>&page= <?= $i  ?>"> 
              <?= $i ?> 
            </a>
          </li>
        <?php } ?>
      <?php } else { ?>
        <?php for ($i = ($currentPage - 2); $i <= ($currentPage + 2); $i++) { ?>
          <?php $class = ($i == $currentPage) ? 'page-item active' : 'page-item';  ?>
          <li class="<?= $class ?>">
            <a class="page-link" href="<?= $url ?>&page= <?= $i  ?>"> 
              <?= $i ?> 
            </a>
          </li>
        <?php } ?>
      <?php } ?>

      <?php if($currentPage < $totalPages) { ?>
        <li class="page-item">
            <a class="page-link" aria-label="Next" href="<?= $url ?>&page= <?= ($currentPage + 1) ?>" title="Next page">
            <span aria-hidden="true">&rsaquo;</span>
            <span class="sr-only">Suivant</span>
        </a>
        </li>
        <li class="page-item">
            <a class="page-link" aria-label="Previous" href="<?= $url ?>&page= <?= $totalPages ?>" title="Last page">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Suivant</span>
        </a>
        </li>
      <?php } else { ?> 
        <li class="page-item disabled">
            <a class="page-link" aria-label="Previous">
            <span aria-hidden="true">&rsaquo;</span>
            <span class="sr-only">Suivant</span>
        </a>
        </li>
        <li class="page-item disabled">
            <a class="page-link" aria-label="Previous">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Suivant</span>
        </a>
        </li>
      <?php } ?>

    </ul>
  </nav>
</div>