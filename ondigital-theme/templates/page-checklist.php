<?php
/**
 * Template Name: Checklist Landing
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'plus-jakarta-sans', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap', array(), null );
    wp_enqueue_style(
        'ondigital-checklist',
        get_template_directory_uri() . '/assets/css/pages/checklist.css',
        array( 'ondigital-default' ),
        @filemtime( get_template_directory() . '/assets/css/pages/checklist.css' ) ?: ONDIGITAL_VERSION
    );
}, 99 );

/* Add cl-page body class for CSS scoping */
add_filter( 'body_class', function ( $classes ) {
    $classes[] = 'cl-page';
    return $classes;
} );

/* Inject custom meta title + description */
add_action( 'wp_head', function () {
    $meta_title = ondigital_get_option( 'cl_meta_title', '' );
    $meta_desc  = ondigital_get_option( 'cl_meta_desc',  '' );
    if ( $meta_title ) {
        echo '<title>' . esc_html( $meta_title ) . '</title>' . "\n";
    }
    if ( $meta_desc ) {
        echo '<meta name="description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
    }
}, 1 );

/* ── Dynamic content ── */
$hero_kicker    = ondigital_get_option( 'cl_hero_kicker',    'Free Resource — 2025 Edition' );
$hero_h1_1      = ondigital_get_option( 'cl_hero_h1_1',      'The digital marketing' );
$hero_h1_2      = ondigital_get_option( 'cl_hero_h1_2',      'checklist that' );
$hero_h1_hl     = ondigital_get_option( 'cl_hero_h1_hl',     'actually' );
$hero_h1_3      = ondigital_get_option( 'cl_hero_h1_3',      'works.' );
$hero_body      = ondigital_get_option( 'cl_hero_body',      '40 items across SEO, paid ads, social, and conversion. Used by over 150 businesses we\'ve worked with. Free — because good marketing starts with a solid foundation.' );

$stat1_num      = ondigital_get_option( 'cl_stat1_num',      '150' );
$stat1_sup      = ondigital_get_option( 'cl_stat1_sup',      '+' );
$stat1_lbl      = ondigital_get_option( 'cl_stat1_lbl',      'Businesses' );
$stat2_num      = ondigital_get_option( 'cl_stat2_num',      '40' );
$stat2_sup      = ondigital_get_option( 'cl_stat2_sup',      '' );
$stat2_lbl      = ondigital_get_option( 'cl_stat2_lbl',      'Checklist items' );
$stat3_num      = ondigital_get_option( 'cl_stat3_num',      '8' );
$stat3_sup      = ondigital_get_option( 'cl_stat3_sup',      'x' );
$stat3_lbl      = ondigital_get_option( 'cl_stat3_lbl',      'Avg. client ROI' );

$form_title     = ondigital_get_option( 'cl_form_title',     'Get instant access' );
$form_subtitle  = ondigital_get_option( 'cl_form_subtitle',  'We\'ll send it straight to your inbox.' );
$form_btn       = ondigital_get_option( 'cl_form_btn',       'Send me the checklist' );
$form_success_h = ondigital_get_option( 'cl_form_success_h', 'It\'s on its way.' );
$form_success_p = ondigital_get_option( 'cl_form_success_p', 'Check your inbox — and your spam folder if you don\'t see it in 2 minutes.' );

$testi_quote    = ondigital_get_option( 'cl_testi_quote',    'We went through this checklist in our first week with OnDigital. Within 90 days our organic traffic doubled and our cost per lead dropped by 40%.' );
$testi_name     = ondigital_get_option( 'cl_testi_name',     'Elnar Səmədzadə' );
$testi_role     = ondigital_get_option( 'cl_testi_role',     'CEO, Nexus Commerce' );
$testi_initials = ondigital_get_option( 'cl_testi_initials', 'ES' );

$field_name_lbl  = ondigital_get_option( 'cl_field_name',    'Full name' );
$field_email_lbl = ondigital_get_option( 'cl_field_email',   'Work email' );
$field_privacy   = ondigital_get_option( 'cl_field_privacy', 'No spam. Unsubscribe anytime.' );
$trust_text      = ondigital_get_option( 'cl_trust_text',    'teams downloaded this checklist last month.' );

$bottom_h2      = ondigital_get_option( 'cl_bottom_h2',      'Start with the right foundation.' );
$bottom_em      = ondigital_get_option( 'cl_bottom_em',      'It\'s free.' );
$bottom_note    = ondigital_get_option( 'cl_bottom_note',    'Takes 30 seconds to get. Could save you months of wrong turns.' );
$bottom_btn     = ondigital_get_option( 'cl_bottom_btn',     'Get the checklist' );

