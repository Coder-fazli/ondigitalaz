<?php
/**
 * Single Service template.
 *
 * @package OnDigital
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <section class="service-details-area">
        <div class="container">
            <div class="thumb-main">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'ondigital-hero', array(
                        'class'           => 'has_fade_anim',
                        'data-delay'      => '0.30',
                        'data-fade-offset' => '0',
                    ) ); ?>
                <?php endif; ?>
                <div class="hero-social">
                    <p class="title"><?php esc_html_e( 'Paylaş', 'ondigital' ); ?></p>
                    <div class="hero-social-links">
                        <?php
                        $social_links = ondigital_get_social_links();
                        foreach ( $social_links as $social ) :
                            if ( ! empty( $social['url'] ) ) :
                        ?>
                            <a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noopener noreferrer">
                                <i class="<?php echo esc_attr( $social['icon'] ); ?>"></i>
                            </a>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
            <div class="section-title-box">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h1 class="section-title has_fade_anim" data-on-scroll="0"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
            <div class="text-wrapper has_fade_anim">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

    <!-- Clients -->
    <?php get_template_part( 'template-parts/about/clients' ); ?>

    <!-- CTA -->
    <?php get_template_part( 'template-parts/shared/cta' ); ?>

<?php endwhile; ?>

<?php get_footer();
