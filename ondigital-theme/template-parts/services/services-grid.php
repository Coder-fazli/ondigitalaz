<?php
/**
 * Services - Services Grid Section
 *
 * @package OnDigital
 */

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';

$grid_title = ondigital_get_option( 'services_grid_title', 'Our exclusive <br>services' );
$grid_body  = ondigital_get_option( 'services_grid_body', 'We bet on brands that shift categories and add value to people\'s lives; and on founders who are motivated to shape' );

$cards = get_option( 'ondigital_services_cards', array() );
?>
<section class="od-sg-section">
    <div class="container">

        <div class="od-sg-header">
            <h2 class="od-sg-title has_text_move_anim">
                <?php echo wp_kses_post( $grid_title ); ?>
            </h2>
            <p class="od-sg-desc has_fade_anim" data-fade-from="right" data-delay="0.2">
                <?php echo esc_html( $grid_body ); ?>
            </p>
        </div>

        <?php if ( ! empty( $cards ) ) : ?>
        <div class="od-sg-grid">
            <?php foreach ( $cards as $i => $card ) :
                $icon_id   = absint( $card['icon'] ?? 0 );
                $icon_url  = $icon_id ? wp_get_attachment_image_url( $icon_id, 'thumbnail' ) : '';
                $title     = $lang === 'az' ? ( $card['title_az'] ?? $card['title_en'] ?? '' ) : ( $card['title_en'] ?? '' );
                $card_url  = $lang === 'az' ? ( $card['url_az'] ?? $card['url_en'] ?? '' ) : ( $card['url_en'] ?? $card['url'] ?? '' );
                $items     = $card['items'] ?? array();
                $delay     = 0.1 + ( $i * 0.1 );
            ?>
            <div class="od-sg-item has_fade_anim" data-fade-from="bottom" data-delay="<?php echo esc_attr( $delay ); ?>">
                <?php if ( $icon_url ) : ?>
                <div class="od-sg-icon">
                    <img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" width="48" height="48">
                </div>
                <?php endif; ?>

                <h3 class="od-sg-name">
                    <?php if ( $card_url ) : ?>
                        <a href="<?php echo esc_url( $card_url ); ?>"><?php echo esc_html( $title ); ?></a>
                    <?php else : ?>
                        <?php echo esc_html( $title ); ?>
                    <?php endif; ?>
                </h3>

                <?php if ( ! empty( $items ) ) : ?>
                <ul class="od-sg-features">
                    <?php foreach ( $items as $item ) :
                        $text = $lang === 'az' ? ( $item['text_az'] ?? $item['text_en'] ?? '' ) : ( $item['text_en'] ?? '' );
                        $url  = $item['url'] ?? '';
                        if ( ! $text ) continue;
                    ?>
                    <li>
                        <?php if ( $url ) : ?>
                            <a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a>
                        <?php else : ?>
                            <?php echo esc_html( $text ); ?>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <?php else : ?>
        <!-- Fallback: auto-pull from Service CPT if no cards configured -->
        <?php
        $service_query = new WP_Query( array(
            'post_type'      => 'service',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'lang'           => $lang,
        ) );
        if ( $service_query->have_posts() ) : ?>
        <div class="od-sg-grid">
            <?php $delay = 0.1; while ( $service_query->have_posts() ) : $service_query->the_post();
                $icon_id      = get_post_meta( get_the_ID(), '_service_icon', true );
                $icon_url     = $icon_id ? wp_get_attachment_image_url( $icon_id, 'thumbnail' ) : '';
                $features_raw = get_post_meta( get_the_ID(), '_service_features', true );
                $features     = $features_raw ? array_filter( array_map( 'trim', explode( "\n", $features_raw ) ) ) : array();
            ?>
            <div class="od-sg-item has_fade_anim" data-fade-from="bottom" data-delay="<?php echo esc_attr( $delay ); ?>">
                <?php if ( $icon_url ) : ?>
                <div class="od-sg-icon">
                    <img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php the_title_attribute(); ?>" width="48" height="48">
                </div>
                <?php endif; ?>
                <h3 class="od-sg-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php if ( ! empty( $features ) ) : ?>
                <ul class="od-sg-features">
                    <?php foreach ( $features as $f ) : ?>
                    <li><?php echo esc_html( $f ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php elseif ( has_excerpt() ) : ?>
                <p class="od-sg-excerpt"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                <?php endif; ?>
            </div>
            <?php $delay += 0.1; endwhile; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>

    </div>
</section>
