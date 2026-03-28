<?php
/**
 * Single Glossary Term — content template part.
 *
 * @package OnDigital
 */

if ( ! have_posts() ) {
    return;
}

while ( have_posts() ) : the_post();

$terms       = get_the_terms( get_the_ID(), 'glossary_cat' );
$cat         = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0] : null;
$archive_url = get_post_type_archive_link( 'od_glossary' );

// Related terms: same category, exclude current
$related_args = array(
    'post_type'      => 'od_glossary',
    'posts_per_page' => 3,
    'post__not_in'   => array( get_the_ID() ),
    'orderby'        => 'rand',
);
if ( $cat ) {
    $related_args['tax_query'] = array(
        array(
            'taxonomy' => 'glossary_cat',
            'field'    => 'term_id',
            'terms'    => $cat->term_id,
        ),
    );
}
$related = new WP_Query( $related_args );
?>

<!-- ======================== BREADCRUMB ======================== -->
<div class="glossary-single-breadcrumb">
    <div class="container">
        <nav class="glossary-breadcrumb" aria-label="breadcrumb">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="glossary-breadcrumb__link">
                <?php esc_html_e( 'Ana Səhifə', 'ondigital' ); ?>
            </a>
            <i class="fa-solid fa-chevron-right glossary-breadcrumb__sep"></i>
            <a href="<?php echo esc_url( $archive_url ); ?>" class="glossary-breadcrumb__link">
                <?php esc_html_e( 'Sözlük', 'ondigital' ); ?>
            </a>
            <i class="fa-solid fa-chevron-right glossary-breadcrumb__sep"></i>
            <?php if ( $cat ) : ?>
            <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="glossary-breadcrumb__link">
                <?php echo esc_html( $cat->name ); ?>
            </a>
            <i class="fa-solid fa-chevron-right glossary-breadcrumb__sep"></i>
            <?php endif; ?>
            <span class="glossary-breadcrumb__current"><?php the_title(); ?></span>
        </nav>
    </div>
</div>

<!-- ======================== SINGLE HERO ======================== -->
<section class="glossary-single-hero">
    <div class="glossary-hero__glow glossary-hero__glow--tl"></div>
    <div class="container">
        <div class="glossary-single-hero__inner">
            <?php if ( $cat ) : ?>
            <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="glossary-single-hero__cat">
                <?php echo esc_html( $cat->name ); ?>
            </a>
            <?php endif; ?>
            <h1 class="glossary-single-hero__title"><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
            <p class="glossary-single-hero__excerpt"><?php the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ======================== CONTENT ======================== -->
<section class="glossary-single-content-section">
    <div class="container">
        <div class="glossary-single-layout">

            <!-- Main content -->
            <div class="glossary-single-content">
                <div class="glossary-single-body">
                    <?php the_content(); ?>
                </div>

                <!-- Back link -->
                <div class="glossary-single-back">
                    <a href="<?php echo esc_url( $archive_url ); ?>" class="glossary-single-back__link">
                        <i class="fa-solid fa-arrow-left"></i>
                        <?php esc_html_e( 'Sözlüyə qayıt', 'ondigital' ); ?>
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="glossary-single-sidebar">
                <?php if ( $cat ) : ?>
                <div class="glossary-sidebar-card">
                    <h3 class="glossary-sidebar-card__title">
                        <?php esc_html_e( 'Kateqoriya', 'ondigital' ); ?>
                    </h3>
                    <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="glossary-sidebar-card__cat-badge">
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                    <?php if ( $cat->description ) : ?>
                    <p class="glossary-sidebar-card__cat-desc"><?php echo esc_html( $cat->description ); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ( $related->have_posts() ) : ?>
                <div class="glossary-sidebar-card">
                    <h3 class="glossary-sidebar-card__title">
                        <?php esc_html_e( 'Əlaqəli terminlər', 'ondigital' ); ?>
                    </h3>
                    <ul class="glossary-sidebar-related">
                        <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" class="glossary-sidebar-related__link">
                                <i class="fa-solid fa-arrow-right-long"></i>
                                <?php the_title(); ?>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
                <?php endif; ?>
            </aside>

        </div>
    </div>
</section>

<?php endwhile;
