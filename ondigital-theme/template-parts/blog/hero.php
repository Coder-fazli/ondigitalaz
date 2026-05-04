<?php
/**
 * Blog - Hero Section (Arolax design: left image + right content)
 *
 * @package OnDigital
 */
?>
<section class="featured-area">
    <div class="container">
        <div class="featured-area-inner">
            <!-- LEFT: Large hero image -->
            <div class="featured-hero-image">
                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/img-s-17.webp' ); ?>" alt="<?php esc_attr_e( 'Blog Hero', 'ondigital' ); ?>" class="has_fade_anim">
            </div>

            <!-- RIGHT: Content + small images -->
            <div class="featured-content-side">
                <div class="section-content">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h1 class="section-title large has_fade_anim"><?php esc_html_e( 'Həmişə düşünürük', 'ondigital' ); ?></h1>
                        </div>
                    </div>
                    <div class="text-box">
                        <div class="text-wrapper">
                            <p class="text has_fade_anim"><?php esc_html_e( 'Rəqəmsal marketinq, dizayn və texnologiya haqqında ən son məqalələr', 'ondigital' ); ?></p>
                        </div>
                        <?php
                        $total_posts = wp_count_posts();
                        $published   = $total_posts->publish;
                        $author_count = count( get_users( array( 'role__in' => array( 'author', 'editor', 'administrator' ) ) ) );
                        ?>
                        <div class="counter-box has_fade_anim">
                            <div class="counter-item">
                                <span class="number wc-counter"><?php echo esc_html( $published ); ?> +</span>
                                <p class="text"><?php esc_html_e( 'Ümumi məqalə', 'ondigital' ); ?></p>
                            </div>
                            <div class="counter-item">
                                <span class="number wc-counter"><?php echo esc_html( $author_count ); ?> +</span>
                                <p class="text"><?php esc_html_e( 'Blog yazarı', 'ondigital' ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Small decorative images -->
                <div class="featured-small-images">
                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/img-s-18.webp' ); ?>" alt="<?php esc_attr_e( 'Design', 'ondigital' ); ?>" class="has_fade_anim" data-delay="0.15">
                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/blog/img-s-19.webp' ); ?>" alt="<?php esc_attr_e( 'Design', 'ondigital' ); ?>" class="has_fade_anim" data-delay="0.30">
                </div>
            </div>
        </div>
    </div>
</section>
