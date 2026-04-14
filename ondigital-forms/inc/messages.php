<?php
/**
 * OnDigital Forms — Messages Admin Page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── Submenu registration (called from admin.php) ───────────────────────────────
function odf_register_messages_menu(): void {
    $unread = odf_get_unread_count();
    $badge  = $unread > 0
        ? ' <span class="update-plugins count-' . $unread . '"><span class="plugin-count">' . $unread . '</span></span>'
        : '';

    add_submenu_page(
        'odf-templates',
        __( 'Messages', 'odf' ),
        __( 'Messages', 'odf' ) . $badge,
        'manage_options',
        'odf-messages',
        'odf_render_messages'
    );
}
add_action( 'admin_menu', 'odf_register_messages_menu', 11 );

// ── Badge on main menu item ────────────────────────────────────────────────────
add_action( 'admin_menu', 'odf_badge_main_menu', 99 );
function odf_badge_main_menu(): void {
    global $menu;
    $unread = odf_get_unread_count();
    if ( ! $unread ) {
        return;
    }
    foreach ( $menu as $key => $item ) {
        if ( isset( $item[2] ) && $item[2] === 'odf-templates' ) {
            $menu[ $key ][0] .= ' <span class="update-plugins count-' . $unread . '"><span class="plugin-count">' . $unread . '</span></span>';
            break;
        }
    }
}

// ── AJAX: mark as read ─────────────────────────────────────────────────────────
add_action( 'wp_ajax_odf_mark_read', 'odf_ajax_mark_read' );
function odf_ajax_mark_read(): void {
    check_ajax_referer( 'odf_messages', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error();
    }
    global $wpdb;
    $id = absint( $_POST['id'] ?? 0 );
    if ( $id ) {
        $wpdb->update( $wpdb->prefix . 'odf_submissions', array( 'is_read' => 1 ), array( 'id' => $id ), array( '%d' ), array( '%d' ) );
    }
    wp_send_json_success();
}

// ── AJAX: delete message ───────────────────────────────────────────────────────
add_action( 'wp_ajax_odf_delete_msg', 'odf_ajax_delete_msg' );
function odf_ajax_delete_msg(): void {
    check_ajax_referer( 'odf_messages', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error();
    }
    global $wpdb;
    $id = absint( $_POST['id'] ?? 0 );
    if ( $id ) {
        $wpdb->delete( $wpdb->prefix . 'odf_submissions', array( 'id' => $id ), array( '%d' ) );
    }
    wp_send_json_success();
}

// ── Page render ────────────────────────────────────────────────────────────────
function odf_render_messages(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    global $wpdb;
    $table = $wpdb->prefix . 'odf_submissions';
    $rows  = $wpdb->get_results( "SELECT * FROM {$table} ORDER BY submitted_at DESC" );
    $nonce = wp_create_nonce( 'odf_messages' );
    ?>
    <div class="odf-admin-wrap">
        <div class="odf-topbar">
            <h1><?php esc_html_e( 'Messages', 'odf' ); ?>
                <?php $unread = odf_get_unread_count(); if ( $unread ) : ?>
                <span class="odf-unread-badge"><?php echo esc_html( $unread ); ?> unread</span>
                <?php endif; ?>
            </h1>
        </div>

        <?php if ( empty( $rows ) ) : ?>
        <div class="odf-empty-state">
            <span class="dashicons dashicons-email-alt" style="font-size:48px;color:#ccc;"></span>
            <p>No messages yet. Submissions will appear here.</p>
        </div>
        <?php else : ?>

        <div class="odf-messages-list">
            <?php foreach ( $rows as $row ) :
                $is_unread = ! $row->is_read;
                $sources   = $row->source ? implode( ', ', array_map( 'ucfirst', explode( ',', $row->source ) ) ) : '—';
            ?>
            <div class="odf-message-card <?php echo $is_unread ? 'is-unread' : ''; ?>" data-id="<?php echo esc_attr( $row->id ); ?>">

                <div class="odf-msg-header">
                    <div class="odf-msg-meta">
                        <?php if ( $is_unread ) : ?>
                        <span class="odf-dot"></span>
                        <?php endif; ?>
                        <strong class="odf-msg-name"><?php echo esc_html( $row->name ?: '(No name)' ); ?></strong>
                        <?php if ( $row->email ) : ?>
                        <a href="mailto:<?php echo esc_attr( $row->email ); ?>" class="odf-msg-email"><?php echo esc_html( $row->email ); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="odf-msg-right">
                        <span class="odf-msg-date"><?php echo esc_html( date_i18n( 'd M Y, H:i', strtotime( $row->submitted_at ) ) ); ?></span>
                        <div class="odf-msg-actions">
                            <?php if ( $is_unread ) : ?>
                            <button class="odf-btn-read" data-id="<?php echo esc_attr( $row->id ); ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>">Mark read</button>
                            <?php endif; ?>
                            <button class="odf-btn-delete" data-id="<?php echo esc_attr( $row->id ); ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>">Delete</button>
                        </div>
                    </div>
                </div>

                <div class="odf-msg-body">
                    <?php if ( $row->phone ) : ?>
                    <span class="odf-detail"><strong>Phone:</strong> <?php echo esc_html( $row->phone ); ?></span>
                    <?php endif; ?>
                    <?php if ( $row->company ) : ?>
                    <span class="odf-detail"><strong>Company:</strong> <?php echo esc_html( $row->company ); ?></span>
                    <?php endif; ?>
                    <?php if ( $row->ecommerce ) : ?>
                    <span class="odf-detail"><strong>E-commerce:</strong> <?php echo esc_html( ucfirst( $row->ecommerce ) ); ?></span>
                    <?php endif; ?>
                    <?php if ( $row->source ) : ?>
                    <span class="odf-detail"><strong>Source:</strong> <?php echo esc_html( $sources ); ?></span>
                    <?php endif; ?>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

        <?php endif; ?>
    </div>

    <script>
    (function($){
        var ajaxurl = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>';

        // Mark as read
        $(document).on('click', '.odf-btn-read', function(){
            var $btn  = $(this);
            var id    = $btn.data('id');
            var nonce = $btn.data('nonce');
            $.post(ajaxurl, { action: 'odf_mark_read', id: id, nonce: nonce }, function(){
                var $card = $btn.closest('.odf-message-card');
                $card.removeClass('is-unread');
                $card.find('.odf-dot').remove();
                $btn.remove();
                // Update badge in sidebar
                var $badge = $('#toplevel_page_odf-settings .update-plugins');
                var count = parseInt($badge.find('.plugin-count').text()) - 1;
                if(count <= 0){ $badge.remove(); } else { $badge.find('.plugin-count').text(count); $badge.attr('class','update-plugins count-'+count); }
            });
        });

        // Delete
        $(document).on('click', '.odf-btn-delete', function(){
            if(!confirm('Delete this message?')) return;
            var $btn  = $(this);
            var id    = $btn.data('id');
            var nonce = $btn.data('nonce');
            $.post(ajaxurl, { action: 'odf_delete_msg', id: id, nonce: nonce }, function(){
                $btn.closest('.odf-message-card').fadeOut(300, function(){ $(this).remove(); });
            });
        });
    })(jQuery);
    </script>

    <style>
    .odf-unread-badge { background:#3fd467; color:#000; font-size:12px; font-weight:700; padding:3px 10px; border-radius:20px; margin-left:10px; vertical-align:middle; }
    .odf-empty-state  { text-align:center; padding:80px 20px; color:#aaa; }
    .odf-empty-state p{ margin-top:12px; font-size:15px; }

    .odf-messages-list { display:flex; flex-direction:column; gap:12px; }

    .odf-message-card {
        background:#fff; border:1px solid #e5e5e5; border-radius:12px;
        padding:18px 22px; transition:box-shadow 0.2s;
    }
    .odf-message-card:hover { box-shadow:0 2px 12px rgba(0,0,0,0.07); }
    .odf-message-card.is-unread { border-left:3px solid #3fd467; background:#fafffe; }

    .odf-msg-header { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
    .odf-msg-meta   { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
    .odf-msg-right  { display:flex; align-items:center; gap:14px; flex-shrink:0; }

    .odf-dot { width:8px; height:8px; border-radius:50%; background:#3fd467; flex-shrink:0; }
    .odf-msg-name  { font-size:15px; color:#111; }
    .odf-msg-email { font-size:13px; color:#3fd467; text-decoration:none; }
    .odf-msg-email:hover { text-decoration:underline; }
    .odf-msg-date  { font-size:12px; color:#aaa; }

    .odf-msg-actions { display:flex; gap:8px; }
    .odf-btn-read, .odf-btn-delete {
        border:none; border-radius:6px; padding:5px 12px; font-size:12px;
        font-weight:600; cursor:pointer; transition:background 0.15s;
    }
    .odf-btn-read   { background:#e8f9ee; color:#2e7d46; }
    .odf-btn-read:hover { background:#d1f5df; }
    .odf-btn-delete { background:#ffeaea; color:#c00; }
    .odf-btn-delete:hover { background:#ffd5d5; }

    .odf-msg-body   { display:flex; flex-wrap:wrap; gap:8px 20px; margin-top:12px; padding-top:12px; border-top:1px solid #f0f0f0; }
    .odf-detail     { font-size:13px; color:#555; }
    .odf-detail strong { color:#222; }
    </style>
    <?php
}
