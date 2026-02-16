<?php
/**
 * Archive template.
 *
 * @package OnDigital
 */

get_header(); ?>

<section class="blog-area">
    <div class="container">
        <div class="blog-area-inner section-spacing">
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h1 class="section-title has_fade_anim"><?php the_archive_title(); ?></h1>
                    </div>
                </div>
                <?php if ( get_the_archive_description() ) : ?>
                    <div class="text-wrapper">
                        <p class="text has_fade_anim"><?php echo wp_kses_post( get_the_archive_description() ); ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="blogs-wrapper-box">
                <?php if ( have_posts() ) : ?>
                    <div class="blogs-wrapper has_fade_anim">
                        <?php $count = 1; while ( have_posts() ) : the_post(); ?>
                            <a href="<?php the_permalink(); ?>">
                                <div class="blog-box">
                                    <div class="thumb">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'ondigital-blog-card' ); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="content">
                                        <span class="number"><?php echo esc_html( str_pad( $count, 2, '0', STR_PAD_LEFT ) ); ?></span>
                                        <h3 class="title"><?php the_title(); ?></h3>
                                        <span class="icon"><i class="fa-solid fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                        <?php $count++; endwhile; ?>
                    </div>
                    <div class="pagination-box has_fade_anim">
                        <?php the_posts_pagination( array(
                            'mid_size'  => 2,
                            'type'      => 'list',
                            'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                            'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
                        ) ); ?>
                    </div>
                <?php else : ?>
                    <div class="text-wrapper">
                        <p class="text"><?php esc_html_e( 'Heç bir yazı tapılmadı.', 'ondigital' ); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
