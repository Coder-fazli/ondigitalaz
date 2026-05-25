<?php
/**
 * OnDigital — Sözlük (Glossary) CPT + Taxonomy
 *
 * CPT   : od_glossary
 * Tax   : glossary_cat
 * Slug  : sozluk / sozluk-cat
 *
 * @package OnDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =============================================================================
// Register CPT
// =============================================================================

add_action( 'init', 'ondigital_register_glossary_cpt' );
function ondigital_register_glossary_cpt(): void {
    $labels = array(
        'name'               => __( 'Sözlük', 'ondigital' ),
        'singular_name'      => __( 'Termin', 'ondigital' ),
        'menu_name'          => __( 'Sözlük', 'ondigital' ),
        'add_new'            => __( 'Yeni termin', 'ondigital' ),
        'add_new_item'       => __( 'Yeni termin əlavə et', 'ondigital' ),
        'edit_item'          => __( 'Termini redaktə et', 'ondigital' ),
        'new_item'           => __( 'Yeni termin', 'ondigital' ),
        'view_item'          => __( 'Termini gör', 'ondigital' ),
        'search_items'       => __( 'Termin axtar', 'ondigital' ),
        'not_found'          => __( 'Termin tapılmadı', 'ondigital' ),
        'not_found_in_trash' => __( 'Zibildə termin yoxdur', 'ondigital' ),
    );

    register_post_type( 'od_glossary', array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_menu'       => true,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'dictionary', 'with_front' => false ),
        'show_in_rest'       => true,
    ) );
}

// =============================================================================
// Register Taxonomy
// =============================================================================

add_action( 'init', 'ondigital_register_glossary_taxonomy' );
function ondigital_register_glossary_taxonomy(): void {
    $labels = array(
        'name'              => __( 'Kateqoriyalar', 'ondigital' ),
        'singular_name'     => __( 'Kateqoriya', 'ondigital' ),
        'search_items'      => __( 'Kateqoriya axtar', 'ondigital' ),
        'all_items'         => __( 'Bütün kateqoriyalar', 'ondigital' ),
        'edit_item'         => __( 'Kateqoriyanı redaktə et', 'ondigital' ),
        'add_new_item'      => __( 'Yeni kateqoriya', 'ondigital' ),
        'menu_name'         => __( 'Kateqoriyalar', 'ondigital' ),
    );

    register_taxonomy( 'glossary_cat', 'od_glossary', array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'sozluk-cat', 'with_front' => false ),
    ) );
}

// =============================================================================
// Polylang — register CPT and taxonomy as translatable
// =============================================================================

add_filter( 'pll_get_post_types', 'ondigital_glossary_pll_post_types' );
function ondigital_glossary_pll_post_types( array $types ): array {
    $types['od_glossary'] = 'od_glossary';
    return $types;
}

add_filter( 'pll_get_taxonomies', 'ondigital_glossary_pll_taxonomies' );
function ondigital_glossary_pll_taxonomies( array $taxonomies ): array {
    $taxonomies['glossary_cat'] = 'glossary_cat';
    return $taxonomies;
}

// =============================================================================
// Flush rewrite rules on activation (run once)
// =============================================================================

add_action( 'after_switch_theme', 'ondigital_glossary_flush_rewrites' );
function ondigital_glossary_flush_rewrites(): void {
    ondigital_register_glossary_cpt();
    ondigital_register_glossary_taxonomy();
    flush_rewrite_rules();
}

// =============================================================================
// Demo content seeder (runs once on init)
// =============================================================================

add_action( 'init', 'ondigital_glossary_maybe_flush', 15 );
function ondigital_glossary_maybe_flush(): void {
    if ( get_option( 'ondigital_glossary_flushed_v2' ) ) {
        return;
    }
    flush_rewrite_rules();
    update_option( 'ondigital_glossary_flushed_v2', true );
}

add_action( 'init', 'ondigital_glossary_seed_demo', 20 );
function ondigital_glossary_seed_demo(): void {
    if ( get_option( 'ondigital_glossary_demo_seeded_v2' ) ) {
        return;
    }

    $terms = array(
        array(
            'title'    => 'A/B Testing',
            'cat'      => 'Analitika',
            'excerpt'  => 'İki versiyanı müqayisə edərək hansının daha yaxşı nəticə verdiyini müəyyən etmə metodu. Bölünmüş test kimi də tanınır.',
            'content'  => '<p>A/B testi — veb səhifənin, e-poçtun, reklamın və ya digər marketinq materialının iki versiyasını eyni vaxtda müxtəlif auditoriya seqmentlərinə göstərərək hansının daha yaxşı nəticə verdiyini ölçən eksperiment metodudur.</p>
<p>Proses zamanı bir dəyişən (başlıq, rəng, CTA düyməsi) dəyişdirilir, qalanları sabit saxlanılır. Statistik əhəmiyyətli nəticə əldə edildikdən sonra qalib versiya tətbiq edilir.</p>
<h3>Nə üçün vacibdir?</h3>
<ul>
<li>Qərarları məlumata əsaslanır, təxminə deyil</li>
<li>Dönüşüm dərəcəsini artırır</li>
<li>İstifadəçi davranışını daha yaxşı anlamağa kömək edir</li>
</ul>',
        ),
        array(
            'title'    => 'Bounce Rate',
            'cat'      => 'Metriklər',
            'excerpt'  => 'Sayta daxil olan və başqa heç bir səhifəyə keçmədən çıxan ziyarətçilərin faizi.',
            'content'  => '<p>Bounce Rate (Geri dönmə dərəcəsi) — bir ziyarətçinin sayta gəlib yalnız bir səhifəyə baxdıqdan sonra başqa heç bir əməliyyat etmədən çıxmasının göstəricisidir.</p>
<p>Yüksək bounce rate həmişə pis deyil — bloq məqaləsi oxuyan istifadəçi cavabını tapıb çıxa bilər. Lakin e-ticarət saytları üçün yüksək göstərici ciddi problemə işarə edir.</p>
<h3>Orta göstəricilər:</h3>
<ul>
<li>Bloq: 70–90%</li>
<li>E-ticarət: 20–45%</li>
<li>Landing page: 60–90%</li>
</ul>',
        ),
        array(
            'title'    => 'Conversion Rate',
            'cat'      => 'Performans',
            'excerpt'  => 'Ümumi ziyarətçilər arasında hədəf əməliyyatı (alış, qeydiyyat və s.) həyata keçirənlərin faizi.',
            'content'  => '<p>Dönüşüm dərəcəsi — sayta gələn ziyarətçilərin müəyyən hədəf əməliyyatını (alış, forma doldurma, abunəlik) tamamlayanların nisbətidir.</p>
<p><strong>Formula:</strong> (Dönüşümlər ÷ Ziyarətçilər) × 100</p>
<p>Orta e-ticarət dönüşüm dərəcəsi 2–4% arasındadır. Bu göstəricini artırmaq üçün A/B testi, CRO (Conversion Rate Optimization) metodları tətbiq edilir.</p>',
        ),
        array(
            'title'    => 'Domain Authority',
            'cat'      => 'SEO',
            'excerpt'  => 'Axtarış motorlarında saytın reytinq mövqeyini proqnozlaşdıran Moz tərəfindən hazırlanmış 1–100 ballıq göstərici.',
            'content'  => '<p>Domain Authority (DA) — Moz tərəfindən hazırlanmış, saytın axtarış nəticələrindəki mövqeyini proqnozlaşdıran 1-dən 100-ə qədər rəqəmsal göstəricidir. Daha yüksək bal daha güclü sayta işarə edir.</p>
<p>DA-nı artırmaq üçün keyfiyyətli backlink qazanmaq, sayt strukturunu gücləndirmək və yüksək dəyərli məzmun yaratmaq lazımdır. Google-un rəsmi reytinq amili deyil, lakin müqayisəli analiz üçün geniş istifadə olunur.</p>',
        ),
        array(
            'title'    => 'Evergreen Content',
            'cat'      => 'Kontent Marketinq',
            'excerpt'  => 'Uzun müddət aktuallığını qoruyaraq davamlı üzvi trafik gətirən məzmun növü.',
            'content'  => '<p>Evergreen content — "həmişəyaşıl" məzmun deməkdir. Xəbər ya trend kimi tez köhnəlməyən, illər boyu axtarış trafiki cəlb etməyə davam edən məqalə, bələdçi və ya video.</p>
<h3>Nümunələr:</h3>
<ul>
<li>"SEO nədir?" — izahedici məqalə</li>
<li>"E-poçt marketinqi bələdçisi"</li>
<li>"Effektiv CTA yazmaq üçün 10 ipucu"</li>
</ul>
<p>Evergreen məzmun SEO strategiyasının əsasını təşkil edir, çünki zamanla daha çox backlink qazanır.</p>',
        ),
        array(
            'title'    => 'Funnel Optimization',
            'cat'      => 'Dönüşüm',
            'excerpt'  => 'Satış hunisinin hər mərhələsindəki sürtünməni azaltmaq və dönüşüm dərəcəsini artırmaq prosesi.',
            'content'  => '<p>Funnel optimization — müştərinin ilk tanışlıqdan alışa qədər keçdiyi yolun (huninin) hər addımını optimallaşdırmaq deməkdir.</p>
<p>Huniyi adətən dörd mərhələyə bölürlər: Awareness (məlumatlılıq), Interest (maraq), Decision (qərar), Action (əməliyyat) — AIDA modeli.</p>
<h3>Optimallaşdırma üsulları:</h3>
<ul>
<li>A/B testi ilə landing page-ləri yaxşılaşdırmaq</li>
<li>Formaların sayını azaltmaq</li>
<li>Yükləmə sürətini artırmaq</li>
<li>Retargeting reklamları tətbiq etmək</li>
</ul>',
        ),
        array(
            'title'    => 'Growth Hacking',
            'cat'      => 'Strategiya',
            'excerpt'  => 'Aşağı xərclə sürətli böyüməyə fokuslanmış yaradıcı marketinq eksperimentlər metodologiyası.',
            'content'  => '<p>Growth hacking — ənənəvi marketinqdən fərqli olaraq, məhsulun özünü kanalına çevirən, sürətli və ölçülə bilən böyüməyə yönəlmiş ekperiment metodologiyasıdır.</p>
<p>Termin 2010-cu ildə Sean Ellis tərəfindən yaradılmışdır. Dropbox-un "dost dəvət et, əlavə yer qazan" kampaniyası klassik nümunədir — istifadəçi sayı aylar içində neçə dəfə artdı.</p>
<h3>Əsas xüsusiyyətlər:</h3>
<ul>
<li>Sürətli eksperiment döngüsü</li>
<li>Məhsul, data və marketinqin birləşməsi</li>
<li>Miqyaslana bilən kanalları tapmaq</li>
</ul>',
        ),
        array(
            'title'    => 'Lead Magnet',
            'cat'      => 'Inbound Marketinq',
            'excerpt'  => 'Potensial müştərinin əlaqə məlumatlarını əldə etmək müqabilində təklif edilən pulsuz dəyərli material.',
            'content'  => '<p>Lead magnet — potensial müştərinin e-poçt ünvanı və ya digər məlumatları müqabilində təklif edilən pulsuz dəyərli materialdır.</p>
<h3>Populyar lead magnet növləri:</h3>
<ul>
<li>E-kitab / PDF bələdçi</li>
<li>Checklist / şablon</li>
<li>Vebinar</li>
<li>Pulsuz sınaq versiyası</li>
<li>Endirim kuponu</li>
</ul>
<p>Effektiv lead magnet konkret problemi həll etməlidir, yüksek dəyər təklif etməlidir və dərhal çatdırılmalıdır.</p>',
        ),
        array(
            'title'    => 'Meta Tags',
            'cat'      => 'Texniki SEO',
            'excerpt'  => 'Səhifənin məzmununu axtarış motorlarına və sosial şəbəkələrə izah edən HTML başlığındakı gizli etiketlər.',
            'content'  => '<p>Meta tags — HTML sənədinin <code>&lt;head&gt;</code> bölməsindəki, səhifənin özündə görünməyən, lakin axtarış motorları və sosial şəbəkələr tərəfindən oxunan etiketlərdir.</p>
<h3>Ən vacib meta tags:</h3>
<ul>
<li><strong>meta description</strong> — axtarış nəticəsindəki qısa izah (150–160 simvol)</li>
<li><strong>meta robots</strong> — axtarış motorlarına indeksləmə qaydaları</li>
<li><strong>Open Graph tags</strong> — Facebook/LinkedIn paylaşımı üçün başlıq, şəkil</li>
<li><strong>Twitter Card tags</strong> — Twitter paylaşımı üçün format</li>
</ul>
<p>Düzgün konfiqurasiya edilmiş meta tags CTR-ni artırır və sosial şəbəkələrdə cəlbedici görünüş təmin edir.</p>',
        ),
    );

    // Category slug → term_id cache
    $cat_ids = array();

    foreach ( $terms as $item ) {
        // Skip if already exists
        $existing = get_posts( array(
            'post_type'      => 'od_glossary',
            'title'          => $item['title'],
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'post_status'    => 'publish',
        ) );
        if ( $existing ) {
            continue;
        }

        // Get or create category
        $cat_slug = sanitize_title( $item['cat'] );
        if ( ! isset( $cat_ids[ $cat_slug ] ) ) {
            $term = get_term_by( 'slug', $cat_slug, 'glossary_cat' );
            if ( ! $term ) {
                $inserted = wp_insert_term( $item['cat'], 'glossary_cat', array( 'slug' => $cat_slug ) );
                $cat_ids[ $cat_slug ] = is_wp_error( $inserted ) ? 0 : $inserted['term_id'];
            } else {
                $cat_ids[ $cat_slug ] = $term->term_id;
            }
        }

        $post_id = wp_insert_post( array(
            'post_title'   => $item['title'],
            'post_excerpt' => $item['excerpt'],
            'post_content' => $item['content'],
            'post_status'  => 'publish',
            'post_type'    => 'od_glossary',
        ) );

        if ( ! is_wp_error( $post_id ) && $cat_ids[ $cat_slug ] ) {
            wp_set_post_terms( $post_id, array( $cat_ids[ $cat_slug ] ), 'glossary_cat' );
        }
    }

    update_option( 'ondigital_glossary_demo_seeded_v2', true );
}
