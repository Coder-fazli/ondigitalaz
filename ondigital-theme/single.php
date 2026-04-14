<?php
/**
 * Single post template.
 *
 * @package OnDigital
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <section class="blog-details-area">
        <div class="container">
            <div class="blog-details-area-inner">
                <div class="section-header">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h1 class="section-title large has_fade_anim"><?php the_title(); ?></h1>
                        </div>
                    </div>
                    <div class="meta-box has_fade_anim">
                        <ul>
                            <li>
                                <span class="number"><?php echo esc_html( get_comments_number() ); ?></span>
                                <p class="text"><?php esc_html_e( 'Şərh', 'ondigital' ); ?></p>
                            </li>
                            <li>
                                <span class="number"><?php echo esc_html( get_the_date( 'd' ) ); ?></span>
                                <p class="text"><?php echo esc_html( get_the_date( 'F' ) ); ?></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="blog-thumb overflow-hidden">
                        <?php the_post_thumbnail( 'ondigital-hero', array(
                            'class'      => 'w-100',
                            'data-speed' => '0.8',
                        ) ); ?>
                    </div>
                <?php endif; ?>
                <div class="blogdetails__wrapper">
                    <div class="blogdetails-contentleft">
                        <ul class="blogdetails-overview dark-overview has_fade_anim" data-fade-from="left">
                            <li>
                                <i class="fa-solid fa-chart-simple"></i>
                                <span><?php esc_html_e( 'Baxış', 'ondigital' ); ?></span>
                            </li>
                            <li>
                                <i class="fa-solid fa-share-nodes"></i>
                                <span><?php esc_html_e( 'Paylaş', 'ondigital' ); ?></span>
                            </li>
                            <?php
                            $social_links = ondigital_get_social_links();
                            foreach ( $social_links as $social ) :
                                if ( ! empty( $social['url'] ) ) :
                            ?>
                                <li><a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noopener noreferrer"><i class="<?php echo esc_attr( $social['icon'] ); ?>"></i></a></li>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </ul>
                    </div>

                    <div class="blogdetails-contentright">
                        <article class="blog-details-fullBody">
                            <div class="text-wrapper">
                                <?php the_content(); ?>
                            </div>
                            <?php
                            $tags = get_the_tags();
                            if ( $tags ) :
                            ?>
                            <div class="tagswrap has_fade_anim">
                                <ul class="tags">
                                    <li><span><?php esc_html_e( 'Teqlər:', 'ondigital' ); ?></span></li>
                                    <?php foreach ( $tags as $tag ) : ?>
                                        <li><a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </article>

                        <?php if ( comments_open() || get_comments_number() ) : ?>
                            <div class="commentform section-spacing-top has_fade_anim">
                                <?php comments_template(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    <?php
    $categories = get_the_category();
    if ( ! empty( $categories ) ) :
        $related_query = new WP_Query( array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post__not_in'   => array( get_the_ID() ),
            'category__in'   => array( $categories[0]->term_id ),
            'orderby'        => 'rand',
        ) );

        if ( $related_query->have_posts() ) :
    ?>
    <section class="blog-area">
        <div class="container">
            <div class="blog-area-inner section-spacing">
                <div class="section-content">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h2 class="section-title has_fade_anim"><?php esc_html_e( 'Əlaqəli məqalələr', 'ondigital' ); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="blogs-wrapper-box">
                    <div class="blogs-wrapper has_fade_anim">
                        <?php $count = 1; while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
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
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        endif;
    endif;
    ?>

<?php endwhile; ?>

<?php get_footer();
