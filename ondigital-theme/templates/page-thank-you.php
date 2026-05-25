<?php
/**
 * Template Name: Thank You Page
 *
 * Auto-created by theme. Shown after successful form submission.
 * Reads ?xidmet= URL param for service-specific messaging.
 *
 * @package OnDigital
 */

get_header();

$lang    = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';
$ty_title = $lang === 'az' ? 'Təşəkkür edirik!' : 'Thank you!';
$ty_sub   = $lang === 'az'
    ? 'Müraciətiniz qəbul edildi. Tezliklə sizinlə əlaqə saxlayacağıq.'
    : 'Your message has been received. We\'ll be in touch shortly.';
$ty_home  = $lang === 'az' ? 'Ana Səhifə' : 'Go to Homepage';
$ty_svcs  = $lang === 'az' ? 'Xidmətlər' : 'Our Services';
?>

<style>
.breadcrumb-wrapper,
.progress-wrap { display: none !important; }

@keyframes odty-check {
    from { stroke-dashoffset: 60; }
    to   { stroke-dashoffset: 0; }
}
@keyframes odty-fadein {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes odty-scale {
    0%   { transform: scale(0.7); opacity: 0; }
    60%  { transform: scale(1.05); }
    100% { transform: scale(1); opacity: 1; }
}

.odty-page {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 24px;
    background: #fff;
}

.odty-card {
    text-align: center;
    max-width: 480px;
    width: 100%;
}

.odty-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: #f3ffe0;
    border: 2px solid #c2f971;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 32px;
    animation: odty-scale .5s cubic-bezier(.34,1.56,.64,1) both;
}
.odty-icon svg {
    width: 32px;
    height: 32px;
}
.odty-check-path {
    stroke: #0a0a0a;
    stroke-width: 2.5;
    stroke-linecap: round;
    stroke-linejoin: round;
    fill: none;
    stroke-dasharray: 60;
    stroke-dashoffset: 60;
    animation: odty-check .45s .4s ease forwards;
}

.odty-title {
    font-size: clamp(32px, 5vw, 52px);
    font-weight: 900;
    color: #0a0a0a;
    letter-spacing: -.03em;
    line-height: 1.1;
    margin: 0 0 16px;
    animation: odty-fadein .5s .2s ease both;
}

.odty-sub {
    font-size: 16px;
    line-height: 1.7;
    color: rgba(0,0,0,.5);
    margin: 0 0 12px;
    animation: odty-fadein .5s .3s ease both;
}

.odty-service-tag {
    display: none;
    background: #c2f971;
    color: #0a0a0a;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 100px;
    margin-bottom: 36px;
    animation: odty-fadein .5s .35s ease both;
}

.odty-divider {
    width: 40px;
    height: 2px;
    background: #c2f971;
    margin: 28px auto 32px;
    border-radius: 2px;
    animation: odty-fadein .5s .3s ease both;
}

.odty-ctas {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
    animation: odty-fadein .5s .45s ease both;
}

.odty-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 24px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: transform .15s, box-shadow .2s;
    border: none;
    cursor: pointer;
}
.odty-btn:hover { transform: translateY(-2px); }
.odty-btn--primary {
    background: #0a0a0a;
    color: #fff;
    box-shadow: 0 2px 12px rgba(0,0,0,.12);
}
.odty-btn--primary:hover { background: #222; color: #c2f971; }
.odty-btn--secondary {
    background: #f5f5f3;
    color: #0a0a0a;
}
.odty-btn--secondary:hover { background: #eee; color: #0a0a0a; }

@media (max-width: 480px) {
    .odty-page { padding: 60px 20px; }
    .odty-ctas { flex-direction: column; }
    .odty-btn { justify-content: center; }
}
</style>

<div class="odty-page">
    <div class="odty-card">

        <div class="odty-icon">
            <svg viewBox="0 0 24 24">
                <polyline class="odty-check-path" points="4,13 9,18 20,7"/>
            </svg>
        </div>

        <h1 class="odty-title"><?php echo esc_html( $ty_title ); ?></h1>
        <p class="odty-sub"><?php echo esc_html( $ty_sub ); ?></p>

        <span class="odty-service-tag" id="odty-service-label"></span>

        <div class="odty-divider"></div>

        <div class="odty-ctas">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="odty-btn odty-btn--primary">
                <?php echo esc_html( $ty_home ); ?>
            </a>
            <a href="<?php echo esc_url( home_url('/xidmetler/') ); ?>" class="odty-btn odty-btn--secondary">
                <?php echo esc_html( $ty_svcs ); ?>
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>

    </div>
</div>

<script>
(function(){
    var param = new URLSearchParams(window.location.search).get('xidmet');
    var names = {
        'seo': 'SEO', 'google-ads': 'Google Ads', 'meta-ads': 'Meta Ads',
        'tiktok-ads': 'TikTok Ads', 'smm': 'SMM', 'web': 'Web Design',
        'branding': 'Branding', 'contact': 'Contact Form',
    };
    if (param && names[param]) {
        var tag = document.getElementById('odty-service-label');
        if (tag) { tag.textContent = names[param]; tag.style.display = 'inline-block'; }
    }
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({ event: 'form_success', xidmet: param || 'unknown' });
})();
</script>

<?php get_footer(); ?>
