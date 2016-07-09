<?php get_header(); ?>
<div class="col-md-12">
  <div>
    <div class="card">
      <div class="card-block">
        <h1 class="card-title"><?php the_title(); ?></h1>
        <a class="btn btn-primary btn-sm hidden-md-up" href="<?php echo home_url( $path = '/' ); ?>sp-list-2016">小さい画面用のページはこちら</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead>
          <tr>
            <th>学校名</th>
            <th>文化祭名</th>
            <th>開催期間</th>
            <th>一般公開</th>
          </tr>
          </thead>
          <tbody>
          <?php
            $args  = [
              'meta_query' => [
                'start_date' => [
                  'key'     => 'startDate',
                  'value'   => [ '2016/01/01', '2016/12/31' ],
                  'compare' => 'BETWEEN',
                  'type'    => 'DATE'
                ],
                'address'    => [
                  'key'  => 'address',
                  'type' => 'CHAR',
                ]
              ],
              'post_type'  => 'post',
              'order'      => 'ASC',
              'orderby'    => 'address',
              'nopaging'   => true,
            ];
            $posts = query_posts( $args );
            $tmp   = [ ];
            foreach ( $posts as $post ) {
              if ( in_array( get_field( 'schoolName' ), $tmp ) ) {
                continue;
              }
              ?>
              <tr>
                <td><a href="<?php echo get_permalink( $post->ID ); ?>"><?php the_field( 'schoolName' ) ?></a></td>
                <td><?php the_field( 'name' ); ?></td>
                <td><?php
                    if ( !get_field( 'startDate' ) ):
                      echo '';
                    elseif ( get_field( 'startDate' ) and !get_field( 'endDate' ) ):
                      the_field( 'startDate' );
                    elseif ( get_field( 'startDate' ) and get_field( 'endDate' ) ):
                      echo get_field( 'startDate' ) . '&nbsp;~&nbsp;' . get_field( 'endDate' );
                    else:
                      echo '';
                    endif;
                  ?>
                </td>
                <td>
                  <?php
                    if ( have_rows( 'public_open' ) ):
                      while ( have_rows( 'public_open' ) ) : the_row();
                        if ( get_sub_field( 'public_open_day' ) and get_sub_field( 'public_open_start_time' ) and get_sub_field( 'public_open_end_time' ) ):
                          echo '<p>' . get_sub_field( 'public_open_day' ) . '&nbsp;' . get_sub_field( 'public_open_start_time' ) . '&nbsp;~&nbsp;' . get_sub_field( 'public_open_end_time' ) . '</p>';
                        elseif ( get_sub_field( 'public_open_day' ) ):
                          echo '<p>' . get_sub_field( 'public_open_day' ) . '</p>';
                        else:
                        endif;
                      endwhile;
                    elseif ( get_field( 'public_unknown' ) ):
                      echo '<p>不明</p>';
                    elseif ( get_field( 'publicStartDate' ) and get_field( 'publicEndDate' ) ):
                      echo '<p>' . get_field( 'publicStartDate' ) . '&nbsp;~&nbsp;' . get_field( 'publicEndDate' ) . '</p>';
                    elseif ( get_field( 'publicStartDate' ) and !get_field( 'publicEndDate' ) ):
                      echo '<p>' . get_field( 'publicStartDate' ) . '</p>';
                    elseif ( !get_field( 'publicStartDate' ) and !get_field( 'publicEndDate' ) ):
                      echo '<p>なし</p>';
                    else:
                      echo '<p>不明</p>';
                    endif;
                  ?>
                </td>
              </tr>
              <?php
              $tmp[] = get_field( 'schoolName' );
            }
            wp_reset_query();
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
