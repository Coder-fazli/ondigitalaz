<?php
/**
 * OnDigital Panel — Reusable Field Render Functions
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Open a collapsible card.
 */
function od_card_open( string $title, string $icon = 'dashicons-edit' ): void {
    echo '<div class="od-card">';
    echo '<div class="od-card-head collapsed">';
    echo '<span class="dashicons ' . esc_attr( $icon ) . '"></span>';
    echo '<h3>' . esc_html( $title ) . '</h3>';
    echo '<span class="dashicons dashicons-arrow-down od-toggle-icon"></span>';
    echo '</div>';
    echo '<div class="od-card-body collapsed">';
}

function od_card_close(): void {
    echo '</div></div>';
}

/**
 * Language tabs wrapper — wraps fields for AZ and EN.
 * Usage:
 *   od_lang_open();
 *   od_lang_pane('az'); ... fields ... od_lang_pane_close();
 *   od_lang_pane('en'); ... fields ... od_lang_pane_close();
 *   od_lang_close();
 */
function od_lang_open(): void {
    echo '<div class="od-lang-wrap">';
    echo '<div class="od-lang-tabs">';
    echo '<span class="od-lang-tab active" data-lang="en">🇬🇧 EN</span>';
    echo '<span class="od-lang-tab" data-lang="az">🇦🇿 AZ</span>';
    echo '</div>';
}

function od_lang_pane( string $lang ): void {
    $active = $lang === 'en' ? 'active' : '';
    echo '<div class="od-lang-pane ' . esc_attr( $active ) . '" data-lang="' . esc_attr( $lang ) . '">';
}

function od_lang_pane_close(): void {
    echo '</div>';
}

function od_lang_close(): void {
    echo '</div>';
}

/**
 * Text input field.
 */
function od_text( string $key, string $label, array $options, string $hint = '' ): void {
    $val = $options[ $key ] ?? '';
    echo '<div class="od-field">';
    echo '<label>' . esc_html( $label );
    if ( $hint ) {
        echo '<span class="od-hint">' . esc_html( $hint ) . '</span>';
    }
    echo '</label>';
    echo '<input type="text" name="options[' . esc_attr( $key ) . ']" value="' . esc_attr( $val ) . '">';
    echo '</div>';
}

/**
 * Textarea field.
 */
function od_textarea( string $key, string $label, array $options, string $hint = '' ): void {
    $val = $options[ $key ] ?? '';
    echo '<div class="od-field">';
    echo '<label>' . esc_html( $label );
    if ( $hint ) {
        echo '<span class="od-hint">' . esc_html( $hint ) . '</span>';
    }
    echo '</label>';
    echo '<textarea name="options[' . esc_attr( $key ) . ']">' . esc_textarea( $val ) . '</textarea>';
    echo '</div>';
}

/**
 * URL input field.
 */
function od_url( string $key, string $label, array $options ): void {
    $val = $options[ $key ] ?? '';
    echo '<div class="od-field">';
    echo '<label>' . esc_html( $label ) . '</label>';
    echo '<input type="url" name="options[' . esc_attr( $key ) . ']" value="' . esc_url( $val ) . '" placeholder="https://">';
    echo '</div>';
}

/**
 * Image picker field.
 */
