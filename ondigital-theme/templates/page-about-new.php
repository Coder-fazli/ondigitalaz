<?php
/**
 * Template Name: About Us — New
 *
 * @package OnDigital
 */

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'plus-jakarta-sans', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap', array(), null );
    wp_enqueue_style( 'ondigital-default', get_template_directory_uri() . '/assets/css/global.css', array( 'bootstrap' ), ONDIGITAL_VERSION );
    wp_enqueue_style(
        'ondigital-about-new',
        get_template_directory_uri() . '/assets/css/pages/about-new.css',
        array( 'ondigital-default' ),
        @filemtime( get_template_directory() . '/assets/css/pages/about-new.css' ) ?: ONDIGITAL_VERSION
    );
    // Od Forms about page CSS — needed for the inline CTA form
    if ( defined( 'ODF_URI' ) ) {
        wp_enqueue_style( 'odf-about-page', ODF_URI . 'assets/css/forms-about-page.css', array(), defined( 'ODF_VERSION' ) ? ODF_VERSION : '1.0' );
    }
}, 99 );

get_header();

/* Language-aware reader: tries <key>_<lang>, then <key>_en, then legacy <key>, then default. */
$o = function( string $key, string $default = '' ): string {
    return ondigital_get_option( $key, $default );
};

/* ── Funnel stages from options (with hardcoded fallbacks) ── */
$funnel_stages = array(
    array(
        'label'   => $o( 'an_stage1_label',   'Traffic' ),
        'display' => $o( 'an_stage1_display',  '50K' ),
        'cvr'     => $o( 'an_stage1_cvr',      '' ) ?: null,
        'value'   => (int) $o( 'an_stage1_value', '50000' ),
    ),
    array(
        'label'   => $o( 'an_stage2_label',   'Leads' ),
        'display' => $o( 'an_stage2_display',  '8.5K' ),
        'cvr'     => $o( 'an_stage2_cvr',      '17%' ) ?: null,
        'value'   => (int) $o( 'an_stage2_value', '8500' ),
    ),
    array(
        'label'   => $o( 'an_stage3_label',   'Proposals' ),
        'display' => $o( 'an_stage3_display',  '1.7K' ),
        'cvr'     => $o( 'an_stage3_cvr',      '20%' ) ?: null,
        'value'   => (int) $o( 'an_stage3_value', '1700' ),
    ),
    array(
        'label'   => $o( 'an_stage4_label',   'Clients' ),
        'display' => $o( 'an_stage4_display',  '425' ),
        'cvr'     => $o( 'an_stage4_cvr',      '25%' ) ?: null,
        'value'   => (int) $o( 'an_stage4_value', '425' ),
    ),
);
?>

<div class="ab-page">

<!-- ══ HERO ══ -->
<section class="ab-hero">
    <div class="container">
        <div class="ab-hero-inner">
            <div>
                <h1 class="ab-hero-title">
                    <?php echo esc_html( $o( 'an_hero_title_line1', 'We build the' ) ); ?><br>
                    <em><?php echo esc_html( $o( 'an_hero_title_em', 'digital future' ) ); ?></em><br>
                    <?php echo esc_html( $o( 'an_hero_title_line3', 'together' ) ); ?>
                </h1>
                <p class="ab-hero-desc">
                    <?php echo esc_html( $o( 'an_hero_desc', "We don't just deliver services — we rebuild your entire digital ecosystem on a foundation of data, strategy, and technical excellence." ) ); ?>
                </p>
                <div class="ab-hero-btns">
                    <a href="<?php echo esc_url( $o( 'an_hero_btn1_url', '#ab-story' ) ); ?>" class="btn-accent">
                        <?php echo esc_html( $o( 'an_hero_btn1_text', 'Our Story' ) ); ?>
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a href="<?php echo esc_url( $o( 'an_hero_btn2_url', '#ab-cta' ) ); ?>" class="btn-primary">
                        <?php echo esc_html( $o( 'an_hero_btn2_text', 'Get in Touch' ) ); ?>
                    </a>
                </div>
            </div>

            <div>
                <div class="funnel-card">
                    <div class="funnel-card-header">
                        <div class="funnel-card-eyebrow">
                            <span class="funnel-dot"></span><?php echo esc_html( $o( 'an_funnel_eyebrow', 'Client Growth Funnel' ) ); ?>
                        </div>
                        <div class="funnel-card-sub"><?php echo esc_html( $o( 'an_funnel_sub', 'How we turn traffic into paying clients' ) ); ?></div>
                    </div>
                    <svg id="funnel-svg" xmlns="http://www.w3.org/2000/svg" style="display:block;width:100%;overflow:visible;"></svg>
                    <div class="funnel-footer">
                        <div class="funnel-footer-stat">
                            <span class="funnel-footer-num"><?php echo esc_html( $o( 'an_funnel_stat1_num', '4.2×' ) ); ?></span>
                            <span class="funnel-footer-lbl"><?php echo esc_html( $o( 'an_funnel_stat1_lbl', 'Average ROAS' ) ); ?></span>
                        </div>
                        <div class="funnel-footer-divider"></div>
                        <div class="funnel-footer-stat">
                            <span class="funnel-footer-num"><?php echo esc_html( $o( 'an_funnel_stat2_num', '90 days' ) ); ?></span>
                            <span class="funnel-footer-lbl"><?php echo esc_html( $o( 'an_funnel_stat2_lbl', 'To first results' ) ); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ TICKER ══ -->
