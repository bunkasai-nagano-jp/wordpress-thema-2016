<?php
function pagination ($pages = '', $range = 4) {
  $showitems = ($range * 2)+1;
  global $paged;
  if (!$paged):
    $paged = 1;
  endif;
  if ( $pages == '' ):
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if (!$pages):
      $pages = 1;
    endif;
  endif;
  if ( 1 != $pages ): ?>
<div class="row">
  <div class="col-md-12 text-xs-center">
    <ul class="pagination">
<?php if ($paged == 1): ?>
      <li class="page-item disabled"><a class="page-link" href="" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span></a>
      </li>
<?php else: ?>
      <li class="page-item"><a class="page-link" href="<?php echo get_pagenum_link($paged - 1); ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span></a>
      </li>
<?php endif; ?>
<?php for ( $i = 1; $i <= $pages; $i++ ) { ?>
<?php if ( 1 != $pages &&( ! ($i >= $paged+$range+1 OR $i <= $paged-$range-1) OR $pages <= $showitems) ) { ?>
<?php if ($paged == $i): ?>
      <li class="page-item active">
        <a class="page-link" href="#"><?php echo $i; ?> <span class="sr-only">(current)</span></a>
      </li>
<?php elseif ($paged != $i): ?>
      <li class="page-item">
        <a class="page-link" href="<?php echo get_pagenum_link($i); ?>"><?php echo $i; ?></a>
      </li>
<?php endif; ?>
<?php } ?>
<?php } ?>
<?php if ($paged == $pages): ?>
      <li class="page-item disabled">
        <a class="page-link" href="" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
<?php else: ?>
      <li class="page-item">
        <a class="page-link" href="<?php echo get_pagenum_link($paged +1); ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
<?php endif; ?>
    </ul>
  </div>
</div>
<?php endif;
}
