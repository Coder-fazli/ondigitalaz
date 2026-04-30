<?php
/**
 * Template Name: Checklist Landing
 *
 * Self-contained landing page — no global header/footer so the design
 * matches the concept exactly. Uses wp_head() / wp_footer() for
 * WordPress hooks (analytics, plugins, etc.).
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'plus-jakarta-sans',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap',
        array(),
        null
    );
    wp_enqueue_style(
        'ondigital-checklist',
        get_template_directory_uri() . '/assets/css/pages/checklist.css',
        array( 'plus-jakarta-sans' ),
        @filemtime( get_template_directory() . '/assets/css/pages/checklist.css' ) ?: ONDIGITAL_VERSION
    );
    // Od Forms JS + nonce (for form submission)
    if ( defined( 'ODF_VERSION' ) ) {
        wp_enqueue_script( 'odf-forms', plugins_url( 'ondigital-forms/assets/js/forms.js' ), array(), ODF_VERSION, true );
        wp_localize_script( 'odf-forms', 'odfVars', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'odf_submit' ),
        ) );
    }
}, 5 );

/* ── AJAX: checklist form submission ── */
add_action( 'wp_ajax_odf_cl_submit',        'odf_cl_handle_submit' );
add_action( 'wp_ajax_nopriv_odf_cl_submit', 'odf_cl_handle_submit' );
function odf_cl_handle_submit(): void {
    check_ajax_referer( 'odf_submit', 'nonce' );

    $name  = sanitize_text_field( $_POST['name']  ?? '' );
    $email = sanitize_email(      $_POST['email'] ?? '' );

    if ( ! $name || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid input.' ) );
    }

    /* Save to Od Forms submissions table if plugin is active */
    if ( function_exists( 'odf_save_submission' ) ) {
        odf_save_submission( array(
            'name'   => $name,
            'email'  => $email,
            'source' => 'checklist-landing',
        ) );
    }

    /* Email notification */
    $to      = get_option( 'admin_email' );
    $subject = sprintf( '[OnDigital] New checklist download — %s', $name );
    $body    = sprintf( "Name: %s\nEmail: %s\n\nPage: Checklist Landing", $name, $email );
    wp_mail( $to, $subject, $body );

    wp_send_json_success();
}

/* ── Dynamic content via options (with design-matching defaults) ── */
$topbar_text     = ondigital_get_option( 'cl_topbar_text',     'Free download' );
$topbar_note     = ondigital_get_option( 'cl_topbar_note',     'No credit card. No catch. Instant access.' );
$hero_kicker     = ondigital_get_option( 'cl_hero_kicker',     'Free Resource — 2025 Edition' );
$hero_h1_1       = ondigital_get_option( 'cl_hero_h1_1',       'The digital marketing' );
$hero_h1_2       = ondigital_get_option( 'cl_hero_h1_2',       'checklist that' );
$hero_h1_hl      = ondigital_get_option( 'cl_hero_h1_hl',      'actually' );
$hero_h1_3       = ondigital_get_option( 'cl_hero_h1_3',       'works.' );
$hero_body       = ondigital_get_option( 'cl_hero_body',       '40 items across SEO, paid ads, social, and conversion. Used by over 150 businesses we\'ve worked with. Free — because good marketing starts with a solid foundation.' );

$stat1_num       = ondigital_get_option( 'cl_stat1_num',       '150' );
$stat1_sup       = ondigital_get_option( 'cl_stat1_sup',       '+' );
$stat1_lbl       = ondigital_get_option( 'cl_stat1_lbl',       'Businesses' );
$stat2_num       = ondigital_get_option( 'cl_stat2_num',       '40' );
$stat2_sup       = ondigital_get_option( 'cl_stat2_sup',       '' );
$stat2_lbl       = ondigital_get_option( 'cl_stat2_lbl',       'Checklist items' );
$stat3_num       = ondigital_get_option( 'cl_stat3_num',       '8' );
$stat3_sup       = ondigital_get_option( 'cl_stat3_sup',       'x' );
$stat3_lbl       = ondigital_get_option( 'cl_stat3_lbl',       'Avg. client ROI' );

