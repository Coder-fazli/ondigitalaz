<?php
/**
 * Single Project template.
 *
 * @package OnDigital
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <section class="work-details-area">
        <div class="hero-area">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="area-bg">
                    <?php the_post_thumbnail( 'ondigital-hero' ); ?>
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="hero-area-inner">
                    <div class="section-content">
                        <div class="section-title-wrapper">
                            <div class="title-wrapper">
                                <h1 class="section-title has_fade_anim"><?php the_title(); ?></h1>
                            </div>
                        </div>
                        <ul class="work-meta has_fade_anim" data-on-scroll="0">
                            <li>
                                <span class="title"><?php esc_html_e( 'Tarix', 'ondigital' ); ?></span>
                                <span class="text"><?php echo esc_html( get_the_date() ); ?></span>
                            </li>
                            <?php
                            $client = get_post_meta( get_the_ID(), '_project_client', true );
                            if ( $client ) :
                            ?>
                            <li>
                                <span class="title"><?php esc_html_e( 'Müştəri', 'ondigital' ); ?></span>
                                <span class="text"><?php echo esc_html( $client ); ?></span>
                            </li>
                            <?php endif; ?>
                            <?php
                            $project_url = get_post_meta( get_the_ID(), '_project_url', true );
                            if ( $project_url ) :
                            ?>
                            <li>
                                <a href="<?php echo esc_url( $project_url ); ?>" class="wc-btn wc-btn-normal btn-text-flip" target="_blank" rel="noopener noreferrer">
                                    <span data-text="<?php esc_attr_e( '( Saytı gör )', 'ondigital' ); ?>"><?php esc_html_e( '( Saytı gör )', 'ondigital' ); ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="problem-area">
        <div class="container">
            <div class="problem-area-inner section-spacing">
                <div class="section-content">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <div class="text-wrapper has_fade_anim">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $gallery = get_post_meta( get_the_ID(), '_project_gallery', true );
    if ( ! empty( $gallery ) ) :
    ?>
    <div class="gallery-area">
        <div class="container">
            <div class="gallery-area-inner section-spacing-top">
                <div class="gallery-wrapper-box">
                    <div class="gallery-wrapper">
                        <?php foreach ( (array) $gallery as $image_id ) : ?>
                            <div class="thumb has_fade_anim">
                                <?php echo wp_get_attachment_image( $image_id, 'large' ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="btn-area has_fade_anim">
        <div class="container">
            <div class="btn-area-inner section-spacing-bottom">
                <div class="btn-wrapper">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    <?php if ( $prev_post ) : ?>
                        <a class="wc-btn wc-btn-primary btn-text-flip bordered" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                            <span data-text="<?php esc_attr_e( 'Əvvəlki', 'ondigital' ); ?>"><?php esc_html_e( 'Əvvəlki', 'ondigital' ); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if ( $next_post ) : ?>
                        <a class="wc-btn wc-btn-primary btn-text-flip bordered" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                            <span data-text="<?php esc_attr_e( 'Növbəti', 'ondigital' ); ?>"><?php esc_html_e( 'Növbəti', 'ondigital' ); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part( 'template-parts/shared/cta' ); ?>

<?php endwhile; ?>

<?php get_footer();
