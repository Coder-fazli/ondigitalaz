<?php
/**
 * Blog - Featured Posts Section
 * Matches Arolax blog.html .featured-post-area structure exactly.
 * First post spans 2 cols × 2 rows; items 2 & 3 stack on the right.
 *
 * @package OnDigital
 */

$_pll_lang = function_exists( 'pll_current_language' ) ? pll_current_language() : '';

$featured_query = new WP_Query( array_filter( array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'lang'           => $_pll_lang ?: null,
    'meta_query'     => array(
        array(
            'key'     => '_is_featured',
            'value'   => '1',
            'compare' => '=',
        ),
    ),
) ) );

// Fallback: latest 3 posts if none are marked featured
if ( ! $featured_query->have_posts() ) {
    $featured_query = new WP_Query( array_filter( array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'lang'           => $_pll_lang ?: null,
    ) ) );
}

$_blog_featured_tag = ondigital_get_option( 'blog_featured_tag', 'Seçilmiş Məqalə' );
$static_featured = array(
    array(
        'title' => __( 'Sənaye Liderlərindən Anlayışlar', 'ondigital' ),
        'tag'   => $_blog_featured_tag,
        'date'  => 'Mar - 2024',
        'image' => 'img-s-17.webp',
    ),
    array(
        'title' => __( 'Keyfiyyət Qurmaq', 'ondigital' ),
        'tag'   => $_blog_featured_tag,
        'date'  => 'Feb - 2024',
        'image' => 'img-s-18.webp',
    ),
    array(
        'title' => __( 'Bazar Araşdırması', 'ondigital' ),
        'tag'   => $_blog_featured_tag,
        'date'  => 'Jan - 2024',
        'image' => 'img-s-19.webp',
    ),
);

// Arolax delays: item 1 = none, item 2 = 0.30, item 3 = 0.45 + data-on-scroll=0
$delays     = array( '', '0.30', '0.45' );
$on_scrolls = array( '', '', '0' );
?>
<div class="featured-post-area">
    <div class="container">
        <div class="featured-post-box">
            <div class="featured-posts">

                <?php if ( $featured_query->have_posts() ) : ?>
                    <?php $idx = 0; while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
                        <article class="blog-box has_fade_anim"
                            <?php if ( $delays[ $idx ] ) echo 'data-delay="' . esc_attr( $delays[ $idx ] ) . '"'; ?>
                            <?php if ( $on_scrolls[ $idx ] !== '' ) echo ' data-on-scroll="' . esc_attr( $on_scrolls[ $idx ] ) . '"'; ?>>
                            <a href="<?php the_permalink(); ?>">
                                <div class="thumb">
                                    <?php
                                    $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' )
                                        ?: get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                    ?>
                                    <?php if ( $thumb_url ) : ?>
                                        <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/img-s-' . ( 17 + $idx ) . '.webp' ); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="content">
                                    <div class="content-first">
                                        <h2 class="title"><?php the_title(); ?></h2>
                                        <span class="tag">
                                            <?php
                                            $cats = get_the_category();
                                            echo ! empty( $cats ) ? esc_html( $cats[0]->name ) : esc_html( $_blog_featured_tag );
                                            ?>
                                            <br><?php echo esc_html( get_the_date( 'M - Y' ) ); ?>
                                        </span>
                                    </div>
                                    <div class="icon"><i class="fa-solid fa-arrow-right"></i></div>
                                </div>
                            </a>
                        </article>
                    <?php $idx++; endwhile; wp_reset_postdata(); ?>

                <?php else : ?>
                    <?php foreach ( $static_featured as $i => $item ) : ?>
                        <article class="blog-box has_fade_anim"
                            <?php if ( $delays[ $i ] ) echo 'data-delay="' . esc_attr( $delays[ $i ] ) . '"'; ?>
                            <?php if ( $on_scrolls[ $i ] !== '' ) echo ' data-on-scroll="' . esc_attr( $on_scrolls[ $i ] ) . '"'; ?>>
                            <a href="#">
                                <div class="thumb">
                                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/' . $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
                                </div>
                                <div class="content">
                                    <div class="content-first">
                                        <h2 class="title"><?php echo esc_html( $item['title'] ); ?></h2>
                                        <span class="tag"><?php echo esc_html( $item['tag'] ); ?><br><?php echo esc_html( $item['date'] ); ?></span>
                                    </div>
                                    <div class="icon"><i class="fa-solid fa-arrow-right"></i></div>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
