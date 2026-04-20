<?php
/**
 * Single Service template.
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'ondigital-default',        get_template_directory_uri() . '/assets/css/global.css',               array( 'bootstrap' ),        ONDIGITAL_VERSION );
    wp_enqueue_style( 'ondigital-service-single', get_template_directory_uri() . '/assets/css/pages/service-single.css', array( 'ondigital-default' ), ONDIGITAL_VERSION );
    wp_dequeue_style( 'ondigital-service-details' );
}, 99 );

get_header();
the_post();

$id           = get_the_ID();
$stat_number  = get_post_meta( $id, '_service_stat_number', true ) ?: '+240%';
$stat_label   = get_post_meta( $id, '_service_stat_label',  true ) ?: 'Üzvi trafik artımı';

$features_raw = get_post_meta( $id, '_service_features', true );
$features     = $features_raw
    ? array_filter( array_map( 'trim', explode( "\n", $features_raw ) ) )
    : array(
        'Rəqib analizi və bazar araşdırması',
        'Texniki audit (200+ yoxlama meyarı)',
        'Semantik açar söz xəritəsi',
        'Aylıq performans hesabatı',
        'On-page optimallaşdırma',
        'Backlink strategiyası',
        'Google My Business idarəetməsi',
        'Aylıq 2 görüntülü brifinq',
    );

$demo_excerpt = __( 'Biz rəqəmsal ekosisteminizi məlumatlarla idarə olunan strategiyalarla yenidən qururuq. Standart şablonlar deyil — sizin üçün xüsusi hazırlanmış texniki mükəmməllik.', 'ondigital' );

$demo_content = '<p>' . __( 'Ondigital olaraq hər xidməti müştərinin konkret biznes məqsədlərinə uyğun olaraq hazırlayırıq. Biz yalnız nəticəyə fokuslanırıq — görünürlük, trafik və gəlir artımı.', 'ondigital' ) . '</p>'
    . '<p>' . __( 'Hər bir layihəmizdə dərin data analitikasından istifadə edərək rəqiblərinizin zəif nöqtələrini aşkar edir və sizin üstünlüklərinizi maksimuma çatdırırıq. Bakıdan dünyaya açılan rəqəmsal qapınız bizik.', 'ondigital' ) . '</p>'
    . '<h2>' . __( 'Niyə Ondigital?', 'ondigital' ) . '</h2>'
    . '<p>' . __( 'Müasir rəqəmsal marketinq texniki infrastrukturun, məzmun keyfiyyətinin və istifadəçi təcrübəsinin harmonik vəhdətidir. Bizim yanaşmamız Google-un ən son alqoritmlərinə uyğun, davamlı və ölçülə bilən nəticələr üzərində qurulub.', 'ondigital' ) . '</p>'
    . '<h3>' . __( 'Əsas üstünlüklər', 'ondigital' ) . '</h3>'
    . '<p>' . __( 'Şəffaf hesabat, aylıq KPI izləməsi və həsr edilmiş menecer — bütün bunlar standart xidmət paketimizə daxildir. Siz biznesinizə fokuslanın, qalanı bizə həvalə edin.', 'ondigital' ) . '</p>';

$steps = get_post_meta( $id, '_od_steps', true );
$steps = is_array( $steps ) ? array_values( array_filter( $steps, function( $s ) {
    return ! empty( $s['title_az'] ) || ! empty( $s['title_en'] );
} ) ) : array();

if ( empty( $steps ) ) {
    $steps = array(
        array( 'title_az' => 'Kəşfiyyat və Audit',        'title_en' => 'Discovery & Audit',        'desc_az' => 'Saytınızın mövcud vəziyyətini 200+ meyar üzrə yoxlayır, texniki maneələri müəyyən edirik.',                     'desc_en' => 'We audit your site across 200+ criteria and identify all technical blockers.',              'duration' => 'Həftə 1–2' ),
        array( 'title_az' => 'Strategiya və Planlaşdırma', 'title_en' => 'Strategy & Planning',       'desc_az' => 'Rəqib analizi, semantik açar söz xəritəsi və 6 aylıq böyümə yol xəritəsi hazırlayırıq.',                     'desc_en' => 'Competitor analysis, semantic keyword map, and a 6-month growth roadmap.',                  'duration' => 'Həftə 2–3' ),
        array( 'title_az' => 'İcra və Optimallaşdırma',   'title_en' => 'Execution & Optimisation',  'desc_az' => 'Texniki düzəlişlər, məzmun strategiyası, backlink kampaniyası — hamısı paralel həyata keçirilir.',             'desc_en' => 'Technical fixes, content strategy and backlink campaign — all running in parallel.',        'duration' => 'Həftə 3–8' ),
        array( 'title_az' => 'Ölçmə və Hesabat',          'title_en' => 'Measurement & Reporting',   'desc_az' => 'Aylıq KPI hesabatı, hər dəyişikliyin təsirini real zamanda izləyir, strategiyanı tənzimləyirik.',             'desc_en' => 'Monthly KPI reporting, tracking every change in real time and iterating the strategy.',    'duration' => 'Davamlı'   ),
    );
}

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';

$icons = array(
    '<svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
    '<svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>',
    '<svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>',
    '<svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
);
?>
<style>
html { scroll-behavior: auto !important; overflow: auto !important; height: auto !important; }
body { overflow: auto !important; height: auto !important; }
#smooth-wrapper, #smooth-content { overflow: visible !important; position: static !important; height: auto !important; transform: none !important; will-change: auto !important; }
</style>

<div class="ss-wrap">

    <!-- ── 1. Hero ── -->
    <section class="ss-hero">
        <div class="container">
            <div class="ss-hero-inner">

                <div class="ss-hero-left">
                    <span class="ss-badge">Ondigital — Xidmət</span>
                    <h1 class="ss-hero-title"><?php the_title(); ?></h1>
                    <p class="ss-hero-desc"><?php echo esc_html( get_the_excerpt() ?: $demo_excerpt ); ?></p>
                    <div class="ss-hero-btns">
                        <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="ss-btn-primary">Başlayaq</a>
                        <a href="#ss-process" class="ss-btn-ghost">Prosesi gör</a>
                    </div>
                </div>

                <div class="ss-hero-right">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'large', array( 'class' => 'ss-hero-img' ) ); ?>
                    <?php else : ?>
                        <div class="ss-hero-img-placeholder"></div>
                    <?php endif; ?>
                    <div class="ss-hero-stat-card">
                        <div class="ss-stat-icon">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                        <div class="ss-stat-text">
                            <div class="ss-stat-lbl"><?php echo esc_html( $stat_label ); ?></div>
                            <div class="ss-stat-num"><?php echo esc_html( $stat_number ); ?></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── 2. Overview ── -->
    <section class="ss-overview">
        <div class="container">
            <div class="ss-overview-inner">

                <div class="ss-overview-content">
                    <?php
                    $raw = get_the_content();
                    if ( $raw ) {
                        the_content();
                    } else {
                        echo wp_kses_post( $demo_content );
                    }
                    ?>
                </div>

                <div class="ss-overview-aside">
                    <div class="ss-features-card">
                        <h3 class="ss-features-title"><?php esc_html_e( 'Nə əldə edirsiniz', 'ondigital' ); ?></h3>
                        <ul class="ss-features-list">
                            <?php foreach ( $features as $feature ) : ?>
                                <li><?php echo esc_html( $feature ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="ss-features-cta">
                            <?php esc_html_e( 'Pulsuz məsləhət al', 'ondigital' ); ?>
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── 3. Process ── -->
    <section class="ss-process" id="ss-process">
        <div class="container">
            <div class="ss-process-header">
                <span class="ss-eyebrow"><?php esc_html_e( 'İş Prosesi', 'ondigital' ); ?></span>
                <h2 class="ss-process-heading"><?php esc_html_e( 'Necə işləyirik', 'ondigital' ); ?></h2>
            </div>
            <div class="cs-steps">
                <?php foreach ( $steps as $i => $step ) :
                    $num   = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
                    $icon  = $icons[ $i % count( $icons ) ];
                    $title = $step[ 'title_' . $lang ] ?? $step['title_az'] ?? '';
                    $desc  = $step[ 'desc_' . $lang ]  ?? $step['desc_az']  ?? '';
                    $dur   = $step['duration'] ?? '';
                ?>
                    <div class="cs-step">
                        <div class="cs-step-n"><?php echo esc_html( $num ); ?></div>
                        <div class="cs-step-connector"></div>
                        <div class="cs-step-icon"><?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
                        <div class="cs-step-body">
                            <div class="cs-step-title"><?php echo esc_html( $title ); ?></div>
                            <?php if ( $desc ) : ?>
                                <div class="cs-step-desc"><?php echo esc_html( $desc ); ?></div>
                            <?php endif; ?>
                        </div>
                        <?php if ( $dur ) : ?>
                            <div class="cs-step-dur"><?php echo esc_html( $dur ); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── 4. Mid CTA ── -->
    <section class="ss-mid-cta">
        <div class="container">
            <div class="ss-mid-cta-inner">
                <h2 class="ss-mid-cta-title"><?php esc_html_e( 'Saytınızın potensialını öyrənməyə hazırsınız?', 'ondigital' ); ?></h2>
                <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="ss-mid-cta-btn">
                    <?php esc_html_e( 'Pulsuz Konsultasiya Al', 'ondigital' ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- ── 5. Footer CTA ── -->
    <section class="ss-footer-cta">
        <div class="container">
            <div class="ss-footer-cta-card">
                <p class="ss-footer-cta-eyebrow"><?php esc_html_e( 'Növbəti addım', 'ondigital' ); ?></p>
                <h2 class="ss-footer-cta-title"><?php esc_html_e( 'Layihənizi birlikdə qurmağa hazırıq', 'ondigital' ); ?></h2>
                <p class="ss-footer-cta-sub"><?php esc_html_e( 'Bizimlə əlaqə saxlayın, pulsuz məsləhət alın.', 'ondigital' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="ss-btn-primary">
                    <?php esc_html_e( 'Əlaqəyə Keç', 'ondigital' ); ?>
                </a>
            </div>
        </div>
    </section>

</div>
<?php get_footer();
