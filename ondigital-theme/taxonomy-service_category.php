<?php
/**
 * Taxonomy Archive: service_category
 * Redirects to the first service post in this category so it uses
 * the single-service.php template directly.
 *
 * @package OnDigital
 */

$term = get_queried_object();
$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';

$service_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => 1,
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

if ( $service_query->have_posts() ) {
    $service_query->the_post();
    wp_redirect( get_permalink(), 301 );
    exit;
}

// Fallback — no services in this category
get_header();
?>
<section style="min-height:60vh; display:flex; align-items:center; justify-content:center; text-align:center;">
    <div>
        <p style="font-size:18px; color:rgba(0,0,0,.5); margin-bottom:24px;">
            <?php esc_html_e( 'Bu kateqoriyada xidmət tapılmadı.', 'ondigital' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
            <span data-text="<?php esc_attr_e( 'Bütün xidmətlər', 'ondigital' ); ?>">
                <?php esc_html_e( 'Bütün xidmətlər', 'ondigital' ); ?>
            </span>
        </a>
    </div>
</section>
<?php get_footer(); ?>
