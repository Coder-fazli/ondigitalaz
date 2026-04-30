<?php
/**
 * Home - Hero Section (Redesign)
 *
 * @package OnDigital
 */

$hero_badge    = ondigital_get_option( 'hero_subtitle', 'Official Google Partner Agency' );
$hero_h1_line1 = ondigital_get_option( 'hero_h1_line1', 'Performance' );
$hero_h1_line2 = ondigital_get_option( 'hero_h1_line2', 'Marketing' );
$hero_h1_line3 = ondigital_get_option( 'hero_h1_line3', 'Agency' );
$hero_body     = ondigital_get_option( 'hero_body', 'Bizneslərin böyüməsi üçün gərəkli olan rəqəmsal marketinq xidmətləri.' );
$hero_cta_text = ondigital_get_option( 'hero_cta_text', 'Teklif Al !' );
$hero_cta_url  = ondigital_get_option( 'hero_cta_url' );
$hero_cta_url  = $hero_cta_url ? $hero_cta_url : home_url( '/elaqe/' );
$hero_btn2_text = ondigital_get_option( 'hero_btn2_text', 'Xidmətlər' );
$hero_btn2_url  = ondigital_get_option( 'hero_btn2_url' );
$hero_btn2_url  = $hero_btn2_url ? $hero_btn2_url : home_url( '/xidmetler/' );

$stat1_num    = ondigital_get_option( 'hero_stat1_num', '150' );
$stat1_suffix = ondigital_get_option( 'hero_stat1_suffix', '+' );
$stat1_label  = ondigital_get_option( 'hero_stat1_label', 'Müştəri' );
$stat2_num    = ondigital_get_option( 'hero_stat2_num', '8' );
$stat2_suffix = ondigital_get_option( 'hero_stat2_suffix', 'x' );
$stat2_label  = ondigital_get_option( 'hero_stat2_label', 'Ortalama ROI' );
$stat3_num    = ondigital_get_option( 'hero_stat3_num', '5' );
$stat3_suffix = ondigital_get_option( 'hero_stat3_suffix', '+' );
$stat3_label  = ondigital_get_option( 'hero_stat3_label', 'İl Təcrübə' );
$stat4_num    = ondigital_get_option( 'hero_stat4_num', '98' );
$stat4_suffix = ondigital_get_option( 'hero_stat4_suffix', '%' );
$stat4_label  = ondigital_get_option( 'hero_stat4_label', 'Müştəri Məmnuniyyəti' );
?>
<section class="ond-hero">

    <!-- Left: Content -->
    <div class="ond-hero__content">

        <div class="ond-hero__badge">
            <span class="ond-hero__badge-dot"></span>
            <?php echo esc_html( $hero_badge ); ?>
        </div>

        <h1 class="ond-hero__title">
            <span class="ond-hero__title-line ond-hero__title-line--1"><?php echo esc_html( $hero_h1_line1 ); ?></span>
            <span class="ond-hero__title-line ond-hero__title-line--2">
                <span class="ond-hero__highlight"><?php echo esc_html( $hero_h1_line2 ); ?></span>
            </span>
            <span class="ond-hero__title-line ond-hero__title-line--3"><?php echo esc_html( $hero_h1_line3 ); ?></span>
        </h1>

        <p class="ond-hero__desc"><?php echo esc_html( $hero_body ); ?></p>

        <div class="ond-hero__actions">
            <a href="<?php echo esc_url( $hero_cta_url ); ?>" class="ond-hero__btn-primary">
                <?php echo esc_html( $hero_cta_text ); ?> &nbsp;→
            </a>
            <a href="<?php echo esc_url( $hero_btn2_url ); ?>" class="ond-hero__btn-secondary">
                <?php echo esc_html( $hero_btn2_text ); ?>
            </a>
            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/icon/google-partner.webp' ); ?>"
                 alt="<?php esc_attr_e( 'Google Partner', 'ondigital' ); ?>"
                 class="ond-hero__partner">
        </div>

    </div>

    <!-- Right: Animated chart card -->
    <div class="ond-hero__visual">
        <div class="ond-hero__chart-card">
            <span class="ond-hero__chart-label"><?php esc_html_e( 'Campaign Performance', 'ondigital' ); ?></span>
            <div class="ond-hero__bars">
                <div class="ond-bw ond-bw1"><div class="ond-bar ond-b1"></div></div>
                <div class="ond-bw ond-bw2"><div class="ond-bar ond-b2"></div></div>
                <div class="ond-bw ond-bw3"><div class="ond-bar ond-b3"></div></div>
                <div class="ond-bw ond-bw4"><div class="ond-bar ond-b4"></div></div>
                <div class="ond-bw ond-bw5"><div class="ond-bar ond-b5"></div></div>
            </div>
        </div>
    </div>

    <!-- Stats bar -->
    <div class="ond-hero__stats">
        <div class="ond-hero__stat">
            <div class="ond-hero__stat-num">
                <span class="ond-count" data-target="<?php echo esc_attr( $stat1_num ); ?>">0</span><sup><?php echo esc_html( $stat1_suffix ); ?></sup>
            </div>
            <div class="ond-hero__stat-label"><?php echo esc_html( $stat1_label ); ?></div>
        </div>
        <div class="ond-hero__stat">
            <div class="ond-hero__stat-num">
                <span class="ond-count" data-target="<?php echo esc_attr( $stat2_num ); ?>">0</span><sup><?php echo esc_html( $stat2_suffix ); ?></sup>
            </div>
            <div class="ond-hero__stat-label"><?php echo esc_html( $stat2_label ); ?></div>
        </div>
        <div class="ond-hero__stat">
            <div class="ond-hero__stat-num">
                <span class="ond-count" data-target="<?php echo esc_attr( $stat3_num ); ?>">0</span><sup><?php echo esc_html( $stat3_suffix ); ?></sup>
            </div>
            <div class="ond-hero__stat-label"><?php echo esc_html( $stat3_label ); ?></div>
        </div>
        <div class="ond-hero__stat">
            <div class="ond-hero__stat-num">
                <span class="ond-count" data-target="<?php echo esc_attr( $stat4_num ); ?>">0</span><sup><?php echo esc_html( $stat4_suffix ); ?></sup>
            </div>
            <div class="ond-hero__stat-label"><?php echo esc_html( $stat4_label ); ?></div>
        </div>
    </div>

</section>