/* stat labels stored as cl_statN_lbl_az / cl_statN_lbl_en — ondigital_get_option resolves lang automatically */

$form_title      = ondigital_get_option( 'cl_form_title',      'Get instant access' );
$form_subtitle   = ondigital_get_option( 'cl_form_subtitle',   'We\'ll send it straight to your inbox.' );
$form_btn        = ondigital_get_option( 'cl_form_btn',        'Send me the checklist' );
$form_success_h  = ondigital_get_option( 'cl_form_success_h',  'It\'s on its way.' );
$form_success_p  = ondigital_get_option( 'cl_form_success_p',  'Check your inbox — and your spam folder if you don\'t see it in 2 minutes.' );

$testi_quote     = ondigital_get_option( 'cl_testi_quote',     'We went through this checklist in our first week with OnDigital. Within 90 days our organic traffic doubled and our cost per lead dropped by 40%.' );
$testi_name      = ondigital_get_option( 'cl_testi_name',      'Elnar Səmədzadə' );
$testi_role      = ondigital_get_option( 'cl_testi_role',      'CEO, Nexus Commerce' );
$testi_initials  = ondigital_get_option( 'cl_testi_initials',  'ES' );

$bottom_h2       = ondigital_get_option( 'cl_bottom_h2',       'Start with the right foundation.' );
$bottom_em       = ondigital_get_option( 'cl_bottom_em',       'It\'s free.' );
$bottom_note     = ondigital_get_option( 'cl_bottom_note',     'Takes 30 seconds to get. Could save you months of wrong turns.' );
$bottom_btn      = ondigital_get_option( 'cl_bottom_btn',      'Get the checklist' );

$site_name       = get_bloginfo( 'name' );
$site_url        = home_url( '/' );
$privacy_url     = get_privacy_policy_url() ?: '#';

/* ── SVG helpers ── */
$svg_check = '<svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>';
$svg_lock  = '<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>';
$svg_close = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';
$svg_arrow = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
$svg_tick  = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '—', true, 'right' ); echo esc_html( $site_name ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'cl-page' ); ?>>
<?php wp_body_open(); ?>

<!-- TOPBAR -->
<div class="cl-topbar" id="cl-topbar">
    <strong><?php echo esc_html( $topbar_text ); ?></strong>
    <span class="cl-topbar-sep" aria-hidden="true"></span>
    <?php echo esc_html( $topbar_note ); ?>
    <button class="cl-topbar-close" id="cl-topbar-close" aria-label="<?php esc_attr_e( 'Dismiss', 'ondigital' ); ?>">
        <?php echo $svg_close; ?>
    </button>
</div>

