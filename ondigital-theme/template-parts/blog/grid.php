<?php
/**
 * Blog - Posts Grid Section
 * Matches Arolax blog.html .blog-area structure exactly.
 * Left column: title + description. Right column: 2-col card grid + pagination.
 *
 * @package OnDigital
 */

$paged = max( 1, (int) get_query_var( 'paged' ) ?: (int) get_query_var( 'page' ) ?: 1 );

$blog_query_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
);
if ( function_exists( 'pll_current_language' ) ) {
    $blog_query_args['lang'] = pll_current_language();
}
$blog_query = new WP_Query( $blog_query_args );

$static_blogs = array(
    array( 'title' => __( 'Biznes konsultasiyası', 'ondigital' ),            'image' => 'img-s-20.webp' ),
    array( 'title' => __( 'Bazar araşdırması və strategiya', 'ondigital' ),  'image' => 'img-s-21.webp' ),
    array( 'title' => __( 'Keyfiyyətli davamlılıq qurmaq', 'ondigital' ),   'image' => 'img-s-22.webp' ),
    array( 'title' => __( 'Biznes davamlılıq məsləhətləri', 'ondigital' ),  'image' => 'img-s-23.webp' ),
    array( 'title' => __( 'Sahibkarlıq səyahətləri', 'ondigital' ),         'image' => 'img-s-24.webp' ),
    array( 'title' => __( 'Biznes inkişaf strategiyaları', 'ondigital' ),   'image' => 'img-s-25.webp' ),
);
?>
<section class="blog-area">
    <div class="container">
        <div class="blog-area-inner section-spacing">

            <!-- Left column: section title + description -->
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_fade_anim"><?php esc_html_e( 'Son yazılar', 'ondigital' ); ?></h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim"><?php esc_html_e( 'Rəqəmsal marketinq və texnologiya sahəsindəki yeniliklərdən xəbərdar olun', 'ondigital' ); ?></p>
                </div>
            </div>

            <!-- Right column: blog cards + pagination -->
            <div class="blogs-wrapper-box">
                <div class="blogs-wrapper has_fade_anim">

                    <?php if ( $blog_query->have_posts() ) : ?>
                        <?php $count = 1; while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                            <a href="<?php the_permalink(); ?>">
                                <div class="blog-box">
                                    <div class="thumb">
                                        <?php
                                        $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' )
                                            ?: get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                        ?>
                                        <?php if ( $thumb_url ) : ?>
                                            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
                                        <?php else : ?>
                                            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/img-s-' . ( 19 + $count ) . '.webp' ); ?>" alt="<?php the_title_attribute(); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="content">
                                        <span class="number"><?php echo esc_html( str_pad( $count, 2, '0', STR_PAD_LEFT ) ); ?></span>
                                        <h3 class="title"><?php the_title(); ?></h3>
                                        <span class="icon"><i class="fa-solid fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                        <?php $count++; endwhile; wp_reset_postdata(); ?>

                    <?php else : ?>
                        <?php foreach ( $static_blogs as $i => $blog ) : ?>
                            <a href="#">
                                <div class="blog-box">
                                    <div class="thumb">
                                        <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/' . $blog['image'] ); ?>" alt="<?php echo esc_attr( $blog['title'] ); ?>">
                                    </div>
                                    <div class="content">
                                        <span class="number"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
                                        <h3 class="title"><?php echo esc_html( $blog['title'] ); ?></h3>
                                        <span class="icon"><i class="fa-solid fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>

                <?php if ( $blog_query->max_num_pages > 1 ) : ?>
                    <div class="pagination-box has_fade_anim">
                        <ul class="pagination">
                            <?php for ( $i = 1; $i <= $blog_query->max_num_pages; $i++ ) : ?>
                                <?php
                                $url = ( $i === 1 )
                                    ? get_pagenum_link( 1 )
                                    : get_pagenum_link( $i );
                                $active = ( $i === $paged ) ? ' class="active"' : '';
                                ?>
                                <li><a href="<?php echo esc_url( $url ); ?>"<?php echo $active; ?>><?php echo esc_html( str_pad( $i, 2, '0', STR_PAD_LEFT ) ); ?></a></li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
