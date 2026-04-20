<?php
/**
 * Single Service template.
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'ondigital-default',        get_template_directory_uri() . '/assets/css/global.css',               array( 'bootstrap' ),            ONDIGITAL_VERSION );
    wp_enqueue_style( 'ondigital-service-single', get_template_directory_uri() . '/assets/css/pages/service-single.css', array( 'ondigital-default' ),     ONDIGITAL_VERSION );
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
    . '<p>' . __( 'Müasir rəqəmsal marketinq texniki infrastrukturun, məzmun keyfiyyətinin və istifadəçi təcrübəsinin harmonik vəhdətidir. Bizim yanaşmamız Google-un ən son alqoritmlərinə uyğun, davamlı və ölçülə bilən nəticələr üzərinde qurulub.', 'ondigital' ) . '</p>'
    . '<h3>' . __( 'Əsas üstünlüklər', 'ondigital' ) . '</h3>'
    . '<p>' . __( 'Şəffaf hesabat, aylıq KPI izləməsi və həsr edilmiş menecer — bütün bunlar standart xidmət paketimizə daxildir. Siz biznesinizə fokuslanın, qalanı bizə həvalə edin.', 'ondigital' ) . '</p>';

$steps = get_post_meta( $id, '_od_steps', true );
$steps = is_array( $steps ) ? array_values( array_filter( $steps, function( $s ) {
    return ! empty( $s['title_az'] ) || ! empty( $s['title_en'] );
} ) ) : array();

$demo_steps = array(
    array( 'title_az' => 'Kəşfiyyat və Audit',       'title_en' => 'Discovery & Audit',       'desc_az' => 'Saytınızın mövcud vəziyyətini 200+ meyar üzrə yoxlayır, texniki maneələri müəyyən edirik.',              'desc_en' => 'We audit your site across 200+ criteria and identify all technical blockers.', 'duration' => 'Həftə 1–2' ),
    array( 'title_az' => 'Strategiya və Planlaşdırma', 'title_en' => 'Strategy & Planning',    'desc_az' => 'Rəqib analizi, semantik açar söz xəritəsi və 6 aylıq böyümə yol xəritəsi hazırlayırıq.',               'desc_en' => 'Competitor analysis, semantic keyword map, and 6-month growth roadmap.', 'duration' => 'Həftə 2–3' ),
    array( 'title_az' => 'İcra və Optimallaşdırma',   'title_en' => 'Execution & Optimisation', 'desc_az' => 'Texniki düzəlişlər, məzmun strategiyası, backlink kampaniyası — hamısı paralel həyata keçirilir.',        'desc_en' => 'Technical fixes, content strategy and backlink campaign — all running in parallel.', 'duration' => 'Həftə 3–8' ),
    array( 'title_az' => 'Ölçmə və Hesabat',          'title_en' => 'Measurement & Reporting',  'desc_az' => 'Aylıq KPI hesabatı, hər dəyişikliyin təsirini real zamanda izləyir, strategiyanı tənzimləyirik.',        'desc_en' => 'Monthly KPI reporting, tracking every change in real time, iterating strategy.', 'duration' => 'Davamlı' ),
);

if ( empty( $steps ) ) {
    $steps = $demo_steps;
}

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';

$default_pricing = array(
    array(
        'name'     => __( 'Başlanğıc', 'ondigital' ),
        'price'    => '299 ₼',
        'features' => "Rəqiblərin analizi\nAylıq hesabat\n10 açar söz izləməsi\nOn-page optimallaşdırma\nGoogle My Business",
        'cta_url'  => '',
    ),
    array(
        'name'     => __( 'Biznes', 'ondigital' ),
        'price'    => '599 ₼',
        'features' => "Rəqiblərin analizi\nAylıq hesabat\n30 açar söz izləməsi\nOn-page optimallaşdırma\nAylıq 4 bloq məqaləsi\nBacklink strategiyası",
        'cta_url'  => '',
    ),
    array(
        'name'     => __( 'Korporativ', 'ondigital' ),
        'price'    => 'Fərdi',
        'features' => "Limitsiz açar sözlər\nDedikasiya edilmiş menecer\nHəftəlik brifinqlər\nBeynəlxalq SEO dəstəyi\nDedikasiya edilmiş hesabat paneli",
        'cta_url'  => '',
    ),
);
$pricing_plans = ondigital_get_repeater( 'pricing', $default_pricing );
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
                        <?php if ( ! empty( $steps ) ) : ?>
                            <a href="#ss-process" class="ss-btn-ghost">Prosesi gör</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="ss-hero-right">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'large', array( 'class' => 'ss-hero-img' ) ); ?>
                    <?php else : ?>
                        <div class="ss-hero-img-placeholder"></div>
                    <?php endif; ?>
                    <div class="ss-hero-stat-card">
                        <div class="ss-stat-num"><?php echo esc_html( $stat_number ); ?></div>
                        <div class="ss-stat-lbl"><?php echo esc_html( $stat_label ); ?></div>
                        <div class="ss-stat-bars" aria-hidden="true">
                            <span style="height:30%"></span>
                            <span style="height:50%"></span>
                            <span style="height:40%"></span>
                            <span style="height:70%"></span>
                            <span style="height:60%"></span>
                            <span style="height:85%"></span>
                            <span class="ss-bar-hi" style="height:100%"></span>
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

                <?php if ( ! empty( $features ) ) : ?>
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
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- ── 3. Process ── -->
    <?php if ( ! empty( $steps ) ) : ?>
    <section class="ss-process" id="ss-process">
        <div class="container">
            <div class="ss-process-header">
                <span class="ss-eyebrow"><?php esc_html_e( 'İş Prosesi', 'ondigital' ); ?></span>
                <h2 class="ss-section-title"><?php esc_html_e( 'Necə işləyirik', 'ondigital' ); ?></h2>
            </div>
            <div class="ss-steps">
                <?php foreach ( $steps as $i => $step ) :
                    $num   = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
                    $title = $step[ 'title_' . $lang ] ?? $step['title_az'] ?? '';
                    $desc  = $step[ 'desc_' . $lang ]  ?? $step['desc_az']  ?? '';
                    $dur   = $step['duration'] ?? '';
                ?>
                    <div class="ss-step">
                        <div class="ss-step-num"><?php echo esc_html( $num ); ?></div>
                        <div class="ss-step-line" aria-hidden="true"></div>
                        <div class="ss-step-body">
                            <h3 class="ss-step-title"><?php echo esc_html( $title ); ?></h3>
                            <?php if ( $desc ) : ?>
                                <p class="ss-step-desc"><?php echo esc_html( $desc ); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ( $dur ) : ?>
                            <div class="ss-step-dur"><?php echo esc_html( $dur ); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

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

    <!-- ── 5. Pricing ── -->
    <?php if ( ! empty( $pricing_plans ) ) : ?>
    <section class="ss-pricing">
        <div class="container">
            <div class="ss-pricing-header">
                <span class="ss-eyebrow"><?php esc_html_e( 'Qiymətlər', 'ondigital' ); ?></span>
                <h2 class="ss-section-title"><?php esc_html_e( 'Sizin üçün doğru plan', 'ondigital' ); ?></h2>
            </div>
            <div class="ss-pricing-grid">
                <?php foreach ( $pricing_plans as $pi => $plan ) :
                    $feat_text = $plan['features'] ?? '';
                    $feat_list = array_filter( array_map( 'trim', explode( "\n", $feat_text ) ) );
                    $plan_url  = ! empty( $plan['cta_url'] ) ? $plan['cta_url'] : home_url( '/elaqe/' );
                    $featured  = ( 1 === $pi );
                ?>
                    <div class="ss-plan<?php echo $featured ? ' ss-plan--featured' : ''; ?>">
                        <?php if ( $featured ) : ?>
                            <div class="ss-plan-badge"><?php esc_html_e( 'Ən Populyar', 'ondigital' ); ?></div>
                        <?php endif; ?>
                        <h3 class="ss-plan-name"><?php echo esc_html( $plan['name'] ?? '' ); ?></h3>
                        <div class="ss-plan-price"><?php echo esc_html( $plan['price'] ?? '' ); ?></div>
                        <?php if ( ! empty( $feat_list ) ) : ?>
                            <ul class="ss-plan-features">
                                <?php foreach ( $feat_list as $feat ) : ?>
                                    <li><?php echo esc_html( $feat ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( $plan_url ); ?>" class="ss-plan-btn">
                            <?php esc_html_e( 'Seç', 'ondigital' ); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── 6. Footer CTA ── -->
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
