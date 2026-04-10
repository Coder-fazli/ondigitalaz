<?php
/**
 * Project Details — Hero Section
 *
 * @package OnDigital
 */

$tag           = ondigital_get_option( 'project_tag',           'Case Study — Education · 2025' );
$title_main    = ondigital_get_option( 'project_title_main',    'Alas Academy' );
$title_hl      = ondigital_get_option( 'project_title_hl',      'Ondigital' );
$meta_date     = ondigital_get_option( 'project_meta_date',     'Jan – May 2025' );
$meta_client   = ondigital_get_option( 'project_meta_client',   'Alas Academy' );
$meta_services = ondigital_get_option( 'project_meta_services', 'Web · SEO · Paid Ads · Email' );
$meta_outcome  = ondigital_get_option( 'project_meta_outcome',  '+340% Revenue · 4 months' );
$live_url      = ondigital_get_option( 'project_live_url',      '' );

// Stats for floating cards (reuse results data)
$stat1_val    = ondigital_get_option( 'project_stat1_value',  '340' );
$stat1_suffix = ondigital_get_option( 'project_stat1_suffix', '%' );
$stat1_label  = ondigital_get_option( 'project_stat1_label',  '' );
$stat3_val    = ondigital_get_option( 'project_stat3_value',  '62' );
$stat3_suffix = ondigital_get_option( 'project_stat3_suffix', '%' );
?>
<section class="cs-hero">

    <!-- Decorative elements -->
    <div class="cs-aline-top"></div>
    <div class="cs-aline-bot"></div>
    <div class="cs-a-circle"></div>
    <div class="cs-a-circle2"></div>
    <div class="cs-a-dot"></div>
    <div class="cs-a-square"></div>
    <div class="cs-a-dot2"></div>
    <div class="cs-a-square2"></div>
    <div class="cs-a-dash"></div>

    <!-- Floating metric cards -->
    <div class="cs-hero-cards" aria-hidden="true">

        <div class="cs-hc cs-hc1">
            <div class="cs-hc-label"><?php esc_html_e( 'Revenue Growth', 'ondigital' ); ?></div>
            <div class="cs-hc-big">+<?php echo esc_html( $stat1_val . $stat1_suffix ); ?></div>
            <div class="cs-hc-sub"><?php esc_html_e( 'vs. same period last year', 'ondigital' ); ?></div>
            <div class="cs-hc-chart">
                <span style="height:22%"></span>
                <span style="height:30%"></span>
                <span style="height:38%"></span>
                <span style="height:44%"></span>
                <span style="height:55%"></span>
                <span style="height:64%"></span>
                <span class="cs-mid" style="height:80%"></span>
                <span class="cs-hi"  style="height:100%"></span>
            </div>
        </div>

        <div class="cs-hc cs-hc2">
            <div class="cs-hc-notif-top">
                <div class="cs-hc-dot"></div>
                <span><?php esc_html_e( 'New Order', 'ondigital' ); ?></span>
                <span class="cs-hc-time"><?php esc_html_e( 'just now', 'ondigital' ); ?></span>
            </div>
            <div class="cs-hc-brand"><?php echo esc_html( $meta_client ?: 'Client' ); ?></div>
            <div class="cs-hc-price">€1,240<small style="font-size:14px;font-weight:600;opacity:.5">.00</small></div>
            <div class="cs-hc-price-sub">+12 <?php esc_html_e( 'orders today', 'ondigital' ); ?></div>
        </div>

        <div class="cs-hc cs-hc3">
            <div class="cs-hc-label"><?php esc_html_e( 'Conversion Rate', 'ondigital' ); ?></div>
            <div class="cs-hc3-top">
                <div class="cs-hc-big" style="font-size:36px">3.8%</div>
                <div class="cs-hc-trend">↑ from 0.8%</div>
            </div>
            <div class="cs-hc-bar-track"><div class="cs-hc-bar-fill"></div></div>
            <div class="cs-hc-bar-labs">
                <span><?php esc_html_e( 'Before', 'ondigital' ); ?></span>
                <span><?php esc_html_e( 'After', 'ondigital' ); ?></span>
            </div>
        </div>

        <div class="cs-hc cs-hc4">
            <div class="cs-hc-icon">
                <svg viewBox="0 0 24 24"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
            </div>
            <div class="cs-hc-label"><?php esc_html_e( 'Organic Traffic', 'ondigital' ); ?></div>
            <div class="cs-hc-big">+298%</div>
        </div>

        <div class="cs-hc cs-hc5">
            <div class="cs-hc-label"><?php esc_html_e( 'Return on Ad Spend', 'ondigital' ); ?></div>
            <div class="cs-hc-big">4.2×</div>
            <div class="cs-hc-sub"><?php esc_html_e( 'ROAS across all channels', 'ondigital' ); ?></div>
            <div class="cs-hc5-foot">
                <div class="cs-hc5-dot"></div>
                <span>Google · Meta · Email</span>
            </div>
        </div>

    </div>

    <!-- Mobile performance panel -->
    <div class="cs-hero-panel" aria-hidden="true">
        <div class="cs-hp-accent"></div>
        <div class="cs-hp-head">
            <div class="cs-hp-live"><div class="cs-hp-live-dot"></div><?php esc_html_e( 'Campaign Active', 'ondigital' ); ?></div>
            <div class="cs-hp-date"><?php echo esc_html( $meta_date ); ?></div>
        </div>
        <div class="cs-hp-main">
            <div class="cs-hp-big">+<?php echo esc_html( $stat1_val . $stat1_suffix ); ?></div>
            <div class="cs-hp-big-lbl"><?php esc_html_e( 'Revenue Growth', 'ondigital' ); ?></div>
            <div class="cs-hp-bar-wrap">
                <span style="height:22%"></span><span style="height:30%"></span>
                <span style="height:40%"></span><span style="height:50%"></span>
                <span style="height:62%"></span><span class="a" style="height:75%"></span>
                <span class="a" style="height:88%"></span><span class="b" style="height:100%"></span>
            </div>
        </div>
        <div class="cs-hp-stats">
            <div class="cs-hp-stat"><div class="cs-hp-sn">3.8%</div><div class="cs-hp-sl"><?php esc_html_e( 'Conv Rate', 'ondigital' ); ?></div></div>
            <div class="cs-hp-stat"><div class="cs-hp-sn">+298%</div><div class="cs-hp-sl"><?php esc_html_e( 'Organic', 'ondigital' ); ?></div></div>
            <div class="cs-hp-stat"><div class="cs-hp-sn">4.2×</div><div class="cs-hp-sl">ROAS</div></div>
        </div>
    </div>

    <!-- Main content -->
    <div class="cs-hero-content">
        <div class="cs-hero-tag cs-fade">
            <div class="cs-tag-dot"></div>
            <?php echo esc_html( $tag ); ?>
        </div>

        <h1 class="cs-hero-title cs-fade cs-d1">
            <?php echo esc_html( $title_main ); ?><br>
            × <span class="cs-hl"><?php echo esc_html( $title_hl ); ?></span>
        </h1>

        <div class="cs-hero-meta cs-fade cs-d2">
            <?php if ( $meta_date ) : ?>
                <div class="cs-m-item">
                    <div class="cs-m-lbl"><?php esc_html_e( 'Date', 'ondigital' ); ?></div>
                    <div class="cs-m-val"><?php echo esc_html( $meta_date ); ?></div>
                </div>
            <?php endif; ?>
            <?php if ( $meta_client ) : ?>
                <div class="cs-m-item">
                    <div class="cs-m-lbl"><?php esc_html_e( 'Client', 'ondigital' ); ?></div>
                    <div class="cs-m-val"><?php echo esc_html( $meta_client ); ?></div>
                </div>
            <?php endif; ?>
            <?php if ( $meta_services ) : ?>
                <div class="cs-m-item">
                    <div class="cs-m-lbl"><?php esc_html_e( 'Services', 'ondigital' ); ?></div>
                    <div class="cs-m-val"><?php echo esc_html( $meta_services ); ?></div>
                </div>
            <?php endif; ?>
            <?php if ( $meta_outcome ) : ?>
                <div class="cs-m-item">
                    <div class="cs-m-lbl"><?php esc_html_e( 'Outcome', 'ondigital' ); ?></div>
                    <div class="cs-m-val"><?php echo esc_html( $meta_outcome ); ?></div>
                </div>
            <?php endif; ?>
            <?php if ( $live_url ) : ?>
                <a class="cs-m-link" href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e( 'View live site', 'ondigital' ); ?>
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
            <?php endif; ?>
        </div>
    </div>

</section>
