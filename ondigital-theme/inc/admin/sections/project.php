<?php
/**
 * OnDigital Panel — Projects Archive Section
 *
 * @package OnDigital
 * @var array $options  Loaded from get_option('ondigital_options')
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$langs = array( 'en' => '🇬🇧 EN', 'az' => '🇦🇿 AZ' );
?>
<div class="od-section active" data-section="project">

    <p style="color:#646970;font-size:13px;margin:0 0 20px;padding:12px 16px;background:#fff;border-left:4px solid #ffcd4d;border-radius:4px;">
        <?php esc_html_e( 'Individual project content (hero, images, results, testimonial, process, gallery) is managed via meta boxes on each Project post in WordPress Admin → Projects.', 'ondigital' ); ?>
    </p>

    <!-- ── ARCHIVE PAGE ── -->
    <?php od_card_open( __( 'Projects Archive Page', 'ondigital' ), 'dashicons-portfolio' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'projects_archive_title_' . $lang, __( 'Page Title', 'ondigital' ), $options, __( 'e.g. Our Projects', 'ondigital' ) ); ?>
                <?php od_textarea( 'projects_archive_desc_' . $lang, __( 'Page Description', 'ondigital' ), $options ); ?>
                <?php od_row_open(); ?>
                    <?php od_text( 'projects_archive_badge_' . $lang, __( 'Badge / Eyebrow Text', 'ondigital' ), $options, __( 'e.g. Case Studies', 'ondigital' ) ); ?>
                <?php od_row_close(); ?>
                <?php od_text( 'partners_title_' . $lang, __( 'Partners Section Title', 'ondigital' ), $options, __( 'e.g. Bizim tərəfdaşlarımız', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

    <!-- ── SECTORAL DISTRIBUTION ── -->
    <?php
    $sector_bars = ondigital_get_repeater( 'sector_bars', array() );
    od_card_open( __( 'Sectoral Distribution (Bars)', 'ondigital' ), 'dashicons-chart-bar' );
    ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'sectors_eyebrow_' . $lang, __( 'Eyebrow', 'ondigital' ), $options, __( 'e.g. Sektoral təcrübə', 'ondigital' ) ); ?>
                <?php od_text( 'sectors_title_' . $lang, __( 'Title', 'ondigital' ), $options, __( 'Wrap a word in <span></span> for the green accent', 'ondigital' ) ); ?>
                <?php od_textarea( 'sectors_desc_' . $lang, __( 'Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <p style="color:#646970;font-size:12px;margin:0 0 12px;"><?php esc_html_e( 'Add sectors with a percentage (0–100). Leave all rows empty to show the demo defaults.', 'ondigital' ); ?></p>
        <?php
        od_repeater( $sector_bars, 'sector_bar', 'ondigital_sector_bars', function( $i, $row ) {
            $le  = $row['label_en'] ?? '';
            $la  = $row['label_az'] ?? '';
            $pct = $row['percent'] ?? '';
            $head = sprintf( esc_html__( 'Sector %d', 'ondigital' ), $i + 1 ) . ( $le !== '' ? ' — ' . esc_html( $le ) : '' ) . ( $pct !== '' ? ' (' . esc_html( $pct ) . '%)' : '' );
            echo '<div class="od-repeater-row od-sc-row">';
            echo '<div class="od-repeater-row-head od-sc-toggle" style="cursor:pointer;user-select:none;display:flex;align-items:center;gap:10px;">';
            echo '<span>' . $head . '</span>';
            echo '<div class="od-row-actions" style="margin-left:auto;"><span class="od-sc-arrow" style="margin-right:8px;font-size:11px;opacity:.5;">▼</span><button type="button" class="od-remove-row">&times;</button></div>';
            echo '</div>';
            echo '<div class="od-sc-body" style="display:none;">';
            echo '<div class="od-field-row">';
            echo '<div class="od-field"><label>' . esc_html__( 'Label (EN)', 'ondigital' ) . '</label><input type="text" name="ondigital_sector_bars[' . $i . '][label_en]" value="' . esc_attr( $le ) . '"></div>';
            echo '<div class="od-field"><label>' . esc_html__( 'Label (AZ)', 'ondigital' ) . '</label><input type="text" name="ondigital_sector_bars[' . $i . '][label_az]" value="' . esc_attr( $la ) . '"></div>';
            echo '</div>';
            echo '<div class="od-field"><label>' . esc_html__( 'Percentage (0–100)', 'ondigital' ) . '</label><input type="number" min="0" max="100" name="ondigital_sector_bars[' . $i . '][percent]" value="' . esc_attr( $pct ) . '" placeholder="e.g. 26" style="max-width:120px;"></div>';
            echo '</div></div>';
        } );
        ?>
    <?php od_card_close(); ?>

    <!-- ── BRANDS GRID ── -->
    <?php
    $brand_logos = ondigital_get_repeater( 'brand_logos', array() );
    od_card_open( __( 'Brands We Worked With (Grid)', 'ondigital' ), 'dashicons-grid-view' );
    ?>
        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'brands_grid_title_' . $lang, __( 'Section Title', 'ondigital' ), $options, __( 'e.g. Birlikdə çalışdığımız brendlər', 'ondigital' ) ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>
        <p style="color:#646970;font-size:12px;margin:0 0 12px;"><?php esc_html_e( 'Add brand logos. Each can link to a URL that opens in a new tab. "Group" is optional — logos with the same group are shown under that heading.', 'ondigital' ); ?></p>
        <?php
        od_repeater( $brand_logos, 'brand_logo', 'ondigital_brand_logos', function( $i, $row ) {
            $logo_id  = absint( $row['logo'] ?? 0 );
            $logo_url = $logo_id ? wp_get_attachment_image_url( $logo_id, 'thumbnail' ) : '';
            $grp      = trim( (string) ( $row['group'] ?? '' ) );
            $head     = sprintf( esc_html__( 'Brand %d', 'ondigital' ), $i + 1 ) . ( $grp ? ' — ' . esc_html( $grp ) : '' );
            echo '<div class="od-repeater-row od-sc-row">';
            echo '<div class="od-repeater-row-head od-sc-toggle" style="cursor:pointer;user-select:none;display:flex;align-items:center;gap:10px;">';
            if ( $logo_url ) {
                echo '<img src="' . esc_url( $logo_url ) . '" style="height:22px;width:auto;background:#fff;border-radius:3px;padding:2px;">';
            }
            echo '<span>' . $head . '</span>';
            echo '<div class="od-row-actions" style="margin-left:auto;"><span class="od-sc-arrow" style="margin-right:8px;font-size:11px;opacity:.5;">▼</span><button type="button" class="od-remove-row">&times;</button></div>';
            echo '</div>';
            echo '<div class="od-sc-body" style="display:none;">';
            echo '<div class="od-field-row">';
            echo '<div class="od-field"><label>' . esc_html__( 'Logo', 'ondigital' ) . '</label><div class="od-image-field"><div class="od-image-preview ' . ( $logo_url ? '' : 'empty' ) . '">' . ( $logo_url ? '<img src="' . esc_url( $logo_url ) . '">' : '' ) . '</div><div class="od-image-btns"><input type="hidden" name="ondigital_brand_logos[' . $i . '][logo]" value="' . esc_attr( $logo_id ) . '" class="od-img-id"><button type="button" class="button od-upload-img">' . esc_html__( 'Select', 'ondigital' ) . '</button><button type="button" class="button od-remove-img">' . esc_html__( 'Remove', 'ondigital' ) . '</button></div></div></div>';
            echo '<div class="od-field"><label>' . esc_html__( 'Link (opens in new tab)', 'ondigital' ) . '</label><input type="url" name="ondigital_brand_logos[' . $i . '][url]" value="' . esc_url( $row['url'] ?? '' ) . '" placeholder="https://"></div>';
            echo '</div>';
            echo '<div class="od-field"><label>' . esc_html__( 'Group / Category (optional)', 'ondigital' ) . '</label><input type="text" name="ondigital_brand_logos[' . $i . '][group]" value="' . esc_attr( $row['group'] ?? '' ) . '" placeholder="' . esc_attr__( 'e.g. B2B', 'ondigital' ) . '"></div>';
            echo '</div></div>';
        } );
        ?>
    <?php od_card_close(); ?>

    <!-- ── SEO ── -->
    <?php od_card_open( __( 'Archive Page SEO', 'ondigital' ), 'dashicons-search' ); ?>

        <?php od_lang_open(); ?>
        <?php foreach ( $langs as $lang => $label ) : ?>
            <?php od_lang_pane( $lang ); ?>
                <?php od_text( 'projects_meta_title_' . $lang, __( 'Meta Title', 'ondigital' ), $options ); ?>
                <?php od_textarea( 'projects_meta_desc_' . $lang, __( 'Meta Description', 'ondigital' ), $options ); ?>
            <?php od_lang_pane_close(); ?>
        <?php endforeach; ?>
        <?php od_lang_close(); ?>

    <?php od_card_close(); ?>

</div>
