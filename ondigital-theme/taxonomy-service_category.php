<?php
/**
 * Taxonomy Archive: service_category
 *
 * @package OnDigital
 */

get_header();

$term = get_queried_object();
$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';

$service_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'tax_query'      => array(
        array(
            'taxonomy' => 'service_category',
            'field'    => 'term_id',
            'terms'    => $term->term_id,
        ),
    ),
    'lang' => $lang,
) );
?>

<section class="hero-area">
    <div class="container">
        <div class="hero-area-inner" style="padding-top:160px; padding-bottom:80px;">
            <div class="section-content">
                <h1 class="section-title large has_text_move_anim">
                    <?php echo esc_html( $term->name ); ?>
                </h1>
                <?php if ( $term->description ) : ?>
                <p class="text has_fade_anim" style="margin-top:20px;">
                    <?php echo esc_html( $term->description ); ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php if ( $service_query->have_posts() ) : ?>
<section class="od-sg-section">
    <div class="container">
        <div class="od-sg-grid">
            <?php $delay = 0.1; while ( $service_query->have_posts() ) : $service_query->the_post();
                $icon_id      = get_post_meta( get_the_ID(), '_service_icon', true );
                $icon_url     = $icon_id ? wp_get_attachment_image_url( $icon_id, 'thumbnail' ) : '';
                $features_raw = get_post_meta( get_the_ID(), '_service_features', true );
                $features     = $features_raw ? array_filter( array_map( 'trim', explode( "\n", $features_raw ) ) ) : array();
            ?>
            <div class="od-sg-item has_fade_anim" data-fade-from="bottom" data-delay="<?php echo esc_attr( $delay ); ?>">
                <?php if ( $icon_url ) : ?>
                <div class="od-sg-icon">
                    <img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php the_title_attribute(); ?>" width="48" height="48">
                </div>
                <?php endif; ?>
                <h3 class="od-sg-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php if ( ! empty( $features ) ) : ?>
                <ul class="od-sg-features">
                    <?php foreach ( $features as $f ) : ?>
                    <li><?php echo esc_html( $f ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php elseif ( has_excerpt() ) : ?>
                <p class="od-sg-excerpt"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                <?php endif; ?>
            </div>
            <?php $delay += 0.1; endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php else : ?>
<section style="padding:80px 0; text-align:center;">
    <div class="container">
        <p><?php esc_html_e( 'Bu kateqoriyada xidmət tapılmadı.', 'ondigital' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" style="margin-top:20px; display:inline-block;">
            &larr; <?php esc_html_e( 'Bütün xidmətlər', 'ondigital' ); ?>
        </a>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
