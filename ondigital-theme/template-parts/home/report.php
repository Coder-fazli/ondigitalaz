<?php
/**
 * Home - Report/Conversion Section
 *
 * @package OnDigital
 */

$report_title         = ondigital_get_option( 'report_title', 'We help you to increase your <span>conversion</span> rate' );
$report_graph_light   = ondigital_img( 'report_graph_light', '/assets/imgs/gallery/img-s-43.webp' );
$report_graph_dark    = ondigital_img( 'report_graph_dark', '/assets/imgs/gallery/img-s-43-light.webp' );
$report_counter_num   = ondigital_get_option( 'report_counter_number', '98' );
$report_counter_label = ondigital_get_option( 'report_counter_label', 'Customer <span>satisfaction</span> and <br><span>strategical</span> success' );
?>
<section class="report-area">
    <div class="container">
        <div class="report-area-inner section-spacing-top">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_fade_anim">
                            <?php echo wp_kses_post( $report_title ); ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="section-content-box has_fade_anim">
                <div class="section-content">
                    <div class="report-graph">
                        <img class="show-light" src="<?php echo esc_url( $report_graph_light ); ?>" alt="<?php esc_attr_e( 'Conversion graph', 'ondigital' ); ?>">
                        <img class="show-dark" src="<?php echo esc_url( $report_graph_dark ); ?>" alt="<?php esc_attr_e( 'Conversion graph', 'ondigital' ); ?>">
                    </div>
                    <div class="satisfaction-box">
                        <h3 class="number wc-counter"><?php echo esc_html( $report_counter_num ); ?> <span class="icon">%</span></h3>
                        <h3 class="info">
                            <?php echo wp_kses_post( $report_counter_label ); ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
