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

    // Project: all content fields
    add_meta_box(
        'ondigital_project_hero',
        __( '1. Hero', 'ondigital' ),
        'ondigital_project_hero_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_image',
        __( '2. Full-Width Image', 'ondigital' ),
        'ondigital_project_image_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_results',
        __( '3. Results & Metrics', 'ondigital' ),
        'ondigital_project_results_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_testimonial',
        __( '4. Testimonial / Quote', 'ondigital' ),
        'ondigital_project_testimonial_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_process',
        __( '5. Process Steps', 'ondigital' ),
        'ondigital_project_process_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_gallery',
        __( '6. Gallery', 'ondigital' ),
        'ondigital_project_gallery_callback',
        'project',
        'normal',
        'high'
    );
    add_meta_box(
        'ondigital_project_archive_card',
        __( '7. Archive Card (shown on projects grid)', 'ondigital' ),
        'ondigital_project_archive_card_callback',
        'project',
        'normal',
        'high'
    );

    // Team Member
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
// Helper: text input row
// =============================================================================
function od_mb_text( $name, $label, $value, $placeholder = '', $type = 'text' ) {
    ?>
    <tr>
        <th style="width:200px"><label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label></th>
        <td>
            <input type="<?php echo esc_attr( $type ); ?>"
                   name="<?php echo esc_attr( $name ); ?>"
                   id="<?php echo esc_attr( $name ); ?>"
                   value="<?php echo esc_attr( $value ); ?>"
                   placeholder="<?php echo esc_attr( $placeholder ); ?>"
                   class="regular-text">
        </td>
    </tr>
    <?php
}

function od_mb_textarea( $name, $label, $value, $placeholder = '' ) {
    ?>
    <tr>
        <th style="width:200px"><label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label></th>
        <td>
            <textarea name="<?php echo esc_attr( $name ); ?>"
                      id="<?php echo esc_attr( $name ); ?>"
                      rows="3"
                      placeholder="<?php echo esc_attr( $placeholder ); ?>"
                      class="large-text"><?php echo esc_textarea( $value ); ?></textarea>
        </td>
    </tr>
    <?php
}

function od_mb_image( $name, $label, $image_id ) {
    $url = $image_id ? wp_get_attachment_image_url( $image_id, 'medium' ) : '';
    ?>
    <tr>
        <th style="width:200px"><label><?php echo esc_html( $label ); ?></label></th>
        <td>
            <input type="hidden" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $image_id ); ?>">
            <div id="preview-<?php echo esc_attr( $name ); ?>" style="margin-bottom:8px;">
                <?php if ( $url ) : ?>
                    <img src="<?php echo esc_url( $url ); ?>" style="max-width:200px;height:auto;display:block;border-radius:4px;">
                <?php endif; ?>
            </div>
            <button type="button" class="button od-upload-btn" data-target="#<?php echo esc_attr( $name ); ?>" data-preview="#preview-<?php echo esc_attr( $name ); ?>"><?php esc_html_e( 'Select Image', 'ondigital' ); ?></button>
            <?php if ( $image_id ) : ?>
                <button type="button" class="button od-remove-btn" data-target="#<?php echo esc_attr( $name ); ?>" data-preview="#preview-<?php echo esc_attr( $name ); ?>"><?php esc_html_e( 'Remove', 'ondigital' ); ?></button>
            <?php endif; ?>
        </td>
    </tr>
    <?php
}

// =============================================================================
// Service Meta Box
// =============================================================================

