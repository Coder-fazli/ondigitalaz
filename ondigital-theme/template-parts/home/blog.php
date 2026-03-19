<?php
/**
 * Home - Blog / Journal Section (digital-agency demo style)
 *
 * @package OnDigital
 */

$blog_title = ondigital_get_option( 'blog_title', 'Journal' );

$blog_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'lang'           => '',
) );

// Fallback static posts
$static_blogs = array(
    array(
        'title' => __( 'A simple guide to retrieval auto generated read content models', 'ondigital' ),
        'tag'   => __( 'Branding', 'ondigital' ),
        'date'  => '14 Jan 2024',
        'image' => 'img-s-6.webp',
    ),
    array(
        'title' => __( 'The complex but awesome CSS border-image property for web design', 'ondigital' ),
        'tag'   => __( 'Design', 'ondigital' ),
        'date'  => '10 Jan 2024',
        'image' => 'img-s-7.webp',
    ),
    array(
        'title' => __( 'Refining your mobile onboarding experience using visual analytics', 'ondigital' ),
        'tag'   => __( 'Development', 'ondigital' ),
        'date'  => '5 Jan 2024',
        'image' => 'img-s-6.webp',
    ),
);

$delays = array( '0.15', '0.30', '0.45' );
?>
<section class="blog-area">
    <div class="container">
        <div class="blog-area-inner section-spacing">

            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_fade_anim">
                            <?php echo wp_kses_post( $blog_title ); ?>
                        </h2>
                    </div>
                </div>
                <div class="btn-wrapper has_fade_anim" data-delay="0.30" data-fade-from="right">
                    <a href="<?php echo esc_url( home_url( '/bloq/' ) ); ?>" class="wc-btn wc-btn-underline btn-text-flip">
                        <span data-text="<?php esc_attr_e( 'Bütün məqalələr', 'ondigital' ); ?>"><?php esc_html_e( 'Bütün məqalələr', 'ondigital' ); ?></span>
                    </a>
                </div>
            </div>

            <div class="blog-wrapper-box">
                <div class="blog-wrapper">
                    <?php if ( $blog_query->have_posts() ) : ?>
                        <?php $i = 0; while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                            <div class="has_fade_anim" data-fade-from="bottom" data-delay="<?php echo esc_attr( $delays[ $i ] ?? '0.15' ); ?>">
                                <a href="<?php the_permalink(); ?>">
                                    <article class="blog">
                                        <div class="thumb">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <?php the_post_thumbnail( 'ondigital-blog-card' ); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content-wrapper">
                                            <div class="content">
                                                <h2 class="title"><?php the_title(); ?></h2>
                                                <div class="meta">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories ) ) :
                                                    ?>
                                                        <span class="tag"><?php echo esc_html( $categories[0]->name ); ?></span>
                                                    <?php endif; ?>
                                                    <span class="date has-left-line"><?php echo get_the_date(); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </a>
                            </div>
                        <?php $i++; endwhile; wp_reset_postdata(); ?>
                    <?php else : ?>
                        <?php foreach ( $static_blogs as $i => $blog ) : ?>
                            <div class="has_fade_anim" data-fade-from="bottom" data-delay="<?php echo esc_attr( $delays[ $i ] ); ?>">
                                <a href="#">
                                    <article class="blog">
                                        <div class="thumb">
                                            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/' . $blog['image'] ); ?>" alt="<?php echo esc_attr( $blog['title'] ); ?>">
                                        </div>
                                        <div class="content-wrapper">
                                            <div class="content">
                                                <h2 class="title"><?php echo esc_html( $blog['title'] ); ?></h2>
                                                <div class="meta">
                                                    <span class="tag"><?php echo esc_html( $blog['tag'] ); ?></span>
                                                    <span class="date has-left-line"><?php echo esc_html( $blog['date'] ); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
