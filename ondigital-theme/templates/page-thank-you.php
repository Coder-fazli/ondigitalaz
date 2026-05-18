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
?>

<style>
.breadcrumb-wrapper { display: none !important; }

@keyframes od-floatA {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50%      { transform: translateY(-18px) rotate(6deg); }
}
@keyframes od-floatB {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50%      { transform: translateY(14px) rotate(-5deg); }
}
@keyframes od-floatC {
    0%,100% { transform: translate(0,0) scale(1); }
    50%      { transform: translate(10px,-10px) scale(1.06); }
}
@keyframes od-popIn {
    0%   { opacity:0; transform: scale(.6); }
    70%  { transform: scale(1.1); }
    100% { opacity:1; transform: scale(1); }
}
@keyframes od-drawCheck {
    from { stroke-dashoffset: 60; }
    to   { stroke-dashoffset: 0; }
}
@keyframes od-fadeUp {
    from { opacity:0; transform:translateY(22px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes od-pulse {
    0%,100% { box-shadow: 0 0 0 0 rgba(194,249,113,.45); }
    50%      { box-shadow: 0 0 0 20px rgba(194,249,113,0); }
}

.odty-hero {
    position: relative;
    background: #c2f971;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.odty-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(10,10,10,.12) 1.2px, transparent 1.2px);
    background-size: 28px 28px;
    z-index: 1;
    pointer-events: none;
}

.odty-blob {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
    z-index: 1;
}
.odty-blob--1 {
    width:360px; height:360px;
    background: radial-gradient(circle at 40% 40%, #0a0a0a 0%, #1a1a1a 70%);
    top:-130px; left:-90px;
    animation: od-floatA 8s ease-in-out infinite;
}
.odty-blob--2 {
    width:280px; height:280px;
    background: radial-gradient(circle at 60% 60%, #0a0a0a 0%, #1a1a1a 70%);
    bottom:-110px; right:-70px;
    animation: od-floatB 9s ease-in-out infinite;
}
.odty-blob--3 {
    width:160px; height:160px;
    background: radial-gradient(circle, #1a1a1a 0%, #0a0a0a 80%);
    top:30px; right:200px;
    opacity:.4;
    animation: od-floatC 7s ease-in-out infinite;
}
.odty-blob--4 {
    width:90px; height:90px;
    background: #0a0a0a;
    bottom:50px; left:230px;
    opacity:.2;
    animation: od-floatA 11s ease-in-out infinite reverse;
}
.odty-ring {
    position: absolute;
    width:220px; height:220px;
    border: 2px solid rgba(10,10,10,.15);
    border-radius: 50%;
    top:50%; left:72%;
    transform: translate(-50%,-50%);
    z-index: 1;
    pointer-events: none;
    animation: od-floatB 10s ease-in-out infinite;
}
.odty-ring::after {
    content:'';
    position:absolute;
    width:140px; height:140px;
    border:1.5px solid rgba(10,10,10,.1);
    border-radius:50%;
    top:50%; left:50%;
    transform:translate(-50%,-50%);
}

.odty-content {
    position: relative;
    z-index: 3;
    text-align: center;
    padding: 80px 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 640px;
}

.odty-icon-wrap {
    width: 100px; height: 100px;
    background: #0a0a0a;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 36px;
    animation: od-popIn .6s cubic-bezier(.34,1.56,.64,1) both,
               od-pulse 2.5s 1s ease-in-out infinite;
}
.odty-icon-wrap svg { width: 46px; height: 46px; }
.odty-check {
    stroke: #c2f971;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-linejoin: round;
    fill: none;
    stroke-dasharray: 60;
    stroke-dashoffset: 60;
    animation: od-drawCheck .5s .55s ease forwards;
}

.odty-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(10,10,10,.12);
    border: 1px solid rgba(10,10,10,.18);
    color: #0a0a0a;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 100px;
    margin-bottom: 20px;
    animation: od-fadeUp .5s .2s ease both;
}
.odty-eyebrow-dot { width:7px; height:7px; background:#0a0a0a; border-radius:50%; }

.odty-title {
    font-size: clamp(2.8rem, 7vw, 5rem);
    font-weight: 900;
    color: #0a0a0a;
    letter-spacing: -.04em;
    line-height: 1;
    margin: 0 0 16px;
    animation: od-fadeUp .5s .3s ease both;
}
.odty-sub {
    font-size: clamp(.9rem, 1.8vw, 1.1rem);
    color: rgba(10,10,10,.65);
    font-weight: 500;
    margin: 0 0 12px;
    animation: od-fadeUp .5s .4s ease both;
}
.odty-service-tag {
    display: none;
    background: #0a0a0a;
    color: #c2f971;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 100px;
    margin-bottom: 36px;
    animation: od-fadeUp .5s .48s ease both;
}

.odty-ctas {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: center;
    animation: od-fadeUp .5s .56s ease both;
}
.odty-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    border-radius: 10px;
    font-size: .9rem;
    font-weight: 700;
    text-decoration: none;
    transition: transform .15s, box-shadow .2s;
}
.odty-btn:hover { transform: translateY(-2px); }
.odty-btn--primary {
    background: #0a0a0a;
    color: #c2f971;
    box-shadow: 0 4px 20px rgba(10,10,10,.2);
}
.odty-btn--primary:hover { background: #222; color: #c2f971; }
.odty-btn--secondary {
    background: rgba(10,10,10,.1);
    color: #0a0a0a;
    border: 1.5px solid rgba(10,10,10,.18);
}
.odty-btn--secondary:hover { background: rgba(10,10,10,.18); color: #0a0a0a; }

@media (max-width: 768px) {
    .odty-blob--3, .odty-blob--4, .odty-ring { display: none; }
    .odty-blob--1 { width:160px; height:160px; top:-55px; left:-45px; }
    .odty-blob--2 { width:130px; height:130px; bottom:-50px; right:-40px; }
    .odty-content { padding: 60px 20px; }
    .odty-icon-wrap { width:84px; height:84px; }
    .odty-icon-wrap svg { width:38px; height:38px; }
    .odty-ctas { flex-direction: column; width: 100%; }
    .odty-btn { justify-content: center; }
}
</style>

<div class="odty-hero">
    <div class="odty-blob odty-blob--1"></div>
    <div class="odty-blob odty-blob--2"></div>
    <div class="odty-blob odty-blob--3"></div>
    <div class="odty-blob odty-blob--4"></div>
    <div class="odty-ring"></div>

    <div class="odty-content">

        <div class="odty-icon-wrap">
            <svg viewBox="0 0 24 24">
                <polyline class="odty-check" points="4,13 9,18 20,7"/>
            </svg>
        </div>

        <span class="odty-eyebrow">
            <span class="odty-eyebrow-dot"></span>
            OnDigital
        </span>

        <?php
        $lang     = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';
        $ty_title = $lang === 'az' ? 'Təşəkkür edirik!' : 'Thank you!';
        $ty_sub   = $lang === 'az'
            ? 'Müraciətiniz qəbul edildi. Tezliklə sizinlə əlaqə saxlayacağıq.'
            : 'Your message has been received. We\'ll get back to you shortly.';
        $ty_home  = $lang === 'az' ? 'Ana Səhifə' : 'Home';
        $ty_svcs  = $lang === 'az' ? 'Xidmətlər' : 'Services';
        ?>
        <h1 class="odty-title"><?php echo esc_html( $ty_title ); ?></h1>
        <p class="odty-sub"><?php echo esc_html( $ty_sub ); ?></p>

        <span class="odty-service-tag" id="odty-service-label"></span>

        <div class="odty-ctas">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="odty-btn odty-btn--primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                <?php echo esc_html( $ty_home ); ?>
            </a>
            <a href="<?php echo esc_url( home_url('/xidmetler/') ); ?>" class="odty-btn odty-btn--secondary">
                <?php echo esc_html( $ty_svcs ); ?>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>

    </div>
</div>

<script>
(function(){
    var param = new URLSearchParams(window.location.search).get('xidmet');
    var serviceNames = {
        'seo':          'SEO',
        'google-ads':   'Google Ads',
        'meta-ads':     'Meta Ads',
        'tiktok-ads':   'TikTok Ads',
        'smm':          'SMM',
        'web':          'Web Design',
        'branding':     'Branding',
        'contact':      'Əlaqə Formu',
    };
    if (param && serviceNames[param]) {
        var tag = document.getElementById('odty-service-label');
        if (tag) {
            tag.textContent = serviceNames[param];
            tag.style.display = 'inline-block';
        }
    }

    // GTM conversion push
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({ event: 'form_success', xidmet: param || 'unknown' });
})();
</script>

<?php get_footer(); ?>
