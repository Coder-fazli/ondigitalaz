<?php
/**
 * Default page template.
 *
 * @package OnDigital
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <section class="blog-details-area">
        <div class="container">
            <div class="blog-details-area-inner section-spacing">
                <div class="section-header">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h1 class="section-title large has_fade_anim"><?php the_title(); ?></h1>
                        </div>
                    </div>
                </div>
                <div class="blogdetails__wrapper">
                    <div class="blogdetails-contentright w-100">
                        <article class="blog-details-fullBody">
                            <div class="text-wrapper">
                                <?php the_content(); ?>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; ?>

<?php get_footer();