<!-- NAV -->
<nav class="cl-nav" id="cl-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'ondigital' ); ?>">
    <a href="<?php echo esc_url( $site_url ); ?>" class="cl-nav-logo">
        <?php echo esc_html( $site_name ); ?><span class="cl-nav-logo-dot" aria-hidden="true"></span>
    </a>
    <div class="cl-nav-links">
        <a href="<?php echo esc_url( home_url( '/islerimiz/' ) ); ?>" class="cl-nav-link"><?php esc_html_e( 'Our Work', 'ondigital' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/xidmetler/' ) ); ?>" class="cl-nav-link"><?php esc_html_e( 'Services', 'ondigital' ); ?></a>
        <a href="#cl-top" class="cl-nav-cta"><?php esc_html_e( 'Get checklist', 'ondigital' ); ?> →</a>
    </div>
</nav>

<!-- HERO -->
<section class="cl-hero" id="cl-top" aria-labelledby="cl-hero-heading">

    <div class="cl-hero-left">
        <div class="cl-hero-kicker" aria-hidden="true">
            <span class="cl-kicker-pip"></span>
            <?php echo esc_html( $hero_kicker ); ?>
        </div>

        <h1 id="cl-hero-heading">
            <?php echo esc_html( $hero_h1_1 ); ?><br>
            <?php echo esc_html( $hero_h1_2 ); ?> <span class="cl-hl"><?php echo esc_html( $hero_h1_hl ); ?></span><br>
            <?php echo esc_html( $hero_h1_3 ); ?>
        </h1>

        <p class="cl-hero-body"><?php echo esc_html( $hero_body ); ?></p>

        <div class="cl-stats" role="list" aria-label="<?php esc_attr_e( 'Key statistics', 'ondigital' ); ?>">
            <div class="cl-stat" role="listitem">
                <div class="cl-stat-num"><?php echo esc_html( $stat1_num ); ?><?php if ( $stat1_sup ) : ?><sup><?php echo esc_html( $stat1_sup ); ?></sup><?php endif; ?></div>
                <div class="cl-stat-lbl"><?php echo esc_html( $stat1_lbl ); ?></div>
            </div>
            <div class="cl-stat" role="listitem">
                <div class="cl-stat-num"><?php echo esc_html( $stat2_num ); ?><?php if ( $stat2_sup ) : ?><sup><?php echo esc_html( $stat2_sup ); ?></sup><?php endif; ?></div>
                <div class="cl-stat-lbl"><?php echo esc_html( $stat2_lbl ); ?></div>
            </div>
            <div class="cl-stat" role="listitem">
                <div class="cl-stat-num"><?php echo esc_html( $stat3_num ); ?><?php if ( $stat3_sup ) : ?><sup><?php echo esc_html( $stat3_sup ); ?></sup><?php endif; ?></div>
                <div class="cl-stat-lbl"><?php echo esc_html( $stat3_lbl ); ?></div>
            </div>
        </div>
    </div>

    <!-- FORM -->
    <div class="cl-form-sticky">
        <div class="cl-form-wrap">
            <div class="cl-form-header">
                <div class="cl-form-header-title"><?php echo esc_html( $form_title ); ?></div>
                <div class="cl-form-header-sub"><?php echo esc_html( $form_subtitle ); ?></div>
            </div>
            <div class="cl-form-body">

                <div id="cl-form-fields">
                    <form id="cl-form" novalidate>
                        <?php wp_nonce_field( 'odf_submit', 'cl_nonce' ); ?>
                        <input type="text" name="cl_hp" style="display:none!important" tabindex="-1" autocomplete="off" aria-hidden="true">

                        <div class="cl-field">
                            <label for="cl-name"><?php esc_html_e( 'Full name', 'ondigital' ); ?></label>
                            <input id="cl-name" type="text" name="name" placeholder="Ali Həsənov" autocomplete="name" required aria-required="true" aria-describedby="cl-err-name">
                            <div id="cl-err-name" class="cl-field-error" role="alert"><?php esc_html_e( 'Please enter your full name.', 'ondigital' ); ?></div>
                        </div>

                        <div class="cl-field">
                            <label for="cl-email"><?php esc_html_e( 'Work email', 'ondigital' ); ?></label>
                            <input id="cl-email" type="email" name="email" placeholder="ali@yourcompany.az" autocomplete="email" required aria-required="true" aria-describedby="cl-err-email">
                            <div id="cl-err-email" class="cl-field-error" role="alert"><?php esc_html_e( 'Please enter a valid email address.', 'ondigital' ); ?></div>
                        </div>

                        <button type="submit" class="cl-btn-send">
                            <?php echo esc_html( $form_btn ); ?>
                            <span class="cl-btn-send-icon"><?php echo $svg_arrow; ?></span>
                        </button>
                    </form>

                    <div class="cl-form-privacy" aria-hidden="true">
                        <?php echo $svg_lock; ?>
                        <?php esc_html_e( 'No spam. Unsubscribe anytime.', 'ondigital' ); ?>
                    </div>
                </div>

                <div class="cl-success" id="cl-success" role="status" aria-live="polite">
                    <div class="cl-success-mark"><?php echo $svg_tick; ?></div>
                    <h3><?php echo esc_html( $form_success_h ); ?></h3>
                    <p><?php echo esc_html( $form_success_p ); ?></p>
                </div>

                <div class="cl-trust">
                    <div class="cl-trust-avatars" aria-hidden="true">
                        <div class="cl-ta">AH</div>
                        <div class="cl-ta">ES</div>
                        <div class="cl-ta">RB</div>
                        <div class="cl-ta">MK</div>
                    </div>
                    <div class="cl-trust-copy">
                        <strong><?php echo esc_html( $stat1_num . $stat1_sup ); ?> <?php esc_html_e( 'teams', 'ondigital' ); ?></strong> <?php esc_html_e( 'downloaded this checklist last month.', 'ondigital' ); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

<div class="cl-divider" role="separator"></div>

<!-- WHAT'S INSIDE -->
<section class="cl-inside" aria-labelledby="cl-inside-heading">

    <div class="cl-inside-head">
        <h2 id="cl-inside-heading"><?php esc_html_e( "What's inside the checklist.", 'ondigital' ); ?> <span><?php esc_html_e( 'All 40 items.', 'ondigital' ); ?></span></h2>
        <div class="cl-inside-meta"><?php esc_html_e( '4 chapters · 40 items · PDF format', 'ondigital' ); ?></div>
    </div>

    <div class="cl-chapters" role="list">

        <?php
        $chapters = array(
            array(
                'num'   => '01 — SEO',
                'badge' => '10 items',
                'title' => __( 'Search Engine Optimisation', 'ondigital' ),
                'items' => array(
                    __( 'Technical site audit', 'ondigital' ),
                    __( 'Keyword gap analysis', 'ondigital' ),
                    __( 'On-page meta & structure', 'ondigital' ),
                    __( 'Core Web Vitals', 'ondigital' ),
                ),
                'more'  => '+6',
            ),
            array(
                'num'   => '02 — ADS',
                'badge' => '11 items',
                'title' => __( 'Paid Advertising', 'ondigital' ),
                'items' => array(
                    __( 'Google Ads account structure', 'ondigital' ),
                    __( 'Audience segmentation', 'ondigital' ),
                    __( 'Budget & bid strategy', 'ondigital' ),
                    __( 'Ad creative checklist', 'ondigital' ),
                ),
                'more'  => '+7',
            ),
            array(
                'num'   => '03 — SOCIAL',
                'badge' => '9 items',
                'title' => __( 'Social Media', 'ondigital' ),
                'items' => array(
                    __( 'Profile optimisation', 'ondigital' ),
                    __( 'Content calendar setup', 'ondigital' ),
                    __( 'Engagement strategy', 'ondigital' ),
                    __( 'Hashtag & reach tactics', 'ondigital' ),
                ),
                'more'  => '+5',
            ),
            array(
                'num'   => '04 — CRO',
                'badge' => '10 items',
                'title' => __( 'Conversion & UX', 'ondigital' ),
                'items' => array(
                    __( 'Landing page audit', 'ondigital' ),
                    __( 'CTA placement & copy', 'ondigital' ),
                    __( 'Mobile speed check', 'ondigital' ),
                    __( 'Trust signal setup', 'ondigital' ),
                ),
                'more'  => '+6',
            ),
        );
        foreach ( $chapters as $ch ) :
        ?>
        <article class="cl-chapter" role="listitem">
            <div class="cl-ch-meta">
                <span class="cl-ch-num"><?php echo esc_html( $ch['num'] ); ?></span>
                <span class="cl-ch-badge"><?php echo esc_html( $ch['badge'] ); ?></span>
            </div>
            <h3 class="cl-ch-title"><?php echo esc_html( $ch['title'] ); ?></h3>
            <ul class="cl-ch-list">
                <?php foreach ( $ch['items'] as $item ) : ?>
                <li>
                    <span class="cl-ch-bullet"><?php echo $svg_check; ?></span>
                    <?php echo esc_html( $item ); ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="cl-ch-more">
                <?php echo $svg_lock; ?>
                <?php printf( esc_html__( '%s more inside the download', 'ondigital' ), esc_html( $ch['more'] ) ); ?>
            </div>
        </article>
        <?php endforeach; ?>

    </div>

</section>

<!-- TESTIMONIAL -->
<div class="cl-testi-wrap">
    <div class="cl-testi-inner">
        <div class="cl-testi-mark" aria-hidden="true">"</div>
        <div>
            <p class="cl-testi-quote"><?php echo esc_html( $testi_quote ); ?></p>
            <div class="cl-testi-author">
                <div class="cl-testi-avatar" aria-hidden="true"><?php echo esc_html( $testi_initials ); ?></div>
                <div>
                    <div class="cl-testi-name"><?php echo esc_html( $testi_name ); ?></div>
                    <div class="cl-testi-role"><?php echo esc_html( $testi_role ); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BOTTOM CTA -->
<div class="cl-bottom-wrap">
    <div class="cl-bottom">
        <h2><?php echo esc_html( $bottom_h2 ); ?> <em><?php echo esc_html( $bottom_em ); ?></em></h2>
        <div>
            <p class="cl-bottom-note"><?php echo esc_html( $bottom_note ); ?></p>
            <a href="#cl-top" class="cl-btn-bottom">
                <?php echo esc_html( $bottom_btn ); ?> <span class="cl-btn-lime" aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="cl-footer">
    <span>© <?php echo date( 'Y' ); ?> <?php echo esc_html( $site_name ); ?>. <?php esc_html_e( 'All rights reserved.', 'ondigital' ); ?></span>
    <div class="cl-footer-links">
        <a href="<?php echo esc_url( $site_url ); ?>"><?php echo esc_html( parse_url( $site_url, PHP_URL_HOST ) ); ?></a>
        <span class="cl-footer-sep">·</span>
        <a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacy Policy', 'ondigital' ); ?></a>
    </div>
</footer>

<script>
(function () {
    var ajaxurl = <?php echo json_encode( admin_url( 'admin-ajax.php' ) ); ?>;
    var nonce   = <?php echo json_encode( wp_create_nonce( 'odf_submit' ) ); ?>;

    /* topbar dismiss */
    var bar = document.getElementById('cl-topbar');
    var nav = document.getElementById('cl-nav');
    document.getElementById('cl-topbar-close').addEventListener('click', function () {
        bar.style.display = 'none';
        nav.style.top = '0';
    });

    /* fields */
    var nameEl  = document.getElementById('cl-name');
    var emailEl = document.getElementById('cl-email');
    var errName  = document.getElementById('cl-err-name');
    var errEmail = document.getElementById('cl-err-email');

    function validateName() {
        var ok = nameEl.value.trim().length > 0;
        nameEl.classList.toggle('cl-has-error', !ok);
        errName.classList.toggle('cl-on', !ok);
        return ok;
    }
    function validateEmail() {
        var ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailEl.value.trim());
        emailEl.classList.toggle('cl-has-error', !ok);
        errEmail.classList.toggle('cl-on', !ok);
        return ok;
    }

    nameEl.addEventListener('blur', validateName);
    emailEl.addEventListener('blur', validateEmail);
    nameEl.addEventListener('input', function () {
        if (nameEl.value.trim()) { nameEl.classList.remove('cl-has-error'); errName.classList.remove('cl-on'); }
    });
    emailEl.addEventListener('input', function () {
        if (emailEl.value.trim()) { emailEl.classList.remove('cl-has-error'); errEmail.classList.remove('cl-on'); }
    });

    /* submit */
    document.getElementById('cl-form').addEventListener('submit', function (e) {
        e.preventDefault();
        if (!validateName()) { nameEl.focus(); return; }
        if (!validateEmail()) { emailEl.focus(); return; }

        var btn = this.querySelector('.cl-btn-send');
        btn.disabled = true;
        btn.style.opacity = '.7';

        var fd = new FormData();
        fd.append('action', 'odf_cl_submit');
        fd.append('nonce', nonce);
        fd.append('name',  nameEl.value.trim());
        fd.append('email', emailEl.value.trim());

        fetch(ajaxurl, { method: 'POST', body: fd })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                if (res.success) {
                    document.getElementById('cl-form-fields').style.display = 'none';
                    var s = document.getElementById('cl-success');
                    s.classList.add('cl-on');
                    s.focus();
                } else {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                }
            })
            .catch(function () {
                btn.disabled = false;
                btn.style.opacity = '1';
            });
    });
}());
</script>

<?php wp_footer(); ?>
</body>
</html>
