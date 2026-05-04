<?php
/**
 * Blog - Featured Posts Section
 *
 * @package OnDigital
 */

$featured_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => array(
        array(
            'key'     => '_is_featured',
            'value'   => '1',
            'compare' => '=',
        ),
    ),
) );

// Fallback to latest 3 posts if no featured posts
if ( ! $featured_query->have_posts() ) {
    $featured_query = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
}

$static_featured = array(
    array(
        'title' => __( 'Sənaye Liderlərindən Anlayışlar', 'ondigital' ),
        'tag'   => __( 'Seçilmiş Məqalə', 'ondigital' ),
        'date'  => 'Mar - 2024',
        'image' => 'img-s-17.webp',
    ),
    array(
        'title' => __( 'Keyfiyyət Qurmaq', 'ondigital' ),
        'tag'   => __( 'Seçilmiş Məqalə', 'ondigital' ),
        'date'  => 'Feb - 2024',
        'image' => 'img-s-18.webp',
    ),
    array(
        'title' => __( 'Bazar Araşdırması', 'ondigital' ),
        'tag'   => __( 'Seçilmiş Məqalə', 'ondigital' ),
        'date'  => 'Jan - 2024',
        'image' => 'img-s-19.webp',
    ),
);
?>
<div class="featured-post-area">
    <div class="container">
        <div class="featured-post-box">
            <div class="featured-posts">
                <?php if ( $featured_query->have_posts() ) : ?>
                    <?php $i = 0; while ( $featured_query->have_posts() ) : $featured_query->the_post(); $delay = $i * 0.30; ?>
                        <article class="blog-box has_fade_anim" <?php echo $i > 0 ? 'data-delay="' . esc_attr( $delay ) . '"' : ''; ?>>
                            <a href="<?php the_permalink(); ?>">
                                <div class="thumb">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'ondigital-blog-featured' ); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="content">
                                    <div class="content-first">
                                        <h2 class="title"><?php the_title(); ?></h2>
                                        <span class="tag">
                                            <?php
                                            $categories = get_the_category();
                                            echo ! empty( $categories ) ? esc_html( $categories[0]->name ) : '';
                                            ?>
                                            <br>
                                            <?php echo esc_html( get_the_date( 'M - Y' ) ); ?>
                                        </span>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php $i++; endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php foreach ( $static_featured as $i => $post_item ) : ?>
                        <article class="blog-box has_fade_anim" <?php echo $i > 0 ? 'data-delay="' . esc_attr( $i * 0.30 ) . '"' : ''; ?>>
                            <a href="#">
                                <div class="thumb">
                                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/' . $post_item['image'] ); ?>" alt="<?php echo esc_attr( $post_item['title'] ); ?>">
                                </div>
                                <div class="content">
                                    <div class="content-first">
                                        <h2 class="title"><?php echo esc_html( $post_item['title'] ); ?></h2>
                                        <span class="tag"><?php echo esc_html( $post_item['tag'] ); ?> <br>
                                            <?php echo esc_html( $post_item['date'] ); ?></span>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
