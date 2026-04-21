<?php
/**
 * Single Service template.
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'ondigital-default',        get_template_directory_uri() . '/assets/css/global.css',               array( 'bootstrap' ),        ONDIGITAL_VERSION );
    wp_enqueue_style( 'ondigital-service-single', get_template_directory_uri() . '/assets/css/pages/service-single.css', array( 'ondigital-default' ), @filemtime( get_template_directory() . '/assets/css/pages/service-single.css' ) ?: ONDIGITAL_VERSION );
    wp_dequeue_style( 'ondigital-service-details' );
}, 99 );

get_header();
the_post();

$id      = get_the_ID();
$od_opts = get_option( 'ondigital_options', array() );
$lang    = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';

$stat_number  = get_post_meta( $id, '_service_stat_number', true ) ?: '+240%';
$stat_label   = get_post_meta( $id, '_service_stat_label',  true ) ?: 'Üzvi trafik artımı';

$hero_badge       = $od_opts[ 'service_hero_badge_' . $lang ]       ?? ( $lang === 'en' ? 'Ondigital — Service' : 'Ondigital — Xidmət' );
$hero_btn_primary = $od_opts[ 'service_hero_btn_primary_' . $lang ]  ?? ( $lang === 'en' ? 'Get Started' : 'Başlayaq' );
$hero_btn_ghost   = $od_opts[ 'service_hero_btn_ghost_' . $lang ]    ?? ( $lang === 'en' ? 'See the process' : 'Prosesi gör' );

$demo_excerpt = __( 'Biz rəqəmsal ekosisteminizi məlumatlarla idarə olunan strategiyalarla yenidən qururuq. Standart şablonlar deyil — sizin üçün xüsusi hazırlanmış texniki mükəmməllik.', 'ondigital' );

// Process: prefer _service_steps (own meta), fall back to _od_steps (shared)
$steps = get_post_meta( $id, '_service_steps', true );
if ( ! is_array( $steps ) || empty( $steps ) ) {
    $steps = get_post_meta( $id, '_od_steps', true );
}
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
                    <span class="ss-badge"><?php echo esc_html( $hero_badge ); ?></span>
                    <h1 class="ss-hero-title"><?php the_title(); ?></h1>
                    <p class="ss-hero-desc"><?php echo esc_html( get_the_excerpt() ?: $demo_excerpt ); ?></p>
                    <div class="ss-hero-btns">
                        <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="ss-btn-primary"><?php echo esc_html( $hero_btn_primary ); ?></a>
                        <a href="#ss-process" class="ss-btn-ghost"><?php echo esc_html( $hero_btn_ghost ); ?></a>
                    </div>
                </div>

                <div class="ss-hero-right">
                    <?php
                    $hero_img_id  = get_post_meta( $id, '_service_hero_image', true );
                    $hero_img_url = $hero_img_id ? wp_get_attachment_image_url( $hero_img_id, 'large' ) : '';
                    if ( $hero_img_url ) : ?>
                        <img src="<?php echo esc_url( $hero_img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="ss-hero-img">
                    <?php elseif ( has_post_thumbnail() ) : ?>
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


    <!-- ── 3. Highlights / Feature Cards ── -->
    <?php
    $hl_title = get_post_meta( $id, '_service_highlights_title', true )
        ?: __( 'Dərin Audit və Strategiya', 'ondigital' );

    $default_cards = array(
        array(
            'icon'  => 'fa-chart-line',
            'title' => __( 'Texniki Audit', 'ondigital' ),
            'desc'  => __( 'Veb saytınızın kod strukturundan, server cavab müddətinə qədər hər bir detalı 200+ faktor üzrə yoxlayırıq.', 'ondigital' ),
        ),
        array(
            'icon'  => 'fa-magnifying-glass-chart',
            'title' => __( 'Semantik Analiz', 'ondigital' ),
            'desc'  => __( 'Yalnız həcmə deyil, istifadəçi niyyətinə (Intent) fokuslanan semantik açar söz xəritəsi hazırlayırıq.', 'ondigital' ),
        ),
        array(
            'icon'  => 'fa-route',
            'title' => __( 'Böyümə Xəritəsi', 'ondigital' ),
            'desc'  => __( 'Növbəti 6–12 ay üçün aylıq hədəfləri və KPI-ları müəyyən edən strateji yol xəritəsi təqdim edirik.', 'ondigital' ),
        ),
    );

    $hl_cards = array();
    for ( $ci = 1; $ci <= 3; $ci++ ) {
        $t = get_post_meta( $id, "_service_card_{$ci}_title", true );
        $d = get_post_meta( $id, "_service_card_{$ci}_desc",  true );
        $ic = get_post_meta( $id, "_service_card_{$ci}_icon", true );
        if ( $t || $d ) {
            $hl_cards[] = array(
                'icon'  => $ic ?: $default_cards[ $ci - 1 ]['icon'],
                'title' => $t  ?: $default_cards[ $ci - 1 ]['title'],
                'desc'  => $d  ?: $default_cards[ $ci - 1 ]['desc'],
            );
        }
    }
    if ( empty( $hl_cards ) ) {
        $hl_cards = $default_cards;
    }
    ?>
    <section class="ss-highlights">
        <div class="container">
            <div class="ss-hl-header">
                <h2 class="ss-hl-title"><?php echo esc_html( $hl_title ); ?></h2>
                <div class="ss-hl-line"></div>
            </div>
            <div class="ss-hl-grid">
                <?php foreach ( $hl_cards as $ci => $card ) : ?>
                    <div class="ss-hl-card" style="--ss-delay:<?php echo esc_attr( $ci * 120 ); ?>ms">
                        <div class="ss-hl-icon-wrap">
                            <i class="fa-solid <?php echo esc_attr( $card['icon'] ); ?>"></i>
                        </div>
                        <h3 class="ss-hl-card-title"><?php echo esc_html( $card['title'] ); ?></h3>
                        <p class="ss-hl-card-desc"><?php echo esc_html( $card['desc'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script>
    (function(){
        var cards = document.querySelectorAll('.ss-hl-card');
        if (!cards.length || !('IntersectionObserver' in window)) {
            cards.forEach(function(c){ c.classList.add('ss-in'); });
            return;
        }
        var obs = new IntersectionObserver(function(entries){
            entries.forEach(function(e){
                if (e.isIntersecting) {
                    var delay = e.target.style.getPropertyValue('--ss-delay') || '0ms';
                    setTimeout(function(){ e.target.classList.add('ss-in'); }, parseInt(delay));
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.15 });
        cards.forEach(function(c){ obs.observe(c); });
    })();
    </script>

    <!-- ── 4. What's Included + Monthly Roadmap ── -->
    <section class="wi-section">
        <div class="container">
            <?php
            $wi_title       = get_post_meta( $id, '_service_wi_title',       true ) ?: __( 'Nə daxildir', 'ondigital' );
            $wi_header_desc = get_post_meta( $id, '_service_wi_header_desc', true ) ?: __( 'Hər paketdə nələrin olduğunu və aylıq yol xəritəsini aşağıda görə bilərsiniz.', 'ondigital' );
            ?>
            <div class="wi-header">
                <div>
                    <span class="cs-eyebrow"><?php esc_html_e( 'Xidmət paketi', 'ondigital' ); ?></span>
                    <h2 class="wi-title"><?php echo esc_html( $wi_title ); ?></h2>
                </div>
                <p class="wi-header-desc"><?php echo esc_html( $wi_header_desc ); ?></p>
            </div>
            <div class="wi-tabs">
                <button class="wi-tab active" data-tab="included">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    <?php esc_html_e( 'Nə daxildir', 'ondigital' ); ?>
                </button>
                <button class="wi-tab" data-tab="roadmap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <?php esc_html_e( 'Aylıq yol xəritəsi', 'ondigital' ); ?>
                </button>
            </div>

            <!-- Pane: Nə daxildir -->
            <div class="wi-pane active" data-tab="included">
                <div class="wi-accord">
                    <?php
                    $wi_items_raw = get_post_meta( $id, '_service_wi_items', true );
                    $wi_items = ( is_array( $wi_items_raw ) && ! empty( $wi_items_raw[0]['title'] ) )
                        ? array_filter( $wi_items_raw, fn($x) => ! empty( $x['title'] ) )
                        : array(
                            array( 'title' => 'Texniki SEO Auditi',        'desc' => 'Saytınızın bütün texniki aspektlərini — sürət, indeksləmə, strukturlaşdırılmış data, mobil uyğunluq — ətraflı yoxlayır, prioritetli düzəliş planı hazırlayırıq.' ),
                            array( 'title' => 'Semantik Açar Söz Xəritəsi','desc' => 'Yalnız həcmə deyil, istifadəçi niyyətinə (Intent) fokuslanmış açar söz tədqiqatı aparır, hər səhifə üçün spesifik hədəf açar söz qrupları müəyyən edirik.' ),
                            array( 'title' => 'On-Page Optimallaşdırma',   'desc' => 'Başlıqlar, meta təsvirlər, daxili linklər, şəkil alt teqləri — hər bir elementi SEO standartlarına uyğun optimallaşdırırıq.' ),
                            array( 'title' => 'Məzmun Strategiyası',        'desc' => 'Hər ay saytınızın avtoritetini artıracaq, hədəf auditoriyanızı cəlb edəcək peşəkar məzmun planı hazırlayır, icra edirik.' ),
                            array( 'title' => 'Backlink Kampaniyası',       'desc' => 'Keyfiyyətli, tematik uyğun saytlardan natural backlink profili quraraq domeninizin avtoritetini artırırıq.' ),
                            array( 'title' => 'Aylıq Performans Hesabatı', 'desc' => 'KPI-lar, trafik dinamikası, sıralama dəyişiklikləri — hər şey şəffaf şəkildə aylıq hesabat formatında təqdim edilir.' ),
                        );
                    $wi_items = array_values( $wi_items );
                    foreach ( $wi_items as $wi_i => $wi_item ) : ?>
                        <div class="wi-row<?php echo $wi_i === 0 ? ' open' : ''; ?>">
                            <button class="wi-row-btn" type="button">
                                <span class="wi-row-num"><?php echo str_pad( $wi_i + 1, 2, '0', STR_PAD_LEFT ); ?></span>
                                <span class="wi-row-title"><?php echo esc_html( $wi_item['title'] ); ?></span>
                                <span class="wi-row-chevron">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                                </span>
                            </button>
                            <div class="wi-row-body"<?php echo $wi_i === 0 ? ' style="max-height:500px"' : ''; ?>>
                                <div class="wi-row-body-inner">
                                    <p class="wi-body-desc"><?php echo esc_html( $wi_item['desc'] ); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Pane: Aylıq yol xəritəsi -->
            <div class="wi-pane" data-tab="roadmap">
                <div class="wi-accord">
                    <?php
                    $rm_items_raw = get_post_meta( $id, '_service_rm_items', true );
                    $rm_items = ( is_array( $rm_items_raw ) && ! empty( $rm_items_raw[0]['title'] ) )
                        ? array_filter( $rm_items_raw, fn($x) => ! empty( $x['title'] ) )
                        : array(
                            array( 'title' => '1–2-ci Həftə — Audit və Kəşfiyyat',     'desc' => 'Texniki audit, rəqib analizi və saytın mövcud vəziyyətinin qiymətləndirilməsi. Texniki problemlərin prioritet siyahısı hazırlanır.',                                                    'prog' => '15%'  ),
                            array( 'title' => '3–4-cü Həftə — Strategiya',              'desc' => 'Açar söz xəritəsi, məzmun boşluqlarının analizi və 6 aylıq böyümə yol xəritəsinin hazırlanması.',                                                                                        'prog' => '30%'  ),
                            array( 'title' => '2–3-cü Ay — İcra',                       'desc' => 'Texniki düzəlişlər, on-page optimallaşdırma, ilk məzmun vahidlərinin yayımlanması. İlk nəticələr görünməyə başlayır.',                                                                   'prog' => '55%'  ),
                            array( 'title' => '4–5-ci Ay — Güclənmə',                   'desc' => 'Backlink kampaniyasının tam sürətlə işə salınması, məzmun həcminin artırılması, texniki optimallaşdırmanın davam etdirilməsi.',                                                          'prog' => '75%'  ),
                            array( 'title' => '6-cı Ay — Ölçmə və Miqyaslandırma',      'desc' => 'KPI-ların qiymətləndirilməsi, uğurlu strategiyaların miqyaslandırılması, növbəti 6 ay üçün yenilənmiş yol xəritəsinin hazırlanması.',                                                  'prog' => '100%' ),
                        );
                    $rm_items = array_values( $rm_items );
                    foreach ( $rm_items as $rm_i => $rm_item ) : ?>
                        <div class="wi-row<?php echo $rm_i === 0 ? ' open' : ''; ?>">
                            <button class="wi-row-btn" type="button">
                                <span class="wi-row-num"><?php echo str_pad( $rm_i + 1, 2, '0', STR_PAD_LEFT ); ?></span>
                                <span class="wi-row-title"><?php echo esc_html( $rm_item['title'] ); ?></span>
                                <span class="wi-row-chevron">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                                </span>
                            </button>
                            <div class="wi-row-body"<?php echo $rm_i === 0 ? ' style="max-height:500px"' : ''; ?>>
                                <div class="wi-row-body-inner roadmap">
                                    <p class="wi-body-desc"><?php echo esc_html( $rm_item['desc'] ); ?></p>
                                    <div class="wi-prog-wrap">
                                        <span class="wi-prog-label"><?php esc_html_e( 'Tamamlanma hədəfi', 'ondigital' ); ?></span>
                                        <span class="wi-prog-pct"><?php echo esc_html( $rm_item['prog'] ); ?></span>
                                        <div class="wi-prog-bar">
                                            <div class="wi-prog-fill" style="--prog:<?php echo esc_attr( $rm_item['prog'] ); ?>"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <script>
    (function(){
        // Tab switcher
        var tabs = document.querySelectorAll('.wi-tab');
        var panes = document.querySelectorAll('.wi-pane');
        tabs.forEach(function(tab){
            tab.addEventListener('click', function(){
                var t = this.dataset.tab;
                tabs.forEach(function(x){ x.classList.remove('active'); });
                panes.forEach(function(x){ x.classList.remove('active'); });
                this.classList.add('active');
                document.querySelector('.wi-pane[data-tab="'+t+'"]').classList.add('active');
            });
        });
        // Accordion — open first row bodies on init
        document.querySelectorAll('.wi-row.open').forEach(function(row){
            var body = row.querySelector('.wi-row-body');
            if (body && !body.style.maxHeight) body.style.maxHeight = body.scrollHeight + 'px';
        });
        // Accordion click
        document.querySelectorAll('.wi-row-btn').forEach(function(btn){
            btn.addEventListener('click', function(){
                var row = this.closest('.wi-row');
                var body = row.querySelector('.wi-row-body');
                var isOpen = row.classList.contains('open');
                var pane = this.closest('.wi-pane');
                pane.querySelectorAll('.wi-row.open').forEach(function(r){
                    r.classList.remove('open');
                    r.querySelector('.wi-row-body').style.maxHeight = '0';
                });
                if (!isOpen) {
                    row.classList.add('open');
                    body.style.maxHeight = body.scrollHeight + 'px';
                }
            });
        });
    })();
    </script>

    <!-- ── 5. Process ── -->
    <section class="ss-process" id="ss-process">
        <div class="container">
            <div class="ss-process-header">
                <?php
                $process_eyebrow = get_post_meta( $id, '_service_process_eyebrow', true ) ?: __( 'İş Prosesi', 'ondigital' );
                $process_heading = get_post_meta( $id, '_service_process_heading', true ) ?: __( 'Necə işləyirik', 'ondigital' );
                ?>
                <span class="ss-eyebrow"><?php echo esc_html( $process_eyebrow ); ?></span>
                <h2 class="ss-process-heading"><?php echo esc_html( $process_heading ); ?></h2>
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

    <!-- ── 6. Who Is This For ── -->
    <?php
    $wif_title = get_post_meta( $id, '_service_wif_title', true ) ?: __( 'Bu xidmət kimə uyğundur?', 'ondigital' );
    $wif_sub   = get_post_meta( $id, '_service_wif_sub',   true ) ?: __( 'Hər xidmət hər kəs üçün deyil. Aşağıda bu xidmətin kimin üçün uyğun, kimin üçün uyğun olmadığını göstəririk.', 'ondigital' );

    $wif_for_raw = get_post_meta( $id, '_service_wif_for_items', true );
    $wif_for = ( is_array( $wif_for_raw ) && ! empty( $wif_for_raw[0]['title'] ) )
        ? array_filter( $wif_for_raw, fn($x) => ! empty( $x['title'] ) )
        : array(
            array( 'title' => 'Üzvi trafikini artırmaq istəyənlər',   'desc' => 'Ödənişli reklamlara bağlı qalmadan saytına sabit, uzunmüddətli trafik axını qurmaq istəyən bizneslər.' ),
            array( 'title' => 'Yeni sayt açan şirkətlər',              'desc' => 'Sayt açılışından etibarən düzgün texniki baza üzərində böyümək istəyən startaplar və bizneslər.' ),
            array( 'title' => 'Rəqabətli bazarda öndə olmaq istəyənlər','desc' => 'Güclü rəqibləri olan sektorda axtarış nəticələrinin birinci səhifəsinə çıxmağı hədəfləyənlər.' ),
            array( 'title' => 'Davamlı böyümə istəyənlər',             'desc' => '6–12 aylıq perspektivdə ölçülə bilən nəticə əldə etmək üçün strateji investisiya etməyə hazır olanlar.' ),
        );

    $wif_not_raw = get_post_meta( $id, '_service_wif_not_items', true );
    $wif_not = ( is_array( $wif_not_raw ) && ! empty( $wif_not_raw[0]['title'] ) )
        ? array_filter( $wif_not_raw, fn($x) => ! empty( $x['title'] ) )
        : array(
            array( 'title' => 'Bir həftə ərzində nəticə gözləyənlər', 'desc' => 'SEO bir sprint deyil, maraton. Ani nəticə gözləntiləri olan bizneslər üçün uyğun deyil.' ),
            array( 'title' => 'Yalnız reklama investisiya etmək istəyənlər', 'desc' => 'Yalnız ödənişli trafik istəyirsinizsə, PPC xidmətimiз daha uyğun ola bilər.' ),
            array( 'title' => 'Saytını heç vaxt yeniləmək istəməyənlər','desc' => 'Texniki tövsiyələri tətbiq etməyə hazır olmayan bizneslər SEO-dan lazımi nəticəni ala bilmir.' ),
        );
    ?>
    <section class="wif-section">
        <div class="container">
            <div class="wif-header">
                <div>
                    <span class="cs-eyebrow"><?php esc_html_e( 'Hədəf auditoriya', 'ondigital' ); ?></span>
                    <h2 class="wif-title"><?php echo esc_html( $wif_title ); ?></h2>
                </div>
                <p class="wif-header-sub"><?php echo esc_html( $wif_sub ); ?></p>
            </div>
            <div class="wif-cols">
                <div class="wif-col wif-col--for">
                    <div class="wif-col-inner">
                        <div class="wif-col-header">
                            <span class="wif-col-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            <span class="wif-col-label"><?php esc_html_e( 'Bu xidmət sizin üçündür', 'ondigital' ); ?></span>
                        </div>
                        <ul class="wif-list">
                            <?php foreach ( $wif_for as $item ) : ?>
                            <li class="wif-item">
                                <span class="wif-item-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                </span>
                                <div>
                                    <div class="wif-item-title"><?php echo esc_html( $item['title'] ); ?></div>
                                    <?php if ( ! empty( $item['desc'] ) ) : ?>
                                    <div class="wif-item-desc"><?php echo esc_html( $item['desc'] ); ?></div>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="wif-col wif-col--not">
                    <div class="wif-col-inner">
                        <div class="wif-col-header">
                            <span class="wif-col-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </span>
                            <span class="wif-col-label"><?php esc_html_e( 'Bu xidmət sizin üçün deyil', 'ondigital' ); ?></span>
                        </div>
                        <ul class="wif-list">
                            <?php foreach ( $wif_not as $item ) : ?>
                            <li class="wif-item">
                                <span class="wif-item-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </span>
                                <div>
                                    <div class="wif-item-title"><?php echo esc_html( $item['title'] ); ?></div>
                                    <?php if ( ! empty( $item['desc'] ) ) : ?>
                                    <div class="wif-item-desc"><?php echo esc_html( $item['desc'] ); ?></div>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="wif-note"><?php esc_html_e( 'Əmin deyilsiniz?', 'ondigital' ); ?> <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>"><?php esc_html_e( 'Pulsuz məsləhət alın', 'ondigital' ); ?></a> <?php esc_html_e( '— vəziyyətinizi birlikdə qiymətləndirək.', 'ondigital' ); ?></p>
        </div>
    </section>

    <!-- ── 7. Glossary ── -->
    <?php
    $gl_title       = get_post_meta( $id, '_service_gl_title',       true ) ?: __( 'Lüğət', 'ondigital' );
    $gl_header_desc = get_post_meta( $id, '_service_gl_header_desc', true ) ?: __( 'Bu xidmətlə bağlı tez-tez rast gəlinən terminlərin qısa izahı.', 'ondigital' );

    $gl_terms_raw = get_post_meta( $id, '_service_gl_terms', true );
    $gl_terms = ( is_array( $gl_terms_raw ) && ! empty( $gl_terms_raw[0]['word'] ) )
        ? array_filter( $gl_terms_raw, fn($x) => ! empty( $x['word'] ) )
        : array(
            array( 'word' => 'Üzvi Trafik',         'def' => 'Ödənişli reklamlar olmadan, axtarış motorlarından gələn ziyarətçi axını.' ),
            array( 'word' => 'Açar Söz (Keyword)',   'def' => 'İstifadəçilərin axtarış motorlarında daxil etdiyi söz və ifadələr.' ),
            array( 'word' => 'On-Page SEO',          'def' => 'Sayt daxilindəki məzmun, başlıqlar, meta teqlər kimi elementlərin optimallaşdırılması.' ),
            array( 'word' => 'Backlink',             'def' => 'Başqa saytlardan sizin saytınıza yönləndirilən keçidlər — axtarış motorları üçün etimad siqnalı.' ),
            array( 'word' => 'Domain Authority (DA)','def' => 'Domenin axtarış motorlarında nə qədər etibarlı hesab edildiyini göstərən 1–100 arası xal.' ),
            array( 'word' => 'SERP',                 'def' => 'Search Engine Results Page — axtarış nəticələri səhifəsi.' ),
            array( 'word' => 'Crawl Budget',         'def' => 'Axtarış motorunun robotu tərəfindən müəyyən müddətdə indekslənəcək səhifə sayı.' ),
            array( 'word' => 'Core Web Vitals',      'def' => 'Google-un sayt sürəti və istifadəçi təcrübəsini ölçmək üçün istifadə etdiyi texniki metriklər toplusu.' ),
        );
    ?>
    <section class="gl-section">
        <div class="container">
            <div class="gl-header">
                <div>
                    <span class="cs-eyebrow"><?php esc_html_e( 'Terminlər', 'ondigital' ); ?></span>
                    <h2 class="gl-title"><?php echo esc_html( $gl_title ); ?></h2>
                </div>
                <p class="gl-header-desc"><?php echo esc_html( $gl_header_desc ); ?></p>
            </div>
            <div class="gl-grid">
                <?php foreach ( $gl_terms as $term ) : ?>
                <div class="gl-term">
                    <div class="gl-term-word"><?php echo esc_html( $term['word'] ); ?></div>
                    <p class="gl-term-def"><?php echo esc_html( $term['def'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ── 4. Mid CTA ── -->
    <?php $mid_cta_title = get_post_meta( $id, '_service_mid_cta_title', true ) ?: __( 'Saytınızın potensialını öyrənməyə hazırsınız?', 'ondigital' ); ?>
    <section class="ss-mid-cta">
        <div class="container">
            <div class="ss-mid-cta-inner">
                <h2 class="ss-mid-cta-title"><?php echo esc_html( $mid_cta_title ); ?></h2>
                <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="ss-mid-cta-btn">
                    <?php esc_html_e( 'Pulsuz Konsultasiya Al', 'ondigital' ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- ── 5. Footer CTA ── -->
    <?php
    $footer_cta_title = get_post_meta( $id, '_service_footer_cta_title', true ) ?: __( 'Layihənizi birlikdə qurmağa hazırıq', 'ondigital' );
    $footer_cta_sub   = get_post_meta( $id, '_service_footer_cta_sub',   true ) ?: __( 'Bizimlə əlaqə saxlayın, pulsuz məsləhət alın.', 'ondigital' );
    ?>
    <section class="ss-footer-cta">
        <div class="container">
            <div class="ss-footer-cta-card">
                <p class="ss-footer-cta-eyebrow"><?php esc_html_e( 'Növbəti addım', 'ondigital' ); ?></p>
                <h2 class="ss-footer-cta-title"><?php echo esc_html( $footer_cta_title ); ?></h2>
                <p class="ss-footer-cta-sub"><?php echo esc_html( $footer_cta_sub ); ?></p>
                <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="ss-btn-primary">
                    <?php esc_html_e( 'Əlaqəyə Keç', 'ondigital' ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- ── 9. FAQ ── -->
    <?php
    $faq_panel_title = get_post_meta( $id, '_service_faq_panel_title', true ) ?: __( 'Tez-tez soruşulan suallar', 'ondigital' );
    $faq_panel_desc  = get_post_meta( $id, '_service_faq_panel_desc',  true ) ?: __( 'Bu xidmətlə bağlı ən çox gələn suallara cavabları burada tapa bilərsiniz.', 'ondigital' );

    $faq_items_raw = get_post_meta( $id, '_service_faq_items', true );
    $faq_items = ( is_array( $faq_items_raw ) && ! empty( $faq_items_raw[0]['q'] ) )
        ? array_filter( $faq_items_raw, fn($x) => ! empty( $x['q'] ) )
        : array(
            array( 'q' => 'Nə qədər müddətdə nəticə görəcəm?',               'a' => 'SEO uzunmüddətli bir investisiyadır. İlk əhəmiyyətli nəticələr adətən 3–4 ayda görünür. Davamlı, güclü nəticələr isə 6–12 ay ərzində özünü göstərir.' ),
            array( 'q' => 'Aylıq ödəniş nəyi əhatə edir?',                    'a' => 'Texniki audit, açar söz tədqiqatı, on-page optimallaşdırma, məzmun strategiyası, backlink kampaniyası və aylıq hesabat standart paketə daxildir.' ),
            array( 'q' => 'Hansı hesabatlılıq mexanizmini istifadə edirsiniz?', 'a' => 'Hər ay ətraflı KPI hesabatı — trafik dinamikası, sıralama dəyişiklikləri, backlink profili — Google Analytics və Search Console məlumatları əsasında hazırlanır.' ),
            array( 'q' => 'Sayt dili AZ olmalıdır?',                           'a' => 'Xeyr. AZ, RU, EN — istənilən dildə sayt üçün SEO xidməti göstəririk. Çoxdilli saytlar üçün ayrıca strategiya hazırlayırıq.' ),
            array( 'q' => 'Mövcud saytım varsa nə etməliyəm?',                'a' => 'Heç bir şey. Biz saytınızı audit edib mövcud vəziyyəti qiymətləndirir, sonra prioritet siyahısı hazırlayırıq. Yeni sayt tələb olunmur.' ),
        );
    ?>
    <section class="faq-section">
        <div class="container">
            <div class="faq-panel">
                <span class="cs-eyebrow"><?php esc_html_e( 'FAQ', 'ondigital' ); ?></span>
                <h2 class="faq-panel-title"><?php echo esc_html( $faq_panel_title ); ?></h2>
                <p class="faq-panel-desc"><?php echo esc_html( $faq_panel_desc ); ?></p>
                <a href="<?php echo esc_url( home_url( '/elaqe/' ) ); ?>" class="faq-panel-cta">
                    <?php esc_html_e( 'Sualınız var?', 'ondigital' ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
            <div class="faq-list">
                <?php foreach ( $faq_items as $fi => $item ) : ?>
                <div class="faq-item<?php echo $fi === 0 ? ' open' : ''; ?>">
                    <button class="faq-q" type="button">
                        <span class="faq-q-text"><?php echo esc_html( $item['q'] ); ?></span>
                        <span class="faq-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </span>
                    </button>
                    <div class="faq-a"<?php echo $fi === 0 ? ' style="max-height:500px"' : ''; ?>>
                        <div class="faq-a-inner"><?php echo esc_html( $item['a'] ); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script>
    (function(){
        document.querySelectorAll('.faq-q').forEach(function(btn){
            btn.addEventListener('click', function(){
                var item = this.closest('.faq-item');
                var ans  = item.querySelector('.faq-a');
                var isOpen = item.classList.contains('open');
                document.querySelectorAll('.faq-item.open').forEach(function(el){
                    el.classList.remove('open');
                    el.querySelector('.faq-a').style.maxHeight = '0';
                });
                if (!isOpen) {
                    item.classList.add('open');
                    ans.style.maxHeight = ans.scrollHeight + 'px';
                }
            });
        });
    })();
    </script>

</div>
<?php get_footer();