function od_image( string $key, string $label, array $options ): void {
    $attachment_id = ! empty( $options[ $key ] ) ? absint( $options[ $key ] ) : 0;
    $preview_url   = $attachment_id ? wp_get_attachment_image_url( $attachment_id, 'thumbnail' ) : '';
    $empty_class   = $preview_url ? '' : 'empty';
    echo '<div class="od-field">';
    echo '<label>' . esc_html( $label ) . '</label>';
    echo '<div class="od-image-field">';
    echo '<div class="od-image-preview ' . esc_attr( $empty_class ) . '" data-key="' . esc_attr( $key ) . '">';
    if ( $preview_url ) {
        echo '<img src="' . esc_url( $preview_url ) . '">';
    }
    echo '</div>';
    echo '<div class="od-image-btns">';
    echo '<input type="hidden" name="options[' . esc_attr( $key ) . ']" value="' . esc_attr( $attachment_id ) . '" class="od-img-id">';
    echo '<button type="button" class="button od-upload-img">' . esc_html__( 'Select', 'ondigital' ) . '</button>';
    echo '<button type="button" class="button od-remove-img">' . esc_html__( 'Remove', 'ondigital' ) . '</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

/**
 * Side-by-side field row wrapper.
 */
function od_row_open(): void {
    echo '<div class="od-field-row">';
}

function od_row_close(): void {
    echo '</div>';
}

/**
 * Password input field.
 * Never pre-fills the value — shows placeholder if a value is already stored.
 */
function od_password( string $key, string $label, array $options ): void {
    $has_value = ! empty( $options[ $key ] );
    echo '<div class="od-field">';
    echo '<label>' . esc_html( $label ) . '</label>';
    echo '<input type="password" name="options[' . esc_attr( $key ) . ']" value="" autocomplete="new-password" placeholder="' . ( $has_value ? '••••••••' : '' ) . '">';
    if ( $has_value ) {
        echo '<span class="od-hint">' . esc_html__( 'Leave blank to keep current password', 'ondigital' ) . '</span>';
    }
    echo '</div>';
}

/**
 * Select / dropdown field.
 */
function od_select( string $key, string $label, array $options, array $choices ): void {
    $val = $options[ $key ] ?? '';
    echo '<div class="od-field">';
    echo '<label>' . esc_html( $label ) . '</label>';
    echo '<select name="options[' . esc_attr( $key ) . ']">';
    foreach ( $choices as $choice_val => $choice_label ) {
        $selected = selected( $val, $choice_val, false );
        echo '<option value="' . esc_attr( $choice_val ) . '" ' . $selected . '>' . esc_html( $choice_label ) . '</option>';
    }
    echo '</select>';
    echo '</div>';
}

/**
 * Color picker field (native browser input[type=color]).
 */
function od_color( string $key, string $label, array $options, string $default = '#ffffff' ): void {
    $val = ! empty( $options[ $key ] ) ? $options[ $key ] : $default;
    echo '<div class="od-field od-field-color">';
    echo '<label>' . esc_html( $label ) . '</label>';
    echo '<div style="display:flex;align-items:center;gap:10px;">';
    echo '<input type="color" name="options[' . esc_attr( $key ) . ']" value="' . esc_attr( $val ) . '" style="width:48px;height:36px;padding:2px;border:1px solid #ddd;border-radius:6px;cursor:pointer;">';
    echo '<input type="text" name="options[' . esc_attr( $key ) . '_hex]" value="' . esc_attr( $val ) . '" placeholder="' . esc_attr( $default ) . '" style="width:110px;font-family:monospace;" oninput="this.previousElementSibling.value=this.value">';
    echo '</div>';
    echo '</div>';
    echo '<script>document.querySelector(\'input[name="options[' . esc_js( $key ) . ']\"][type="color"]\').addEventListener("input",function(){this.nextElementSibling.value=this.value});</script>';
}

/**
 * Horizontal divider.
 */
function od_divider(): void {
    echo '<hr class="od-divider">';
}

/**
 * Repeater field (partners, features, etc.)
 * $rows    — current saved rows
 * $tpl_key — JS template key (partner, feature, etc.)
 * $name    — form name prefix (ondigital_partners)
 * $render  — callable( $i, $row ) to render a single row
 */
function od_repeater( array $rows, string $tpl_key, string $name, callable $render ): void {
    echo '<div class="od-repeater" id="repeater-' . esc_attr( $tpl_key ) . '">';
    foreach ( $rows as $i => $row ) {
        $render( $i, $row );
    }
    echo '</div>';
    echo '<button type="button" class="button od-add-row" data-repeater="' . esc_attr( $tpl_key ) . '" data-name="' . esc_attr( $name ) . '">';
    echo esc_html__( '+ Add Row', 'ondigital' );
    echo '</button>';
}
