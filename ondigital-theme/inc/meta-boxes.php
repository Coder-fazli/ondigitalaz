<?php
/**
 * OnDigital Meta Boxes for CPTs
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =============================================================================
// Register Meta Boxes
// =============================================================================

add_action( 'add_meta_boxes', 'ondigital_register_meta_boxes' );
function ondigital_register_meta_boxes() {
    // Service: icon image
    add_meta_box(
        'ondigital_service_meta',
        __( 'Service Options', 'ondigital' ),
        'ondigital_service_meta_callback',
        'service',
        'normal',
        'high'
    );

    // Project: client name, external URL, gallery
    add_meta_box(
        'ondigital_project_meta',
        __( 'Project Details', 'ondigital' ),
        'ondigital_project_meta_callback',
        'project',
        'normal',
        'high'
    );

    // Team Member: role, social links
    add_meta_box(
        'ondigital_team_meta',
        __( 'Team Member Details', 'ondigital' ),
        'ondigital_team_meta_callback',
        'team_member',
        'normal',
        'high'
    );
}

// =============================================================================
// Service Meta Box
// =============================================================================

function ondigital_service_meta_callback( $post ) {
    wp_nonce_field( 'ondigital_service_meta', 'ondigital_service_meta_nonce' );
    $icon_id = get_post_meta( $post->ID, '_service_icon', true );
    $icon_url = $icon_id ? wp_get_attachment_image_url( $icon_id, 'thumbnail' ) : '';
    ?>
    <table class="form-table">
        <tr>
            <th><label for="_service_icon"><?php esc_html_e( 'Service Icon Image', 'ondigital' ); ?></label></th>
            <td>
                <input type="hidden" name="_service_icon" id="_service_icon" value="<?php echo esc_attr( $icon_id ); ?>">
                <div id="service-icon-preview" style="margin-bottom:10px;">
                    <?php if ( $icon_url ) : ?>
                        <img src="<?php echo esc_url( $icon_url ); ?>" style="max-width:120px;height:auto;">
                    <?php endif; ?>
                </div>
                <button type="button" class="button ondigital-upload-btn" data-target="#_service_icon" data-preview="#service-icon-preview"><?php esc_html_e( 'Select Image', 'ondigital' ); ?></button>
                <button type="button" class="button ondigital-remove-btn" data-target="#_service_icon" data-preview="#service-icon-preview"><?php esc_html_e( 'Remove', 'ondigital' ); ?></button>
            </td>
        </tr>
    </table>
    <?php
}

// =============================================================================
// Project Meta Box
// =============================================================================

function ondigital_project_meta_callback( $post ) {
    wp_nonce_field( 'ondigital_project_meta', 'ondigital_project_meta_nonce' );
    $client   = get_post_meta( $post->ID, '_project_client', true );
    $ext_url  = get_post_meta( $post->ID, '_project_url', true );
    $gallery  = get_post_meta( $post->ID, '_project_gallery', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="_project_client"><?php esc_html_e( 'Client Name', 'ondigital' ); ?></label></th>
            <td><input type="text" name="_project_client" id="_project_client" value="<?php echo esc_attr( $client ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="_project_url"><?php esc_html_e( 'External URL', 'ondigital' ); ?></label></th>
            <td><input type="url" name="_project_url" id="_project_url" value="<?php echo esc_url( $ext_url ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="_project_gallery"><?php esc_html_e( 'Gallery Image IDs', 'ondigital' ); ?></label></th>
            <td>
                <input type="text" name="_project_gallery" id="_project_gallery" value="<?php echo esc_attr( $gallery ); ?>" class="regular-text">
                <p class="description"><?php esc_html_e( 'Comma-separated attachment IDs for gallery images.', 'ondigital' ); ?></p>
                <button type="button" class="button ondigital-gallery-btn" data-target="#_project_gallery"><?php esc_html_e( 'Manage Gallery', 'ondigital' ); ?></button>
            </td>
        </tr>
    </table>
    <?php
}

// =============================================================================
// Team Member Meta Box
// =============================================================================

function ondigital_team_meta_callback( $post ) {
    wp_nonce_field( 'ondigital_team_meta', 'ondigital_team_meta_nonce' );
    $role      = get_post_meta( $post->ID, '_team_role', true );
    $linkedin  = get_post_meta( $post->ID, '_team_linkedin', true );
    $twitter   = get_post_meta( $post->ID, '_team_twitter', true );
    $instagram = get_post_meta( $post->ID, '_team_instagram', true );
    $behance   = get_post_meta( $post->ID, '_team_behance', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="_team_role"><?php esc_html_e( 'Job Title / Role', 'ondigital' ); ?></label></th>
            <td><input type="text" name="_team_role" id="_team_role" value="<?php echo esc_attr( $role ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="_team_linkedin"><?php esc_html_e( 'LinkedIn URL', 'ondigital' ); ?></label></th>
            <td><input type="url" name="_team_linkedin" id="_team_linkedin" value="<?php echo esc_url( $linkedin ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="_team_twitter"><?php esc_html_e( 'Twitter URL', 'ondigital' ); ?></label></th>
            <td><input type="url" name="_team_twitter" id="_team_twitter" value="<?php echo esc_url( $twitter ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="_team_instagram"><?php esc_html_e( 'Instagram URL', 'ondigital' ); ?></label></th>
            <td><input type="url" name="_team_instagram" id="_team_instagram" value="<?php echo esc_url( $instagram ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="_team_behance"><?php esc_html_e( 'Behance URL', 'ondigital' ); ?></label></th>
            <td><input type="url" name="_team_behance" id="_team_behance" value="<?php echo esc_url( $behance ); ?>" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

// =============================================================================
// Save Meta Boxes
// =============================================================================

add_action( 'save_post', 'ondigital_save_meta_boxes' );
function ondigital_save_meta_boxes( $post_id ) {
    // Bail on autosave or revision
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Service meta
    if ( isset( $_POST['ondigital_service_meta_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_meta_nonce'], 'ondigital_service_meta' ) ) {
        if ( isset( $_POST['_service_icon'] ) ) {
            update_post_meta( $post_id, '_service_icon', absint( $_POST['_service_icon'] ) );
        }
    }

    // Project meta
    if ( isset( $_POST['ondigital_project_meta_nonce'] ) && wp_verify_nonce( $_POST['ondigital_project_meta_nonce'], 'ondigital_project_meta' ) ) {
        if ( isset( $_POST['_project_client'] ) ) {
            update_post_meta( $post_id, '_project_client', sanitize_text_field( $_POST['_project_client'] ) );
        }
        if ( isset( $_POST['_project_url'] ) ) {
            update_post_meta( $post_id, '_project_url', esc_url_raw( $_POST['_project_url'] ) );
        }
        if ( isset( $_POST['_project_gallery'] ) ) {
            // Sanitize comma-separated IDs
            $gallery_ids = array_filter( array_map( 'absint', explode( ',', $_POST['_project_gallery'] ) ) );
            update_post_meta( $post_id, '_project_gallery', implode( ',', $gallery_ids ) );
        }
    }

    // Team member meta
    if ( isset( $_POST['ondigital_team_meta_nonce'] ) && wp_verify_nonce( $_POST['ondigital_team_meta_nonce'], 'ondigital_team_meta' ) ) {
        if ( isset( $_POST['_team_role'] ) ) {
            update_post_meta( $post_id, '_team_role', sanitize_text_field( $_POST['_team_role'] ) );
        }
        $social_fields = array( '_team_linkedin', '_team_twitter', '_team_instagram', '_team_behance' );
        foreach ( $social_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, esc_url_raw( $_POST[ $field ] ) );
            }
        }
    }
}

// =============================================================================
// Enqueue admin scripts for meta boxes
// =============================================================================

add_action( 'admin_enqueue_scripts', 'ondigital_metabox_admin_scripts' );
function ondigital_metabox_admin_scripts( $hook ) {
    if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
        return;
    }
    $screen = get_current_screen();
    if ( ! $screen || ! in_array( $screen->post_type, array( 'service', 'project', 'team_member' ), true ) ) {
        return;
    }
    wp_enqueue_media();
    wp_add_inline_script( 'jquery', '
        jQuery(function($){
            // Single image upload
            $(document).on("click", ".ondigital-upload-btn", function(e){
                e.preventDefault();
                var btn = $(this), target = $(btn.data("target")), preview = $(btn.data("preview"));
                var frame = wp.media({title:"Select Image",multiple:false,library:{type:"image"}});
                frame.on("select",function(){
                    var att = frame.state().get("selection").first().toJSON();
                    target.val(att.id);
                    preview.html("<img src=\""+att.url+"\" style=\"max-width:120px;height:auto;\">");
                });
                frame.open();
            });
            $(document).on("click", ".ondigital-remove-btn", function(e){
                e.preventDefault();
                var btn = $(this);
                $(btn.data("target")).val("");
                $(btn.data("preview")).html("");
            });
            // Gallery selector
            $(document).on("click", ".ondigital-gallery-btn", function(e){
                e.preventDefault();
                var btn = $(this), target = $(btn.data("target"));
                var frame = wp.media({title:"Select Gallery Images",multiple:true,library:{type:"image"}});
                frame.on("select",function(){
                    var ids = frame.state().get("selection").map(function(a){return a.id;});
                    target.val(ids.join(","));
                });
                frame.open();
            });
        });
    ' );
}
