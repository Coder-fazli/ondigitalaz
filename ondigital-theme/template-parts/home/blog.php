<?php
/**
 * Home - Blog Section
 *
 * @package OnDigital
 */

$blog_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 2,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

// Fallback static blogs
$static_blogs = array(
    array(
        'title' => __( 'How to bring fold to your startup company with Arolax', 'ondigital' ),
        'tag'   => __( 'Branding', 'ondigital' ),
        'date'  => '14 Jan 2024',
        'image' => 'img-s-6.webp',
    ),
    array(
        'title' => __( 'How to manage a talented and successful design team', 'ondigital' ),
        'tag'   => __( 'Branding', 'ondigital' ),
        'date'  => '14 Jan 2024',
        'image' => 'img-s-7.webp',
    ),
);
?>
<section class="blog-area">
    <div class="container">
        <div class="blog-area-inner section-spacing-top">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <?php
                        $blog_title = ondigital_get_option( 'blog_title', 'Keep up with the latest industry trends, tips with <span>journal</span>' );
                        ?>
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( $blog_title ); ?>
                        </h2>
                    </div>
                </div>
                <div class="btn-wrapper has_fade_anim" data-fade-from="bottom">
                    <a href="<?php echo esc_url( home_url( '/bloq/' ) ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                        <span data-text="<?php esc_attr_e( 'Read all articles', 'ondigital' ); ?>"><?php esc_html_e( 'Read all articles', 'ondigital' ); ?></span>
                    </a>
                </div>
            </div>
            <div class="blogs-wrapper-box">
                <div class="blogs-wrapper">
                    <?php if ( $blog_query->have_posts() ) : ?>
                        <?php $delay = 0.15; while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                            <article class="blog has_fade_anim" data-delay="<?php echo esc_attr( $delay ); ?>">
                                <div class="thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'ondigital-blog-card' ); ?>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="content-wrapper">
                                    <div class="content">
                                        <div class="meta">
                                            <?php
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) :
                                            ?>
                                                <span class="tag"><?php echo esc_html( $categories[0]->name ); ?></span>
                                            <?php endif; ?>
                                            <span class="date has-left-line"><?php echo get_the_date(); ?></span>
                                        </div>
                                        <h2 class="title text-underline">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                    </div>
                                    <div class="btn-wrapper">
                                        <a href="<?php the_permalink(); ?>" class="cf_btn wc-btn-normal">
                                            <?php esc_html_e( 'Read More', 'ondigital' ); ?>
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php $delay += 0.30; endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <?php foreach ( $static_blogs as $i => $blog ) : ?>
                            <article class="blog has_fade_anim" data-delay="<?php echo esc_attr( $i === 0 ? '0.15' : '0.45' ); ?>">
                                <div class="thumb">
                                    <a href="#">
                                        <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/' . $blog['image'] ); ?>" alt="<?php echo esc_attr( $blog['title'] ); ?>">
                                    </a>
                                </div>
                                <div class="content-wrapper">
                                    <div class="content">
                                        <div class="meta">
                                            <span class="tag"><?php echo esc_html( $blog['tag'] ); ?></span>
                                            <span class="date has-left-line"><?php echo esc_html( $blog['date'] ); ?></span>
                                        </div>
                                        <h2 class="title text-underline">
                                            <a href="#"><?php echo esc_html( $blog['title'] ); ?></a>
                                        </h2>
                                    </div>
                                    <div class="btn-wrapper">
                                        <a href="#" class="cf_btn wc-btn-normal">
                                            <?php esc_html_e( 'Read More', 'ondigital' ); ?>
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
