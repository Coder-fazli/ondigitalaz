<?php
/**
 * OnDigital Panel — General Settings Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="od-section active" data-section="general">

    <?php od_card_open( __( 'Logo', 'ondigital' ), 'dashicons-format-image' ); ?>
        <div class="od-field-row">
            <?php od_image( 'logo_light', __( 'Logo (Light)', 'ondigital' ), $options ); ?>
            <?php od_image( 'logo_dark', __( 'Logo (Dark)', 'ondigital' ), $options ); ?>
        </div>
    <?php od_card_close(); ?>

    <?php od_card_open( __( 'Contact Info', 'ondigital' ), 'dashicons-phone' ); ?>
        <?php od_text( 'phone', __( 'Phone', 'ondigital' ), $options ); ?>
        <?php od_text( 'email', __( 'Email', 'ondigital' ), $options ); ?>
        <?php od_text( 'address', __( 'Address', 'ondigital' ), $options ); ?>
    <?php od_card_close(); ?>

    <?php od_card_open( __( 'Social Media', 'ondigital' ), 'dashicons-share' ); ?>
        <div class="od-field-row">
            <?php od_url( 'facebook', 'Facebook', $options ); ?>
            <?php od_url( 'instagram', 'Instagram', $options ); ?>
        </div>
        <div class="od-field-row">
            <?php od_url( 'linkedin', 'LinkedIn', $options ); ?>
            <?php od_url( 'tiktok', 'TikTok', $options ); ?>
        </div>
        <div class="od-field-row">
            <?php od_url( 'youtube', 'YouTube', $options ); ?>
            <?php od_url( 'behance', 'Behance', $options ); ?>
        </div>
    <?php od_card_close(); ?>

</div>