function ondigital_service_meta_callback( $post ) {
    wp_nonce_field( 'ondigital_service_meta', 'ondigital_service_meta_nonce' );
    $icon_id  = get_post_meta( $post->ID, '_service_icon', true );
    $features = get_post_meta( $post->ID, '_service_features', true );
    ?>
    <table class="form-table">
        <?php od_mb_image( '_service_icon', __( 'Service Icon', 'ondigital' ), $icon_id ); ?>
        <tr>
            <th><label for="_service_features"><?php esc_html_e( 'Feature List', 'ondigital' ); ?></label></th>
            <td>
                <textarea name="_service_features" id="_service_features" rows="7" class="large-text"><?php echo esc_textarea( $features ); ?></textarea>
                <p class="description"><?php esc_html_e( 'One feature per line.', 'ondigital' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

// =============================================================================
// Project — Hero
// =============================================================================

function ondigital_project_hero_callback( $post ) {
    wp_nonce_field( 'ondigital_project_all', 'ondigital_project_nonce' );
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_od_tag',      __( 'Badge Text', 'ondigital' ),         get_post_meta( $id, '_od_tag', true ),      __( 'e.g. Case Study — Education · 2025', 'ondigital' ) );
        od_mb_text( '_od_title_main', __( 'Title Line 1', 'ondigital' ),     get_post_meta( $id, '_od_title_main', true ), __( 'e.g. Alas Academy', 'ondigital' ) );
        od_mb_text( '_od_title_hl',   __( 'Highlighted Word (green)', 'ondigital' ), get_post_meta( $id, '_od_title_hl', true ), __( 'e.g. Ondigital', 'ondigital' ) );
        od_mb_text( '_od_date',     __( 'Date', 'ondigital' ),               get_post_meta( $id, '_od_date', true ),     __( 'e.g. Jan – May 2025', 'ondigital' ) );
        od_mb_text( '_od_client',   __( 'Client', 'ondigital' ),             get_post_meta( $id, '_od_client', true ),   __( 'e.g. Alas Academy', 'ondigital' ) );
        od_mb_text( '_od_services', __( 'Services', 'ondigital' ),           get_post_meta( $id, '_od_services', true ), __( 'e.g. Web · SEO · Paid Ads · Email', 'ondigital' ) );
        od_mb_text( '_od_outcome',  __( 'Outcome', 'ondigital' ),            get_post_meta( $id, '_od_outcome', true ),  __( 'e.g. +340% Revenue · 4 months', 'ondigital' ) );
        od_mb_text( '_od_live_url', __( 'Live Site URL', 'ondigital' ),      get_post_meta( $id, '_od_live_url', true ), 'https://', 'url' );
        ?>
    </table>
    <?php
}

// =============================================================================
// Project — Full-Width Image
// =============================================================================

function ondigital_project_image_callback( $post ) {
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php od_mb_image( '_od_hero_image', __( 'Project Screenshot / Hero Image', 'ondigital' ), get_post_meta( $id, '_od_hero_image', true ) ); ?>
    </table>
    <?php
}

// =============================================================================
// Project — Results & Metrics
// =============================================================================

function ondigital_project_results_callback( $post ) {
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php
        od_mb_text(     '_od_results_title', __( 'Section Title', 'ondigital' ),       get_post_meta( $id, '_od_results_title', true ), __( 'e.g. Numbers that speak for themselves.', 'ondigital' ) );
        od_mb_textarea( '_od_results_desc',  __( 'Section Description', 'ondigital' ), get_post_meta( $id, '_od_results_desc', true ) );
        ?>
        <?php for ( $n = 1; $n <= 4; $n++ ) : ?>
        <tr><td colspan="2"><hr style="margin:8px 0"><strong><?php printf( esc_html__( 'Stat %d', 'ondigital' ), $n ); ?></strong></td></tr>
        <?php
            od_mb_text( "_od_stat{$n}_value",  sprintf( __( 'Stat %d — Value', 'ondigital' ), $n ),  get_post_meta( $id, "_od_stat{$n}_value", true ),  __( 'e.g. 340', 'ondigital' ) );
            od_mb_text( "_od_stat{$n}_suffix", sprintf( __( 'Stat %d — Suffix', 'ondigital' ), $n ), get_post_meta( $id, "_od_stat{$n}_suffix", true ), __( 'e.g. % or ×', 'ondigital' ) );
            od_mb_text( "_od_stat{$n}_label",  sprintf( __( 'Stat %d — Label', 'ondigital' ), $n ),  get_post_meta( $id, "_od_stat{$n}_label", true ),  __( 'e.g. Revenue growth in 4 months', 'ondigital' ) );
        ?>
        <?php endfor; ?>
    </table>
    <?php
}

// =============================================================================
// Project — Testimonial
// =============================================================================

function ondigital_project_testimonial_callback( $post ) {
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php
        od_mb_textarea( '_od_quote',          __( 'Quote Text', 'ondigital' ),     get_post_meta( $id, '_od_quote', true ) );
        od_mb_text(     '_od_author',         __( 'Author Name', 'ondigital' ),    get_post_meta( $id, '_od_author', true ),         __( 'e.g. Sara Khalil', 'ondigital' ) );
        od_mb_text(     '_od_author_role',    __( 'Author Role', 'ondigital' ),    get_post_meta( $id, '_od_author_role', true ),    __( 'e.g. Founder, Alas Academy', 'ondigital' ) );
        od_mb_text(     '_od_author_initials',__( 'Initials (avatar)', 'ondigital' ), get_post_meta( $id, '_od_author_initials', true ), __( 'e.g. SK', 'ondigital' ) );
        ?>
    </table>
    <?php
}

// =============================================================================
// Project — Process Steps
// =============================================================================

function ondigital_project_process_callback( $post ) {
    $id    = $post->ID;
    $steps = get_post_meta( $id, '_od_steps', true );
    if ( ! is_array( $steps ) ) {
        $steps = array_fill( 0, 4, array( 'title_az' => '', 'title_en' => '', 'desc_az' => '', 'desc_en' => '', 'duration' => '' ) );
    }
    // Always show 4 step rows
    while ( count( $steps ) < 4 ) {
        $steps[] = array( 'title_az' => '', 'title_en' => '', 'desc_az' => '', 'desc_en' => '', 'duration' => '' );
    }
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_od_process_eyebrow', __( 'Eyebrow Label', 'ondigital' ), get_post_meta( $id, '_od_process_eyebrow', true ), __( 'e.g. Our Process', 'ondigital' ) );
        od_mb_text( '_od_process_heading', __( 'Heading', 'ondigital' ),       get_post_meta( $id, '_od_process_heading', true ), __( 'e.g. How we made it happen.', 'ondigital' ) );
        ?>
    </table>
    <?php foreach ( $steps as $i => $step ) : $n = $i + 1; ?>
    <h4 style="padding:12px 12px 0;margin:0;"><?php printf( esc_html__( 'Step %d', 'ondigital' ), $n ); ?></h4>
    <table class="form-table">
        <tr>
            <th style="width:200px"><?php esc_html_e( 'Title (AZ)', 'ondigital' ); ?></th>
            <td><input type="text" name="_od_steps[<?php echo $i; ?>][title_az]" value="<?php echo esc_attr( $step['title_az'] ?? '' ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Kəşfiyyat', 'ondigital' ); ?>"></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Title (EN)', 'ondigital' ); ?></th>
            <td><input type="text" name="_od_steps[<?php echo $i; ?>][title_en]" value="<?php echo esc_attr( $step['title_en'] ?? '' ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Discovery', 'ondigital' ); ?>"></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Description (AZ)', 'ondigital' ); ?></th>
            <td><textarea name="_od_steps[<?php echo $i; ?>][desc_az]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in Azerbaijani', 'ondigital' ); ?>"><?php echo esc_textarea( $step['desc_az'] ?? '' ); ?></textarea></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Description (EN)', 'ondigital' ); ?></th>
            <td><textarea name="_od_steps[<?php echo $i; ?>][desc_en]" rows="3" class="large-text" placeholder="<?php esc_attr_e( 'Description in English', 'ondigital' ); ?>"><?php echo esc_textarea( $step['desc_en'] ?? '' ); ?></textarea></td>
        </tr>
        <tr>
            <th><?php esc_html_e( 'Duration', 'ondigital' ); ?></th>
            <td><input type="text" name="_od_steps[<?php echo $i; ?>][duration]" value="<?php echo esc_attr( $step['duration'] ?? '' ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g. 2 weeks', 'ondigital' ); ?>"></td>
        </tr>
    </table>
    <?php endforeach; ?>
    <?php
}

// =============================================================================
// Project — Gallery
// =============================================================================

function ondigital_project_gallery_callback( $post ) {
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php for ( $n = 1; $n <= 3; $n++ ) : ?>
            <?php od_mb_image( "_od_gallery_{$n}", sprintf( __( 'Gallery Image %d', 'ondigital' ), $n ), get_post_meta( $id, "_od_gallery_{$n}", true ) ); ?>
        <?php endfor; ?>
    </table>
    <?php
}

// =============================================================================
// Project — Archive Card
// =============================================================================

function ondigital_project_archive_card_callback( $post ) {
    $id = $post->ID;
    ?>
    <p class="description" style="padding:0 12px 8px;"><?php esc_html_e( 'These fields appear on the projects archive grid card.', 'ondigital' ); ?></p>
    <table class="form-table">
        <?php
        od_mb_text( 'project_result_number', __( 'Result Number', 'ondigital' ),  get_post_meta( $id, 'project_result_number', true ), __( 'e.g. +340%', 'ondigital' ) );
        od_mb_text( 'project_result_label',  __( 'Result Label', 'ondigital' ),   get_post_meta( $id, 'project_result_label', true ),  __( 'e.g. Gəlir artımı', 'ondigital' ) );
        od_mb_text( 'project_result_sub',    __( 'Result Subtitle', 'ondigital' ), get_post_meta( $id, 'project_result_sub', true ),    __( 'e.g. 4 ayda', 'ondigital' ) );
        ?>
    </table>
    <?php
}

// =============================================================================
// Team Member Meta Box
// =============================================================================

function ondigital_team_meta_callback( $post ) {
    wp_nonce_field( 'ondigital_team_meta', 'ondigital_team_meta_nonce' );
    $id = $post->ID;
    ?>
    <table class="form-table">
        <?php
        od_mb_text( '_team_role',      __( 'Job Title / Role', 'ondigital' ), get_post_meta( $id, '_team_role', true ) );
        od_mb_text( '_team_linkedin',  __( 'LinkedIn URL', 'ondigital' ),     get_post_meta( $id, '_team_linkedin', true ),  '', 'url' );
        od_mb_text( '_team_twitter',   __( 'Twitter URL', 'ondigital' ),      get_post_meta( $id, '_team_twitter', true ),   '', 'url' );
        od_mb_text( '_team_instagram', __( 'Instagram URL', 'ondigital' ),    get_post_meta( $id, '_team_instagram', true ), '', 'url' );
        od_mb_text( '_team_behance',   __( 'Behance URL', 'ondigital' ),      get_post_meta( $id, '_team_behance', true ),   '', 'url' );
        ?>
    </table>
    <?php
}

// =============================================================================
// Save Meta Boxes
// =============================================================================

add_action( 'save_post', 'ondigital_save_meta_boxes' );
function ondigital_save_meta_boxes( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( wp_is_post_revision( $post_id ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // ── Service ──
    if ( isset( $_POST['ondigital_service_meta_nonce'] ) && wp_verify_nonce( $_POST['ondigital_service_meta_nonce'], 'ondigital_service_meta' ) ) {
        if ( isset( $_POST['_service_icon'] ) ) {
            update_post_meta( $post_id, '_service_icon', absint( $_POST['_service_icon'] ) );
        }
        if ( isset( $_POST['_service_features'] ) ) {
            update_post_meta( $post_id, '_service_features', sanitize_textarea_field( $_POST['_service_features'] ) );
        }
    }

    // ── Project ──
    if ( isset( $_POST['ondigital_project_nonce'] ) && wp_verify_nonce( $_POST['ondigital_project_nonce'], 'ondigital_project_all' ) ) {

        // Text fields
        $text_fields = array(
            '_od_tag', '_od_title_main', '_od_title_hl',
            '_od_date', '_od_client', '_od_services', '_od_outcome',
            '_od_results_title', '_od_author', '_od_author_role', '_od_author_initials',
            '_od_process_eyebrow', '_od_process_heading',
            'project_result_number', 'project_result_label', 'project_result_sub',
        );
        foreach ( $text_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }

        // URL fields
        $url_fields = array( '_od_live_url' );
        foreach ( $url_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, esc_url_raw( $_POST[ $field ] ) );
            }
        }

        // Textarea fields
        if ( isset( $_POST['_od_results_desc'] ) ) {
            update_post_meta( $post_id, '_od_results_desc', sanitize_textarea_field( $_POST['_od_results_desc'] ) );
        }
        if ( isset( $_POST['_od_quote'] ) ) {
            update_post_meta( $post_id, '_od_quote', sanitize_textarea_field( $_POST['_od_quote'] ) );
        }

        // Image IDs
        $image_fields = array( '_od_hero_image', '_od_gallery_1', '_od_gallery_2', '_od_gallery_3' );
        foreach ( $image_fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, absint( $_POST[ $field ] ) );
            }
        }

        // Stats (4 sets)
        for ( $n = 1; $n <= 4; $n++ ) {
            foreach ( array( 'value', 'suffix', 'label' ) as $part ) {
                $key = "_od_stat{$n}_{$part}";
                if ( isset( $_POST[ $key ] ) ) {
                    update_post_meta( $post_id, $key, sanitize_text_field( $_POST[ $key ] ) );
                }
            }
        }

        // Process steps
        if ( isset( $_POST['_od_steps'] ) && is_array( $_POST['_od_steps'] ) ) {
            $steps = array();
            foreach ( $_POST['_od_steps'] as $step ) {
                $steps[] = array(
                    'title_az' => sanitize_text_field( $step['title_az'] ?? '' ),
                    'title_en' => sanitize_text_field( $step['title_en'] ?? '' ),
                    'desc_az'  => sanitize_textarea_field( $step['desc_az'] ?? '' ),
                    'desc_en'  => sanitize_textarea_field( $step['desc_en'] ?? '' ),
                    'duration' => sanitize_text_field( $step['duration'] ?? '' ),
                );
            }
            update_post_meta( $post_id, '_od_steps', $steps );
        }
    }

    // ── Team member ──
    if ( isset( $_POST['ondigital_team_meta_nonce'] ) && wp_verify_nonce( $_POST['ondigital_team_meta_nonce'], 'ondigital_team_meta' ) ) {
        if ( isset( $_POST['_team_role'] ) ) {
            update_post_meta( $post_id, '_team_role', sanitize_text_field( $_POST['_team_role'] ) );
        }
        foreach ( array( '_team_linkedin', '_team_twitter', '_team_instagram', '_team_behance' ) as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, esc_url_raw( $_POST[ $field ] ) );
            }
        }
    }
}

// =============================================================================
// Enqueue admin scripts for media upload
// =============================================================================

add_action( 'admin_enqueue_scripts', 'ondigital_metabox_admin_scripts' );
function ondigital_metabox_admin_scripts( $hook ) {
    if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) return;
    $screen = get_current_screen();
    if ( ! $screen || ! in_array( $screen->post_type, array( 'service', 'project', 'team_member' ), true ) ) return;

    wp_enqueue_media();
    wp_add_inline_script( 'jquery', '
    jQuery(function($){
        $(document).on("click", ".od-upload-btn", function(e){
            e.preventDefault();
            var btn=$(this), target=$(btn.data("target")), preview=$(btn.data("preview"));
            var frame=wp.media({title:"Select Image",multiple:false,library:{type:"image"}});
            frame.on("select",function(){
                var att=frame.state().get("selection").first().toJSON();
                target.val(att.id);
                preview.html("<img src=\""+att.url+"\" style=\"max-width:200px;height:auto;display:block;border-radius:4px;\">");
            });
            frame.open();
        });
        $(document).on("click", ".od-remove-btn", function(e){
            e.preventDefault();
            var btn=$(this);
            $(btn.data("target")).val("");
            $(btn.data("preview")).html("");
        });
    });
    ' );
}