<?php
$ticker_services = get_posts( array(
    'post_type'      => 'service',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );
?>
<?php if ( $ticker_services ) : ?>
<div class="ab-ticker">
    <div class="ab-ticker-track" aria-label="Our services">
        <?php foreach ( $ticker_services as $svc ) : ?>
        <a class="ab-ticker-item" href="<?php echo esc_url( get_permalink( $svc ) ); ?>" target="_blank" rel="noopener">
            <?php echo esc_html( $svc->post_title ); ?>
        </a>
        <?php endforeach; ?>
        <?php /* Duplicate for seamless infinite scroll */ ?>
        <?php foreach ( $ticker_services as $svc ) : ?>
        <a class="ab-ticker-item" href="<?php echo esc_url( get_permalink( $svc ) ); ?>" target="_blank" rel="noopener" aria-hidden="true" tabindex="-1">
            <?php echo esc_html( $svc->post_title ); ?>
        </a>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- ══ STORY ══ -->
<section class="ab-story" id="ab-story">
    <div class="container">
        <div class="ab-story-inner">
            <div class="ab-story-left">
                <span class="eyebrow"><?php echo esc_html( $o( 'an_story_eyebrow', 'Our Story' ) ); ?></span>
                <h2 class="ab-story-heading">
                    <?php echo esc_html( $o( 'an_story_heading', 'Started in 2020 with one' ) ); ?> <em><?php echo esc_html( $o( 'an_story_heading_em', 'vision' ) ); ?></em>
                </h2>
                <p class="ab-story-desc"><?php echo esc_html( $o( 'an_story_desc1', "OnDigital was born from a gap in the market — there was no agency in Azerbaijan genuinely delivering measurable digital value. We believe in bespoke, data-driven strategies, not off-the-shelf templates." ) ); ?></p>
                <p class="ab-story-desc"><?php echo esc_html( $o( 'an_story_desc2', "We started as a small team with a big mission: to arm Azerbaijani businesses with world-class digital tools and expertise." ) ); ?></p>
                <div class="ab-story-quote">
                    <p>"<?php echo esc_html( $o( 'an_story_quote', "Digital strategy is not a service — it's the core infrastructure of your business." ) ); ?>"</p>
                    <cite><?php echo esc_html( $o( 'an_story_cite', '— Zamin Namazov, Founder & CEO' ) ); ?></cite>
                </div>
            </div>
            <div class="ab-story-right">
                <?php
                $pillar_defaults = array(
                    1 => array( '01 — Mission',  'Drive every business to digital leadership',          'We help our clients stay ahead of the market with data-driven strategies focused on measurable, scalable results.' ),
                    2 => array( '02 — Vision',   'The leading digital agency in the South Caucasus',    'By 2027, to be the most recognised results-oriented digital partner across Azerbaijan, Georgia, and beyond.' ),
                    3 => array( '03 — Approach', 'Transparency, data, accountability',                  'Every step tracked, every result reported. No hidden agendas — we operate as partners, not vendors.' ),
                );
                for ( $n = 1; $n <= 3; $n++ ) : ?>
                <div class="ab-pillar">
                    <div class="ab-pillar-num"><?php echo esc_html( $o( 'an_pillar' . $n . '_num', $pillar_defaults[$n][0] ) ); ?></div>
                    <h3><?php echo esc_html( $o( 'an_pillar' . $n . '_title', $pillar_defaults[$n][1] ) ); ?></h3>
                    <p><?php echo esc_html( $o( 'an_pillar' . $n . '_body', $pillar_defaults[$n][2] ) ); ?></p>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>

<!-- ══ STATS ══ -->
<section class="ab-stats">
    <div class="container">
        <div class="ab-stats-inner">
            <?php
            $stat_icons    = array( 1 => 'fa-calendar-check', 2 => 'fa-handshake', 3 => 'fa-people-group', 4 => 'fa-star' );
            $stat_defaults = array(
                1 => array( '4',  '+', 'Years of experience' ),
                2 => array( '120','+', 'Projects delivered'  ),
                3 => array( '15', '+', 'Team members'        ),
                4 => array( '98', '%', 'Client satisfaction' ),
            );
            for ( $n = 1; $n <= 4; $n++ ) :
                $num    = $o( 'an_stat' . $n . '_num',    $stat_defaults[$n][0] );
                $suffix = $o( 'an_stat' . $n . '_suffix', $stat_defaults[$n][1] );
                $lbl    = $o( 'an_stat' . $n . '_lbl',    $stat_defaults[$n][2] );
            ?>
            <div class="ab-stat">
                <div class="ab-stat-bg"><?php echo esc_html( $num . $suffix ); ?></div>
                <div class="ab-stat-icon"><i class="fa-solid <?php echo esc_attr( $stat_icons[$n] ); ?>"></i></div>
                <div class="ab-stat-num"><?php echo esc_html( $num ); ?><span><?php echo esc_html( $suffix ); ?></span></div>
                <div class="ab-stat-lbl"><?php echo esc_html( $lbl ); ?></div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- ══ VALUES ══ -->
<section class="ab-values">
    <div class="container">
        <div class="ab-values-header">
            <div>
                <span class="eyebrow"><?php echo esc_html( $o( 'an_values_eyebrow', 'Our Values' ) ); ?></span>
                <h2 class="section-title">
                    <?php echo esc_html( $o( 'an_values_heading', 'The' ) ); ?>
                    <em><?php echo esc_html( $o( 'an_values_heading_em', 'foundation' ) ); ?></em>
                    <?php echo esc_html( $o( 'an_values_heading_end', 'of our work' ) ); ?>
                </h2>
            </div>
            <p class="section-sub"><?php echo esc_html( $o( 'an_values_sub', 'The principles behind every decision we make and every strategy we build.' ) ); ?></p>
        </div>
        <div class="ab-values-grid">
            <?php
            $val_defaults = array(
                1 => array( '01', 'fa-chart-line',       'Data-Driven Decisions', 'Every recommendation, every strategy is grounded in real data and analytics — we trust numbers, not gut feelings.',                                                          false ),
                2 => array( '02', 'fa-shield-halved',    'Full Transparency',     "We operate with complete openness. What we do, why we do it, and what it achieves — all shared clearly with every client.",                                                    false ),
                3 => array( '03', 'fa-rocket',           'Continuous Innovation', "The digital world never stops changing. We're always learning, testing new tools, and applying the most effective methodologies.",                                              true  ),
                4 => array( '04', 'fa-handshake-simple', 'Partnership Mindset',   "We see clients as partners, not accounts. Your growth is our growth — that's not a tagline, it's how we operate every day.",                                                    false ),
                5 => array( '05', 'fa-bullseye',         'Results First',         "We don't produce pretty reports — we deliver real outcomes. Every KPI is measured, tracked, and reported with full accountability.",                                             false ),
                6 => array( '06', 'fa-users-gear',       'Team Power',            'SEO, content, ads, design — we have in-house experts for every discipline. Not freelancers, but a cohesive, full-stack ecosystem.',                                            false ),
            );
            for ( $n = 1; $n <= 6; $n++ ) :
                $num   = $o( 'an_val' . $n . '_num',   $val_defaults[$n][0] );
                $icon  = $o( 'an_val' . $n . '_icon',  $val_defaults[$n][1] );
                $title = $o( 'an_val' . $n . '_title', $val_defaults[$n][2] );
                $desc  = $o( 'an_val' . $n . '_desc',  $val_defaults[$n][3] );
                $dark  = $val_defaults[$n][4];
            ?>
            <div class="ab-value-card<?php echo $dark ? ' ab-value-card--accent' : ''; ?>">
                <div class="ab-value-num"><?php echo esc_html( $num ); ?></div>
                <div class="ab-value-icon-wrap"><i class="fa-solid <?php echo esc_attr( $icon ); ?>"></i></div>
                <div class="ab-value-title"><?php echo esc_html( $title ); ?></div>
                <p class="ab-value-desc"><?php echo esc_html( $desc ); ?></p>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- ══ APPROACH ══ -->
<section class="ab-approach">
    <div class="container">
        <div class="ab-approach-inner">
            <div>
                <span class="eyebrow"><?php echo esc_html( $o( 'an_approach_eyebrow', 'How We Work' ) ); ?></span>
                <h2 class="section-title" style="margin-bottom:36px">
                    <?php echo esc_html( $o( 'an_approach_heading', 'Every step of the process is' ) ); ?>
                    <em><?php echo esc_html( $o( 'an_approach_heading_em', 'clear' ) ); ?></em>
                </h2>
                <div class="ab-approach-steps">
                    <?php
                    $step_defaults = array(
                        1 => array( '01', 'Discovery & Audit',          'We run a deep analysis of your current position, competitors, and market. No guesswork, no assumptions.' ),
                        2 => array( '02', 'Strategy Development',       'A bespoke growth roadmap built on data — with measurable targets and clear timelines from day one.' ),
                        3 => array( '03', 'Execution & Optimisation',   'We implement the strategy, monitor results in real time, and iterate continuously for maximum impact.' ),
                        4 => array( '04', 'Reporting & Growth',         'Monthly detailed KPI reports. Every result tracked, every next step decided together with you.' ),
                    );
                    for ( $n = 1; $n <= 4; $n++ ) : ?>
                    <div class="ab-approach-step">
                        <div class="ab-approach-step-num"><?php echo esc_html( $o( 'an_step' . $n . '_num', $step_defaults[$n][0] ) ); ?></div>
                        <div class="ab-approach-step-body">
                            <h3><?php echo esc_html( $o( 'an_step' . $n . '_title', $step_defaults[$n][1] ) ); ?></h3>
                            <p><?php echo esc_html( $o( 'an_step' . $n . '_body', $step_defaults[$n][2] ) ); ?></p>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="ab-approach-visual">
                <div class="ab-av-label"><?php echo esc_html( $o( 'an_av_label', 'Why OnDigital' ) ); ?></div>
                <div class="ab-av-big"><?php echo esc_html( $o( 'an_av_big_num', '100' ) ); ?><span>%</span><br><?php echo esc_html( $o( 'an_av_big_word', 'Bespoke' ) ); ?></div>
                <p class="ab-av-desc"><?php echo esc_html( $o( 'an_av_desc', 'No two clients receive the same strategy. Every business has its own market position, competitors, and target audience.' ) ); ?></p>
                <div class="ab-av-tags">
                    <?php
                    $tag_defaults = array( 'Custom strategy', 'Real-time tracking', 'Monthly reports', 'Transparent pricing', '24h response' );
                    for ( $n = 1; $n <= 5; $n++ ) :
                        $tag = $o( 'an_av_tag' . $n, $tag_defaults[ $n - 1 ] );
                        if ( $tag ) : ?>
                    <span class="ab-av-tag"><?php echo esc_html( $tag ); ?></span>
                    <?php endif; endfor; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ TEAM ══ -->
<section class="ab-team">
    <div class="container">
        <div class="ab-team-header">
            <span class="eyebrow"><?php echo esc_html( $o( 'an_team_eyebrow', 'The Team' ) ); ?></span>
            <h2 class="section-title" style="margin-bottom:14px">
                <?php echo esc_html( $o( 'an_team_heading', 'The' ) ); ?>
                <em><?php echo esc_html( $o( 'an_team_heading_em', 'people' ) ); ?></em>
                <?php echo esc_html( $o( 'an_team_heading_end', 'behind your results' ) ); ?>
            </h2>
            <p class="section-sub"><?php echo esc_html( $o( 'an_team_sub', 'Real in-house experts behind every project — not freelancers, but a dedicated, specialised team.' ) ); ?></p>
        </div>
        <?php
        $team = get_posts( array(
            'post_type'      => 'team_member',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ) );

        /* Build a normalised list of members (real posts, or fallback demo data). */
        $members = array();
        if ( $team ) {
            foreach ( $team as $member ) {
                $members[] = array(
                    'name'  => get_the_title( $member ),
                    'role'  => get_post_meta( $member->ID, '_team_role', true ),
                    'bio'   => get_post_meta( $member->ID, '_team_bio', true ) ?: get_the_excerpt( $member ),
                    'li'    => get_post_meta( $member->ID, '_team_linkedin',  true ),
                    'ig'    => get_post_meta( $member->ID, '_team_instagram', true ),
                    'thumb' => get_the_post_thumbnail_url( $member->ID, 'medium' ),
                );
            }
        } else {
            $fallback = array(
                array( 'Zamin Namazov',  'Founder & CEO',        '8+ years in digital marketing. One of Azerbaijan\'s leading SEO strategists.',             'fa-instagram' ),
                array( 'Ayten Huseynova','Content Director',      '6+ years in strategic content creation and SEO writing across AZ, RU, and EN markets.',   'fa-instagram' ),
                array( 'Rauf Aliyev',    'Technical SEO Lead',    'Core Web Vitals, technical audits, crawl optimisation. Deep expertise in Google systems.', 'fa-github'    ),
                array( 'Nigar Guliyeva', 'Paid Media Strategist', 'Google Ads, Meta Ads, TikTok Ads. Maximum ROAS from minimum budget. $2M+ managed spend.',  'fa-instagram' ),
            );
            foreach ( $fallback as $m ) {
                $members[] = array(
                    'name'  => $m[0], 'role' => $m[1], 'bio' => $m[2],
                    'li'    => '#',   'ig'   => '#',   'thumb' => '',
                );
            }
        }
        ?>
        <div class="ab-team-slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ( $members as $m ) : ?>
                <div class="swiper-slide">
                    <div class="ab-team-card">
                        <div class="ab-team-img">
                            <?php if ( ! empty( $m['thumb'] ) ) : ?>
                                <img src="<?php echo esc_url( $m['thumb'] ); ?>" alt="<?php echo esc_attr( $m['name'] ); ?>" style="width:100%;height:100%;object-fit:cover;">
                            <?php else : ?>
                                <div class="ab-team-img-placeholder"><i class="fa-solid fa-user"></i></div>
                            <?php endif; ?>
                        </div>
                        <div class="ab-team-body">
                            <div class="ab-team-name"><?php echo esc_html( $m['name'] ); ?></div>
                            <?php if ( $m['role'] ) : ?><div class="ab-team-role"><?php echo esc_html( $m['role'] ); ?></div><?php endif; ?>
                            <?php if ( $m['bio'] )  : ?><p class="ab-team-bio"><?php echo esc_html( $m['bio'] ); ?></p><?php endif; ?>
                            <div class="ab-team-socials">
                                <?php if ( $m['li'] ) : ?><a href="<?php echo esc_url( $m['li'] ); ?>" class="ab-team-social" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a><?php endif; ?>
                                <?php if ( $m['ig'] ) : ?><a href="<?php echo esc_url( $m['ig'] ); ?>" class="ab-team-social" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="ab-team-pagination"></div>
        </div>
        <div class="ab-team-nav">
            <button type="button" class="ab-team-arrow ab-team-prev" aria-label="<?php esc_attr_e( 'Previous team members', 'ondigital' ); ?>">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            </button>
            <button type="button" class="ab-team-arrow ab-team-next" aria-label="<?php esc_attr_e( 'Next team members', 'ondigital' ); ?>">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
        </div>
    </div>
</section>

<!-- ══ TIMELINE ══ -->
<section class="ab-timeline">
    <div class="container">
        <div class="ab-timeline-header">
            <span class="eyebrow"><?php echo esc_html( $o( 'an_tl_eyebrow', 'Our Journey' ) ); ?></span>
            <h2 class="section-title" style="margin-bottom:14px">
                <?php echo esc_html( $o( 'an_tl_heading', 'Growth' ) ); ?>
                <em><?php echo esc_html( $o( 'an_tl_heading_em', 'milestones' ) ); ?></em>
            </h2>
        </div>
        <div class="ab-timeline-inner">
            <?php
            $tl_defaults = array(
                1 => array( '2020', 'Foundation',        'OnDigital launched in Baku with a 2-person team. Within 6 months, our first 3 clients reached page 1 on Google.',                 'fa-flag',   'left'  ),
                2 => array( '2021', 'Team Expansion',    'Grew to 8 specialists. Launched dedicated Paid Media and Social Media departments. Client base exceeded 30.',                      'fa-users',  'right' ),
                3 => array( '2022', 'First Regional Win','Expanded into the Georgian market. One of our e-commerce clients achieved a record +380% organic traffic growth.',                 'fa-trophy', 'left'  ),
                4 => array( '2024', 'AI Integration',    'Integrated AI-powered SEO tools into our core workflow. Now serving 120+ active clients with a 15+ person team.',                 'fa-rocket', 'right' ),
            );
            for ( $n = 1; $n <= 4; $n++ ) :
                $year  = $o( 'an_tl' . $n . '_year',  $tl_defaults[$n][0] );
                $title = $o( 'an_tl' . $n . '_title', $tl_defaults[$n][1] );
                $desc  = $o( 'an_tl' . $n . '_desc',  $tl_defaults[$n][2] );
                $icon  = $o( 'an_tl' . $n . '_icon',  $tl_defaults[$n][3] );
                $side  = $tl_defaults[$n][4];
                $right = ( $side === 'right' );
            ?>
            <div class="ab-tl-item<?php echo $right ? ' ab-tl-item--right' : ''; ?>">
                <?php if ( $right ) : ?>
                <div class="ab-tl-empty"></div>
                <div class="ab-tl-center">
                    <div class="ab-tl-dot"><i class="fa-solid <?php echo esc_attr( $icon ); ?>"></i></div>
                </div>
                <div class="ab-tl-content">
                    <div class="ab-tl-year"><?php echo esc_html( $year ); ?></div>
                    <div class="ab-tl-title"><?php echo esc_html( $title ); ?></div>
                    <p class="ab-tl-desc"><?php echo esc_html( $desc ); ?></p>
                </div>
                <?php else : ?>
                <div class="ab-tl-content">
                    <div class="ab-tl-year"><?php echo esc_html( $year ); ?></div>
                    <div class="ab-tl-title"><?php echo esc_html( $title ); ?></div>
                    <p class="ab-tl-desc"><?php echo esc_html( $desc ); ?></p>
                </div>
                <div class="ab-tl-center">
                    <div class="ab-tl-dot"><i class="fa-solid <?php echo esc_attr( $icon ); ?>"></i></div>
                </div>
                <div class="ab-tl-empty"></div>
                <?php endif; ?>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- ══ CTA ══ -->
<section class="ab-cta" id="ab-cta">
    <div class="container">
        <div class="ab-cta-inner">
            <div>
                <span class="ab-cta-eyebrow"><?php echo esc_html( $o( 'an_cta_eyebrow', 'Next Step' ) ); ?></span>
                <h2 class="ab-cta-title">
                    <?php echo esc_html( $o( 'an_cta_title', "Let's grow your business" ) ); ?>
                    <em><?php echo esc_html( $o( 'an_cta_title_em', 'together' ) ); ?></em>
                </h2>
                <p class="ab-cta-sub"><?php echo esc_html( $o( 'an_cta_sub', 'Book a free consultation. We respond within 24 hours.' ) ); ?></p>
                <ul class="ab-cta-perks">
                    <?php
                    $perk_defaults = array( 'Free initial consultation', 'Response within 24 hours', 'Bespoke approach for every business', 'Long-term partnership focus' );
                    for ( $n = 1; $n <= 4; $n++ ) :
                        $perk = $o( 'an_cta_perk' . $n, $perk_defaults[ $n - 1 ] );
                        if ( $perk ) : ?>
                    <li><?php echo esc_html( $perk ); ?></li>
                    <?php endif; endfor; ?>
                </ul>
            </div>
            <div class="ab-cta-form-card">
                <div class="ab-cta-form-title"><?php echo esc_html( $o( 'an_cta_form_title', 'Get in Touch' ) ); ?></div>
                <?php if ( function_exists( 'odf_render_about_page_inline' ) ) : ?>
                    <?php odf_render_about_page_inline(); ?>
                <?php else : ?>
                <div class="ab-form-row">
                    <div class="ab-form-group"><input type="text" placeholder="Your full name"></div>
                    <div class="ab-form-group"><input type="email" placeholder="Email address"></div>
                </div>
                <div class="ab-form-group"><input type="tel" placeholder="Phone number"></div>
                <div class="ab-form-group"><textarea placeholder="Tell us about your project..."></textarea></div>
                <button class="ab-form-submit"><i class="fa-solid fa-paper-plane"></i> Send Message</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

</div><!-- /.ab-page -->

<script>
(function () {
    var stages = <?php echo wp_json_encode( $funnel_stages ); ?>;

    var N = stages.length, total = stages[0].value, STAGGER = 0.1, GAP = 7;
    var TOP_TXT = 38, BOT_TXT = 28, FUNNEL_H = 152, SVG_H = TOP_TXT + FUNNEL_H + BOT_TXT;

    var NS = 'http://www.w3.org/2000/svg';
    function e(tag, attrs) {
        var el = document.createElementNS(NS, tag);
        Object.keys(attrs||{}).forEach(function(k){ el.setAttribute(k, attrs[k]); });
        return el;
    }

    var heights = stages.map(function(s) {
        return Math.round(FUNNEL_H * (0.22 + 0.78 * Math.pow(s.value / total, 0.38)));
    });

    function segPath(x0, x1, hL, hR) {
        var cp = (x1 - x0) * 0.25, midY = TOP_TXT + FUNNEL_H / 2;
        var tlY = midY - hL/2, blY = midY + hL/2;
        var trY = midY - hR/2, brY = midY + hR/2;
        return ['M',x0,tlY,'C',(x0+cp),tlY,(x1-cp),trY,x1,trY,
                'L',x1,brY,'C',(x1-cp),brY,(x0+cp),blY,x0,blY,'Z'].join(' ');
    }

    var svg = document.getElementById('funnel-svg');
    if (!svg) return;
    var SVG_W = svg.getBoundingClientRect().width || 420;
    var SEG_W = (SVG_W - (N - 1) * GAP) / N;

    svg.setAttribute('viewBox', '0 0 ' + SVG_W + ' ' + SVG_H);
    svg.setAttribute('height', SVG_H);

    var defs = e('defs');
    var g1 = e('linearGradient', { id:'fg', gradientUnits:'userSpaceOnUse', x1:'0', y1:'0', x2:SVG_W, y2:'0' });
    g1.appendChild(e('stop', { offset:'0%',   'stop-color':'#c2f971' }));
    g1.appendChild(e('stop', { offset:'100%', 'stop-color':'#4d9c18' }));
    defs.appendChild(g1);
    var g2 = e('linearGradient', { id:'fg2', gradientUnits:'userSpaceOnUse', x1:'0', y1:'0', x2:SVG_W, y2:'0' });
    g2.appendChild(e('stop', { offset:'0%',   'stop-color':'#a0d655' }));
    g2.appendChild(e('stop', { offset:'100%', 'stop-color':'#336810' }));
    defs.appendChild(g2);
    var filt = e('filter', { id:'fs', x:'-4%', y:'-15%', width:'108%', height:'138%' });
    filt.appendChild(e('feDropShadow', { dx:'0', dy:'4', stdDeviation:'5', 'flood-color':'rgba(0,0,0,0.12)' }));
    defs.appendChild(filt);
    svg.appendChild(defs);

    var segsG = e('g', { class:'funnel-segs' });
    svg.appendChild(segsG);

    stages.forEach(function(s, i) {
        var x0 = i*(SEG_W+GAP), x1 = x0+SEG_W, midX = (x0+x1)/2;
        var hL = heights[i], hR = (i<N-1) ? heights[i+1] : Math.round(heights[i]*0.66);
        var delay = i*STAGGER, midFY = TOP_TXT+FUNNEL_H/2, isLast = (i===N-1);

        var segG = e('g', { class:'funnel-seg' });
        segsG.appendChild(segG);

        segG.appendChild(e('rect', { x:x0, y:TOP_TXT, width:SEG_W, height:FUNNEL_H, rx:'8',
            fill: isLast ? 'rgba(194,249,113,0.14)' : '#f2f2f2',
            style:'animation:funnel-fade .25s ease '+delay+'s both;'
        }));
        segG.appendChild(e('path', { d:segPath(x0,x1,Math.max(4,hL-10),Math.max(4,hR-10)),
            fill:'url(#fg2)', opacity:'0.35', transform:'translate(0,5)' }));
        segG.appendChild(e('path', { d:segPath(x0,x1,hL,hR), fill:'url(#fg)', filter:'url(#fs)',
            style:'transform-origin:'+midX+'px '+midFY+'px;animation:funnel-rise .5s cubic-bezier(.22,1,.36,1) '+delay+'s both;'
        }));

        if (s.cvr && (hL+hR)/2 > 24) {
            segG.appendChild(Object.assign(e('text', {
                x:midX, y:midFY+1, 'text-anchor':'middle', 'dominant-baseline':'middle',
                fill:'rgba(0,0,0,0.65)', 'font-size':'11.5', 'font-weight':'700',
                'font-family':'Plus Jakarta Sans, sans-serif',
                style:'animation:funnel-fade .35s ease '+(delay+.2)+'s both;pointer-events:none;'
            }), {textContent:s.cvr}));
        }
        segG.appendChild(Object.assign(e('text', {
            x:midX, y:TOP_TXT/2+2, 'text-anchor':'middle', 'dominant-baseline':'middle',
            fill:'#111111', 'font-size':'15', 'font-weight':'800', 'letter-spacing':'-0.03em',
            'font-family':'Plus Jakarta Sans, sans-serif',
            style:'animation:funnel-fade .35s ease '+delay+'s both;'
        }), {textContent:s.display}));
        segG.appendChild(Object.assign(e('text', {
            x:midX, y:TOP_TXT+FUNNEL_H+BOT_TXT/2+3,
            'text-anchor':'middle', 'dominant-baseline':'middle',
            fill: isLast ? '#4e6e00' : '#777',
            'font-size':'11', 'font-weight': isLast ? '700' : '600',
            'font-family':'Plus Jakarta Sans, sans-serif',
            style:'animation:funnel-fade .35s ease '+(delay+.12)+'s both;'
        }), {textContent:s.label}));

        (function(g){
            g.addEventListener('mouseenter', function(){ segsG.classList.add('funnel-segs-dimmed'); g.classList.add('is-hovered'); });
            g.addEventListener('mouseleave', function(){ segsG.classList.remove('funnel-segs-dimmed'); g.classList.remove('is-hovered'); });
        })(segG);
    });
})();
</script>

<script>
(function () {
    function initTeamSlider() {
        if (typeof Swiper === 'undefined') { return; }
        var el = document.querySelector('.ab-team-slider');
        if (!el || el.dataset.inited) { return; }
        el.dataset.inited = '1';

        new Swiper(el, {
            slidesPerView: 1,
            spaceBetween: 24,
            grabCursor: true,
            watchOverflow: true,
            navigation: {
                prevEl: '.ab-team-prev',
                nextEl: '.ab-team-next',
            },
            pagination: {
                el: '.ab-team-pagination',
                clickable: true,
            },
            breakpoints: {
                600:  { slidesPerView: 2, spaceBetween: 24 },
                992:  { slidesPerView: 3, spaceBetween: 24 },
                1200: { slidesPerView: 4, spaceBetween: 24 },
            },
        });
    }

    if (document.readyState !== 'loading') {
        initTeamSlider();
    } else {
        document.addEventListener('DOMContentLoaded', initTeamSlider);
    }
}());
</script>

<?php get_footer(); ?>
