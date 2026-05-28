<?php
/**
 * Blog - Hero / Featured Area
 * Matches Arolax blog.html .featured-area structure exactly.
 *
 * @package OnDigital
 */

$total_posts    = wp_count_posts();
$published      = (int) $total_posts->publish;
$author_count   = count( get_users( array( 'role__in' => array( 'author', 'editor', 'administrator' ) ) ) );
$blog_title     = ondigital_get_option( 'blog_hero_title',   'Həmişə düşünürük' );
$blog_desc      = ondigital_get_option( 'blog_hero_desc',    'Rəqəmsal marketinq, dizayn və texnologiya haqqında ən son məqalələr' );
$blog_counter1  = ondigital_get_option( 'blog_counter1_label', 'Ümumi məqalə' );
$blog_counter2  = ondigital_get_option( 'blog_counter2_label', 'Blog yazarı' );
?>
<section class="featured-area">
    <div class="container">
        <div class="featured-area-inner">
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h1 class="section-title large has_fade_anim"><?php echo esc_html( $blog_title ); ?></h1>
                    </div>
                </div>
                <div class="text-box">
                    <div class="text-wrapper">
                        <p class="text has_fade_anim"><?php echo esc_html( $blog_desc ); ?></p>
                    </div>
                    <div class="counter-box has_fade_anim">
                        <div class="counter-item">
                            <span class="number wc-counter"><?php echo esc_html( $published ); ?> +</span>
                            <p class="text"><?php echo esc_html( $blog_counter1 ); ?></p>
                        </div>
                        <div class="counter-item">
                            <span class="number wc-counter"><?php echo esc_html( $author_count ); ?> +</span>
                            <p class="text"><?php echo esc_html( $blog_counter2 ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
