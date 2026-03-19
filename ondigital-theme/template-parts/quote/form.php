<?php
/**
 * Quote Page - Request Form Section
 *
 * @package OnDigital
 */

$phone   = get_theme_mod( 'ondigital_phone', '+994 50 123 45 67' );
$email   = get_theme_mod( 'ondigital_email', 'info@ondigital.az' );
$address = get_theme_mod( 'ondigital_address', 'Bakı, Azərbaycan' );

$services_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'lang'           => '',
) );

$service_options = array();
if ( $services_query->have_posts() ) {
    while ( $services_query->have_posts() ) {
        $services_query->the_post();
        $service_options[] = get_the_title();
    }
    wp_reset_postdata();
}

if ( empty( $service_options ) ) {
    $service_options = array(
        __( 'Veb-sayt Dizaynı', 'ondigital' ),
        __( 'Rəqəmsal Marketinq', 'ondigital' ),
        __( 'SEO Optimallaşdırma', 'ondigital' ),
        __( 'Brendinq', 'ondigital' ),
    );
}
?>
<section class="contact-area">
    <div class="container">
        <div class="contact-area-inner section-spacing">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title large has_fade_anim">
                            <?php esc_html_e( 'Qiymət təklifi alın', 'ondigital' ); ?>
                        </h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim">
                        <?php esc_html_e( 'Layihəniz barədə bizə məlumat verin, biz sizə ən uyğun qiymət təklifini hazırlayaq.', 'ondigital' ); ?>
                    </p>
                </div>
            </div>
            <div class="section-content">
                <div class="info-box has_fade_anim">
                    <div class="text-wrapper">
                        <p class="text"><?php esc_html_e( 'Layihənizi müzakirə etmək üçün bizimlə əlaqə saxlayın!', 'ondigital' ); ?></p>
                    </div>
                    <ul class="contact-list">
                        <li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
                        <li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
                        <li><?php echo esc_html( $address ); ?></li>
                    </ul>
                </div>
                <div class="contact-wrap has_fade_anim" data-delay="0.30">
                    <?php
                    $contact_status = isset( $_GET['contact'] ) ? sanitize_key( $_GET['contact'] ) : '';
                    if ( 'success' === $contact_status ) :
                    ?>
                        <div class="contact-feedback contact-feedback--success">
                            <?php esc_html_e( 'Müraciətiniz qəbul edildi! Tezliklə sizinlə əlaqə saxlayacağıq.', 'ondigital' ); ?>
                        </div>
                    <?php elseif ( 'error' === $contact_status || 'failed' === $contact_status ) : ?>
                        <div class="contact-feedback contact-feedback--error">
                            <?php esc_html_e( 'Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.', 'ondigital' ); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo esc_url( get_permalink() ); ?>" method="post">
                        <?php wp_nonce_field( 'ondigital_quote', 'quote_nonce' ); ?>
                        <div class="contact-formwrap">
                            <div class="contact-formfield">
                                <input type="text" name="quote_name" id="quote_name" placeholder="<?php esc_attr_e( 'Ad*', 'ondigital' ); ?>" required>
                            </div>
                            <div class="contact-formfield">
                                <input type="email" name="quote_email" id="quote_email" placeholder="<?php esc_attr_e( 'Email*', 'ondigital' ); ?>" required>
                            </div>
                            <div class="contact-formfield">
                                <input type="tel" name="quote_phone" id="quote_phone" placeholder="<?php esc_attr_e( 'Telefon*', 'ondigital' ); ?>" required>
                            </div>
                            <div class="contact-formfield">
                                <input type="text" name="quote_company" id="quote_company" placeholder="<?php esc_attr_e( 'Şirkət adı', 'ondigital' ); ?>">
                            </div>
                            <div class="contact-formfield">
                                <select name="quote_service" id="quote_service" required>
                                    <option value=""><?php esc_html_e( 'Xidmət seçin*', 'ondigital' ); ?></option>
                                    <?php foreach ( $service_options as $service ) : ?>
                                        <option value="<?php echo esc_attr( $service ); ?>"><?php echo esc_html( $service ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="contact-formfield">
                                <select name="quote_budget" id="quote_budget">
                                    <option value=""><?php esc_html_e( 'Büdcə aralığı', 'ondigital' ); ?></option>
                                    <option value="500-1000">500 - 1,000 AZN</option>
                                    <option value="1000-3000">1,000 - 3,000 AZN</option>
                                    <option value="3000-5000">3,000 - 5,000 AZN</option>
                                    <option value="5000+">5,000+ AZN</option>
                                </select>
                            </div>
                            <div class="contact-formfield messages">
                                <input type="text" name="quote_message" id="quote_message" placeholder="<?php esc_attr_e( 'Layihə haqqında qısa məlumat*', 'ondigital' ); ?>" required>
                            </div>
                        </div>
                        <div class="submit-btn">
                            <button type="submit" class="wc-btn wc-btn-primary btn-text-flip">
                                <span data-text="<?php esc_attr_e( 'Təklif İstə', 'ondigital' ); ?>"><?php esc_html_e( 'Təklif İstə', 'ondigital' ); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
