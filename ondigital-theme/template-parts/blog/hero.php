<?php
/**
 * Blog - Hero Section (Arolax exact: title row top, posts row bottom)
 *
 * @package OnDigital
 */

$hero_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

$hero_posts = array();
if ( $hero_query->have_posts() ) {
    while ( $hero_query->have_posts() ) {
        $hero_query->the_post();
        $hero_posts[] = array(
            'title'     => get_the_title(),
            'permalink' => get_permalink(),
            'image'     => get_the_post_thumbnail_url( get_the_ID(), 'large' ),
        );
    }
    wp_reset_postdata();
}
?>
<section class="featured-area">
    <div class="container">
        <div class="featured-area-inner">

            <!-- TOP ROW: Title (left) + Text & Counters (right) -->
            <div class="featured-top-row">
                <div class="featured-title-col">
                    <h1 class="section-title large has_fade_anim"><?php esc_html_e( 'Həmişə düşünürük', 'ondigital' ); ?></h1>
                </div>
                <div class="featured-info-col">
                    <p class="featured-text has_fade_anim"><?php esc_html_e( 'Rəqəmsal marketinq, dizayn və texnologiya haqqında ən son məqalələr', 'ondigital' ); ?></p>
                    <?php
                    $total_posts = wp_count_posts();
                    $published   = $total_posts->publish;
                    $author_count = count( get_users( array( 'role__in' => array( 'author', 'editor', 'administrator' ) ) ) );
                    ?>
                    <div class="counter-box has_fade_anim">
                        <div class="counter-item">
                            <span class="number wc-counter"><?php echo esc_html( $published ); ?> +</span>
                            <p class="text"><?php esc_html_e( 'Ümumi məqalə', 'ondigital' ); ?></p>
                        </div>
                        <div class="counter-item">
                            <span class="number wc-counter"><?php echo esc_html( $author_count ); ?> +</span>
                            <p class="text"><?php esc_html_e( 'Blog yazarı', 'ondigital' ); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOTTOM ROW: Big image (left) + 2 stacked small images (right) -->
            <div class="featured-bottom-row">
                <!-- LEFT: Big featured post -->
                <?php if ( ! empty( $hero_posts[0] ) ) : ?>
                    <a href="<?php echo esc_url( $hero_posts[0]['permalink'] ); ?>" class="featured-hero-image has_fade_anim">
                        <img src="<?php echo esc_url( $hero_posts[0]['image'] ?: ONDIGITAL_URI . '/assets/imgs/blog/img-s-17.webp' ); ?>" alt="<?php echo esc_attr( $hero_posts[0]['title'] ); ?>">
                    </a>
                <?php endif; ?>

                <!-- RIGHT: 2 small stacked posts -->
                <div class="featured-small-stack">
                    <?php for ( $i = 1; $i <= 2; $i++ ) : ?>
                        <?php if ( ! empty( $hero_posts[ $i ] ) ) : ?>
                            <a href="<?php echo esc_url( $hero_posts[ $i ]['permalink'] ); ?>" class="hero-small-card has_fade_anim" data-delay="<?php echo $i === 1 ? '0.15' : '0.30'; ?>">
                                <img src="<?php echo esc_url( $hero_posts[ $i ]['image'] ?: ONDIGITAL_URI . '/assets/imgs/blog/img-s-' . ( 17 + $i ) . '.webp' ); ?>" alt="<?php echo esc_attr( $hero_posts[ $i ]['title'] ); ?>">
                            </a>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>

        </div>
    </div>
</section>
