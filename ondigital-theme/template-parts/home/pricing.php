<?php
/**
 * Home - Pricing Section
 *
 * @package OnDigital
 */

$default_faq = array(
    array( 'question' => __( 'Search Engine Optimization (SEO)', 'ondigital' ), 'answer' => __( 'Each social media platform releases its information, making it easier to platforms', 'ondigital' ), 'open' => 0 ),
    array( 'question' => __( 'Reach the right audience in marketing', 'ondigital' ), 'answer' => __( 'Each social media platform releases its information, making it easier to platforms', 'ondigital' ), 'open' => 1 ),
    array( 'question' => __( '3 social media advertising', 'ondigital' ), 'answer' => __( 'Each social media platform releases its information, making it easier to platforms', 'ondigital' ), 'open' => 0 ),
);

$default_pricing = array(
    array( 'name' => __( 'Basic', 'ondigital' ),    'price' => '$9.00',  'features' => "Unlimited cards\nAutomated management\nSOX compliance", 'cta_url' => '' ),
    array( 'name' => __( 'Standard', 'ondigital' ), 'price' => '$29.00', 'features' => "Unlimited cards\nAutomated management\nSOX compliance\nEnterprise ERP integrations\nLimited tools", 'cta_url' => '' ),
    array( 'name' => __( 'Premium', 'ondigital' ),  'price' => '$69.00', 'features' => "Unlimited cards\nAutomated management\nSOX compliance\nEnterprise ERP integrations\nUnlimited tools\nLocal video issuance", 'cta_url' => '' ),
);

$faq_items     = ondigital_get_repeater( 'faq', $default_faq );
$pricing_plans = ondigital_get_repeater( 'pricing', $default_pricing );

$delays = array( '0.15', '0.30', '0.45' );
?>
<section class="pricing-area">
    <div class="container">
        <div class="pricing-area-inner section-spacing">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim">
                            <?php echo wp_kses_post( __( 'Create reaching target to desired audiences in flexible <span>pricing</span> for better result', 'ondigital' ) ); ?>
                        </h2>
                    </div>
                </div>
                <div class="accordion-wrapper has_fade_anim" data-fade-from="left">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <?php foreach ( $faq_items as $i => $faq ) :
                            $index = $i + 1;
                            $collapsed = empty( $faq['open'] ) ? 'collapsed' : '';
                            $show = ! empty( $faq['open'] ) ? 'show' : '';
                        ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading<?php echo esc_attr( $index ); ?>">
                                    <button class="accordion-button <?php echo esc_attr( $collapsed ); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo esc_attr( $index ); ?>" aria-expanded="<?php echo empty( $faq['open'] ) ? 'false' : 'true'; ?>" aria-controls="flush-collapse<?php echo esc_attr( $index ); ?>">
                                        <?php echo esc_html( $faq['question'] ); ?>
                                    </button>
                                </h2>
                                <div id="flush-collapse<?php echo esc_attr( $index ); ?>" class="accordion-collapse collapse <?php echo esc_attr( $show ); ?>" aria-labelledby="flush-heading<?php echo esc_attr( $index ); ?>" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body"><?php echo esc_html( $faq['answer'] ); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="pricing-wrapper-box">
                <div class="pricing-wrapper">
                    <?php foreach ( $pricing_plans as $pi => $plan ) :
                        $features_text = $plan['features'] ?? '';
                        $features_list = array_filter( array_map( 'trim', explode( "\n", $features_text ) ) );
                        $plan_cta_url  = ! empty( $plan['cta_url'] ) ? $plan['cta_url'] : home_url( '/elaqe/' );
                    ?>
                        <div class="pricing-box has_fade_anim" data-delay="<?php echo esc_attr( $delays[ $pi % 3 ] ); ?>">
                            <span class="tag"><?php echo esc_html( $plan['name'] ?? '' ); ?></span>
                            <h3 class="price"><?php echo esc_html( $plan['price'] ?? '' ); ?></h3>
                            <div class="feature-list">
                                <ul>
                                    <?php foreach ( $features_list as $feature ) : ?>
                                        <li>
                                            <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/check-2.webp' ); ?>" alt="<?php esc_attr_e( 'check', 'ondigital' ); ?>">
                                            <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/check-2-light.webp' ); ?>" alt="<?php esc_attr_e( 'check', 'ondigital' ); ?>">
                                            <?php echo esc_html( $feature ); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <a href="<?php echo esc_url( $plan_cta_url ); ?>" class="wc-btn wc-btn-primary btn-text-flip">
                                <span data-text="<?php esc_attr_e( 'Choose plan', 'ondigital' ); ?>"><?php esc_html_e( 'Choose plan', 'ondigital' ); ?></span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Full-width parallax image -->
<div class="container large overflow-hidden">
    <div class="image-wrapper">
        <img class="w-100" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-44.webp' ); ?>" data-speed="0.7" alt="<?php esc_attr_e( 'Gallery image', 'ondigital' ); ?>">
    </div>
</div>
