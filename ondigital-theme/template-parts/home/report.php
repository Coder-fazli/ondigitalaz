<?php
/**
 * Home - Report/Conversion Section
 *
 * @package OnDigital
 */
?>
<section class="report-area">
    <div class="container">
        <div class="report-area-inner section-spacing-top">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_fade_anim">
                            <?php echo wp_kses_post( __( 'We help you to increase your <span>conversion</span> rate', 'ondigital' ) ); ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="section-content-box has_fade_anim">
                <div class="section-content">
                    <div class="report-graph">
                        <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-43.webp' ); ?>" alt="<?php esc_attr_e( 'Conversion graph', 'ondigital' ); ?>">
                        <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/gallery/img-s-43-light.webp' ); ?>" alt="<?php esc_attr_e( 'Conversion graph', 'ondigital' ); ?>">
                    </div>
                    <div class="satisfaction-box">
                        <h3 class="number wc-counter">98 <span class="icon">%</span></h3>
                        <h3 class="info">
                            <?php echo wp_kses_post( __( 'Customer <span>satisfaction</span> and <br><span>strategical</span> success', 'ondigital' ) ); ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