/* ── SVG helpers ── */
$svg_check = '<svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>';
$svg_lock  = '<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>';
$svg_arrow = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
$svg_tick  = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>';

get_header();
?>

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
                        <input type="text" name="cl_hp" style="display:none!important" tabindex="-1" autocomplete="off" aria-hidden="true">

                        <div class="cl-field">
                            <label for="cl-name"><?php echo esc_html( $field_name_lbl ); ?></label>
                            <input id="cl-name" type="text" name="name" placeholder="Ali Həsənov" autocomplete="name" required aria-required="true" aria-describedby="cl-err-name">
                            <div id="cl-err-name" class="cl-field-error" role="alert"><?php esc_html_e( 'Please enter your full name.', 'ondigital' ); ?></div>
                        </div>

                        <div class="cl-field">
                            <label for="cl-email"><?php echo esc_html( $field_email_lbl ); ?></label>
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
                        <?php echo esc_html( $field_privacy ); ?>
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
                        <strong><?php echo esc_html( $stat1_num . $stat1_sup ); ?></strong>
                        <?php echo esc_html( $trust_text ); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

<div class="cl-divider" role="separator"></div>

<!-- WHAT'S INSIDE -->
<section class="cl-inside" aria-labelledby="cl-inside-heading">

    <?php
    $inside_heading    = ondigital_get_option( 'cl_inside_heading',    "What's inside the checklist." );
    $inside_heading_em = ondigital_get_option( 'cl_inside_heading_em', 'All 40 items.' );
    $inside_meta       = ondigital_get_option( 'cl_inside_meta',       '4 chapters · 40 items · PDF format' );
    ?>
    <div class="cl-inside-head">
        <h2 id="cl-inside-heading"><?php echo esc_html( $inside_heading ); ?> <span><?php echo esc_html( $inside_heading_em ); ?></span></h2>
        <div class="cl-inside-meta"><?php echo esc_html( $inside_meta ); ?></div>
    </div>

    <div class="cl-chapters" role="list">
        <?php
        $chapters = array(
            array( 'num' => '01 — SEO',    'badge' => '10 items', 'title' => ondigital_get_option( 'cl_ch1_title', 'Search Engine Optimisation' ), 'more' => '+6',
                'items' => array( __( 'Technical site audit', 'ondigital' ), __( 'Keyword gap analysis', 'ondigital' ), __( 'On-page meta & structure', 'ondigital' ), __( 'Core Web Vitals', 'ondigital' ) ) ),
            array( 'num' => '02 — ADS',    'badge' => '11 items', 'title' => ondigital_get_option( 'cl_ch2_title', 'Paid Advertising' ),           'more' => '+7',
                'items' => array( __( 'Google Ads account structure', 'ondigital' ), __( 'Audience segmentation', 'ondigital' ), __( 'Budget & bid strategy', 'ondigital' ), __( 'Ad creative checklist', 'ondigital' ) ) ),
            array( 'num' => '03 — SOCIAL', 'badge' => '9 items',  'title' => ondigital_get_option( 'cl_ch3_title', 'Social Media' ),               'more' => '+5',
                'items' => array( __( 'Profile optimisation', 'ondigital' ), __( 'Content calendar setup', 'ondigital' ), __( 'Engagement strategy', 'ondigital' ), __( 'Hashtag & reach tactics', 'ondigital' ) ) ),
            array( 'num' => '04 — CRO',    'badge' => '10 items', 'title' => ondigital_get_option( 'cl_ch4_title', 'Conversion & UX' ),            'more' => '+6',
                'items' => array( __( 'Landing page audit', 'ondigital' ), __( 'CTA placement & copy', 'ondigital' ), __( 'Mobile speed check', 'ondigital' ), __( 'Trust signal setup', 'ondigital' ) ) ),
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
                <li><span class="cl-ch-bullet"><?php echo $svg_check; ?></span><?php echo esc_html( $item ); ?></li>
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

<script>
(function () {
    var ajaxurl = <?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>;

    var nameEl   = document.getElementById('cl-name');
    var emailEl  = document.getElementById('cl-email');
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

    document.getElementById('cl-form').addEventListener('submit', function (e) {
        e.preventDefault();
        if (!validateName())  { nameEl.focus();  return; }
        if (!validateEmail()) { emailEl.focus(); return; }

        var btn = this.querySelector('.cl-btn-send');
        btn.disabled = true;
        btn.style.opacity = '.7';

        var fd = new FormData();
        fd.append('action', 'odf_cl_submit');
        fd.append('name',   nameEl.value.trim());
        fd.append('email',  emailEl.value.trim());

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

<?php get_footer(); ?>
