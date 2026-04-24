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
}, 99 );

get_header();
?>

<div class="ab-page">

<!-- ══ HERO ══ -->
<section class="ab-hero">
    <div class="container">
        <div class="ab-hero-inner">
            <div>
                <h1 class="ab-hero-title">
                    We build the<br><em>digital future</em><br>together
                </h1>
                <p class="ab-hero-desc">
                    We don't just deliver services — we rebuild your entire digital ecosystem on a foundation of data, strategy, and technical excellence.
                </p>
                <div class="ab-hero-btns">
                    <a href="#ab-story" class="btn-accent">
                        Our Story
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a href="#ab-cta" class="btn-primary">Get in Touch</a>
                </div>
            </div>

            <div>
                <div class="funnel-card">
                    <div class="funnel-card-header">
                        <div class="funnel-card-eyebrow">
                            <span class="funnel-dot"></span>Client Growth Funnel
                        </div>
                        <div class="funnel-card-sub">How we turn traffic into paying clients</div>
                    </div>
                    <svg id="funnel-svg" xmlns="http://www.w3.org/2000/svg" style="display:block;width:100%;overflow:visible;"></svg>
                    <div class="funnel-footer">
                        <div class="funnel-footer-stat">
                            <span class="funnel-footer-num">4.2×</span>
                            <span class="funnel-footer-lbl">Average ROAS</span>
                        </div>
                        <div class="funnel-footer-divider"></div>
                        <div class="funnel-footer-stat">
                            <span class="funnel-footer-num">90 days</span>
                            <span class="funnel-footer-lbl">To first results</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ TICKER ══ -->
<div class="ab-ticker">
    <div class="ab-ticker-track">
        <span class="ab-ticker-item">SEO Strategy</span>
        <span class="ab-ticker-item">Digital Marketing</span>
        <span class="ab-ticker-item">Content Strategy</span>
        <span class="ab-ticker-item">Social Media</span>
        <span class="ab-ticker-item">Google Ads</span>
        <span class="ab-ticker-item">Web Design</span>
        <span class="ab-ticker-item">Branding</span>
        <span class="ab-ticker-item">Analytics</span>
        <span class="ab-ticker-item">SEO Strategy</span>
        <span class="ab-ticker-item">Digital Marketing</span>
        <span class="ab-ticker-item">Content Strategy</span>
        <span class="ab-ticker-item">Social Media</span>
        <span class="ab-ticker-item">Google Ads</span>
        <span class="ab-ticker-item">Web Design</span>
        <span class="ab-ticker-item">Branding</span>
        <span class="ab-ticker-item">Analytics</span>
    </div>
</div>

<!-- ══ STORY ══ -->
<section class="ab-story" id="ab-story">
    <div class="container">
        <div class="ab-story-inner">
            <div class="ab-story-left">
                <span class="eyebrow">Our Story</span>
                <h2 class="ab-story-heading">
                    Started in 2020<br>with one <em>vision</em>
                </h2>
                <p class="ab-story-desc">
                    OnDigital was born from a gap in the market — there was no agency in Azerbaijan genuinely delivering measurable digital value. We believe in bespoke, data-driven strategies, not off-the-shelf templates.
                </p>
                <p class="ab-story-desc">
                    We started as a small team with a big mission: to arm Azerbaijani businesses with world-class digital tools and expertise.
                </p>
                <div class="ab-story-quote">
                    <p>"Digital strategy is not a service — it's the core infrastructure of your business."</p>
                    <cite>— Zamin Namazov, Founder & CEO</cite>
                </div>
            </div>
            <div class="ab-story-right">
                <div class="ab-pillar">
                    <div class="ab-pillar-num">01 — Mission</div>
                    <h3>Drive every business to digital leadership</h3>
                    <p>We help our clients stay ahead of the market with data-driven strategies focused on measurable, scalable results.</p>
                </div>
                <div class="ab-pillar">
                    <div class="ab-pillar-num">02 — Vision</div>
                    <h3>The leading digital agency in the South Caucasus</h3>
                    <p>By 2027, to be the most recognised results-oriented digital partner across Azerbaijan, Georgia, and beyond.</p>
                </div>
                <div class="ab-pillar">
                    <div class="ab-pillar-num">03 — Approach</div>
                    <h3>Transparency, data, accountability</h3>
                    <p>Every step tracked, every result reported. No hidden agendas — we operate as partners, not vendors.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ STATS ══ -->
<section class="ab-stats">
    <div class="container">
        <div class="ab-stats-inner">
            <div class="ab-stat">
                <div class="ab-stat-bg">4+</div>
                <div class="ab-stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div class="ab-stat-num">4<span>+</span></div>
                <div class="ab-stat-lbl">Years of experience</div>
            </div>
            <div class="ab-stat">
                <div class="ab-stat-bg">120</div>
                <div class="ab-stat-icon"><i class="fa-solid fa-handshake"></i></div>
                <div class="ab-stat-num">120<span>+</span></div>
                <div class="ab-stat-lbl">Projects delivered</div>
            </div>
            <div class="ab-stat">
                <div class="ab-stat-bg">15</div>
                <div class="ab-stat-icon"><i class="fa-solid fa-people-group"></i></div>
                <div class="ab-stat-num">15<span>+</span></div>
                <div class="ab-stat-lbl">Team members</div>
            </div>
            <div class="ab-stat">
                <div class="ab-stat-bg">98</div>
                <div class="ab-stat-icon"><i class="fa-solid fa-star"></i></div>
                <div class="ab-stat-num">98<span>%</span></div>
                <div class="ab-stat-lbl">Client satisfaction</div>
            </div>
        </div>
    </div>
</section>

<!-- ══ VALUES ══ -->
<section class="ab-values">
    <div class="container">
        <div class="ab-values-header">
            <div>
                <span class="eyebrow">Our Values</span>
                <h2 class="section-title">The <em>foundation</em> of our work</h2>
            </div>
            <p class="section-sub">The principles behind every decision we make and every strategy we build.</p>
        </div>
        <div class="ab-values-grid">
            <div class="ab-value-card">
                <div class="ab-value-num">01</div>
                <div class="ab-value-icon-wrap"><i class="fa-solid fa-chart-line"></i></div>
                <div class="ab-value-title">Data-Driven Decisions</div>
                <p class="ab-value-desc">Every recommendation, every strategy is grounded in real data and analytics — we trust numbers, not gut feelings.</p>
            </div>
            <div class="ab-value-card">
                <div class="ab-value-num">02</div>
                <div class="ab-value-icon-wrap"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="ab-value-title">Full Transparency</div>
                <p class="ab-value-desc">We operate with complete openness. What we do, why we do it, and what it achieves — all shared clearly with every client.</p>
            </div>
            <div class="ab-value-card ab-value-card--accent">
                <div class="ab-value-num">03</div>
                <div class="ab-value-icon-wrap"><i class="fa-solid fa-rocket"></i></div>
                <div class="ab-value-title">Continuous Innovation</div>
                <p class="ab-value-desc">The digital world never stops changing. We're always learning, testing new tools, and applying the most effective methodologies.</p>
            </div>
            <div class="ab-value-card">
                <div class="ab-value-num">04</div>
                <div class="ab-value-icon-wrap"><i class="fa-solid fa-handshake-simple"></i></div>
                <div class="ab-value-title">Partnership Mindset</div>
                <p class="ab-value-desc">We see clients as partners, not accounts. Your growth is our growth — that's not a tagline, it's how we operate every day.</p>
            </div>
            <div class="ab-value-card">
                <div class="ab-value-num">05</div>
                <div class="ab-value-icon-wrap"><i class="fa-solid fa-bullseye"></i></div>
                <div class="ab-value-title">Results First</div>
                <p class="ab-value-desc">We don't produce pretty reports — we deliver real outcomes. Every KPI is measured, tracked, and reported with full accountability.</p>
            </div>
            <div class="ab-value-card">
                <div class="ab-value-num">06</div>
                <div class="ab-value-icon-wrap"><i class="fa-solid fa-users-gear"></i></div>
                <div class="ab-value-title">Team Power</div>
                <p class="ab-value-desc">SEO, content, ads, design — we have in-house experts for every discipline. Not freelancers, but a cohesive, full-stack ecosystem.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══ APPROACH ══ -->
<section class="ab-approach">
    <div class="container">
        <div class="ab-approach-inner">
            <div>
                <span class="eyebrow">How We Work</span>
                <h2 class="section-title" style="margin-bottom:36px">Every step of<br>the process is <em>clear</em></h2>
                <div class="ab-approach-steps">
                    <div class="ab-approach-step">
                        <div class="ab-approach-step-num">01</div>
                        <div class="ab-approach-step-body">
                            <h3>Discovery & Audit</h3>
                            <p>We run a deep analysis of your current position, competitors, and market. No guesswork, no assumptions.</p>
                        </div>
                    </div>
                    <div class="ab-approach-step">
                        <div class="ab-approach-step-num">02</div>
                        <div class="ab-approach-step-body">
                            <h3>Strategy Development</h3>
                            <p>A bespoke growth roadmap built on data — with measurable targets and clear timelines from day one.</p>
                        </div>
                    </div>
                    <div class="ab-approach-step">
                        <div class="ab-approach-step-num">03</div>
                        <div class="ab-approach-step-body">
                            <h3>Execution & Optimisation</h3>
                            <p>We implement the strategy, monitor results in real time, and iterate continuously for maximum impact.</p>
                        </div>
                    </div>
                    <div class="ab-approach-step">
                        <div class="ab-approach-step-num">04</div>
                        <div class="ab-approach-step-body">
                            <h3>Reporting & Growth</h3>
                            <p>Monthly detailed KPI reports. Every result tracked, every next step decided together with you.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ab-approach-visual">
                <div class="ab-av-label">Why OnDigital</div>
                <div class="ab-av-big">100<span>%</span><br>Bespoke</div>
                <p class="ab-av-desc">No two clients receive the same strategy. Every business has its own market position, competitors, and target audience.</p>
                <div class="ab-av-tags">
                    <span class="ab-av-tag">Custom strategy</span>
                    <span class="ab-av-tag">Real-time tracking</span>
                    <span class="ab-av-tag">Monthly reports</span>
                    <span class="ab-av-tag">Transparent pricing</span>
                    <span class="ab-av-tag">24h response</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ TEAM ══ -->
<section class="ab-team">
    <div class="container">
        <div class="ab-team-header">
            <span class="eyebrow">The Team</span>
            <h2 class="section-title" style="margin-bottom:14px">The <em>people</em> behind your results</h2>
            <p class="section-sub">Real in-house experts behind every project — not freelancers, but a dedicated, specialised team.</p>
        </div>
        <div class="ab-team-grid">
            <?php
            $team = get_posts( array(
                'post_type'      => 'team_member',
                'posts_per_page' => 4,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ) );

            if ( $team ) :
                foreach ( $team as $member ) :
                    $name  = get_the_title( $member );
                    $role  = get_post_meta( $member->ID, '_team_role',  true );
                    $bio   = get_post_meta( $member->ID, '_team_bio',   true ) ?: get_the_excerpt( $member );
                    $li    = get_post_meta( $member->ID, '_team_linkedin', true );
                    $ig    = get_post_meta( $member->ID, '_team_instagram', true );
                    $thumb = get_the_post_thumbnail_url( $member->ID, 'medium' );
            ?>
            <div class="ab-team-card">
                <div class="ab-team-img">
                    <?php if ( $thumb ) : ?>
                        <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $name ); ?>" style="width:100%;height:100%;object-fit:cover;">
                    <?php else : ?>
                        <div class="ab-team-img-placeholder"><i class="fa-solid fa-user"></i></div>
                    <?php endif; ?>
                </div>
                <div class="ab-team-body">
                    <div class="ab-team-name"><?php echo esc_html( $name ); ?></div>
                    <?php if ( $role ) : ?>
                        <div class="ab-team-role"><?php echo esc_html( $role ); ?></div>
                    <?php endif; ?>
                    <?php if ( $bio ) : ?>
                        <p class="ab-team-bio"><?php echo esc_html( $bio ); ?></p>
                    <?php endif; ?>
                    <div class="ab-team-socials">
                        <?php if ( $li ) : ?>
                            <a href="<?php echo esc_url( $li ); ?>" class="ab-team-social" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a>
                        <?php endif; ?>
                        <?php if ( $ig ) : ?>
                            <a href="<?php echo esc_url( $ig ); ?>" class="ab-team-social" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
            else :
            ?>
            <div class="ab-team-card">
                <div class="ab-team-img"><div class="ab-team-img-placeholder"><i class="fa-solid fa-user"></i></div></div>
                <div class="ab-team-body">
                    <div class="ab-team-name">Zamin Namazov</div>
                    <div class="ab-team-role">Founder & CEO</div>
                    <p class="ab-team-bio">8+ years in digital marketing. One of Azerbaijan's leading SEO strategists and growth consultants.</p>
                    <div class="ab-team-socials">
                        <a href="#" class="ab-team-social"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="ab-team-social"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="ab-team-card">
                <div class="ab-team-img"><div class="ab-team-img-placeholder"><i class="fa-solid fa-user"></i></div></div>
                <div class="ab-team-body">
                    <div class="ab-team-name">Ayten Huseynova</div>
                    <div class="ab-team-role">Content Director</div>
                    <p class="ab-team-bio">6+ years in strategic content creation and SEO writing across Azerbaijani, Russian, and English markets.</p>
                    <div class="ab-team-socials">
                        <a href="#" class="ab-team-social"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="ab-team-social"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="ab-team-card">
                <div class="ab-team-img"><div class="ab-team-img-placeholder"><i class="fa-solid fa-user"></i></div></div>
                <div class="ab-team-body">
                    <div class="ab-team-name">Rauf Aliyev</div>
                    <div class="ab-team-role">Technical SEO Lead</div>
                    <p class="ab-team-bio">Core Web Vitals, technical audits, crawl optimisation. Deep expertise in Google's technical ranking systems.</p>
                    <div class="ab-team-socials">
                        <a href="#" class="ab-team-social"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="ab-team-social"><i class="fa-brands fa-github"></i></a>
                    </div>
                </div>
            </div>
            <div class="ab-team-card">
                <div class="ab-team-img"><div class="ab-team-img-placeholder"><i class="fa-solid fa-user"></i></div></div>
                <div class="ab-team-body">
                    <div class="ab-team-name">Nigar Guliyeva</div>
                    <div class="ab-team-role">Paid Media Strategist</div>
                    <p class="ab-team-bio">Google Ads, Meta Ads, TikTok Ads. Maximum ROAS from minimum budget. $2M+ in managed ad spend.</p>
                    <div class="ab-team-socials">
                        <a href="#" class="ab-team-social"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="ab-team-social"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ══ TIMELINE ══ -->
<section class="ab-timeline">
    <div class="container">
        <div class="ab-timeline-header">
            <span class="eyebrow">Our Journey</span>
            <h2 class="section-title" style="margin-bottom:14px">Growth <em>milestones</em></h2>
        </div>
        <div class="ab-timeline-inner">

            <div class="ab-tl-item">
                <div class="ab-tl-content">
                    <div class="ab-tl-year">2020</div>
                    <div class="ab-tl-title">Foundation</div>
                    <p class="ab-tl-desc">OnDigital launched in Baku with a 2-person team. Within 6 months, our first 3 clients reached page 1 on Google.</p>
                </div>
                <div class="ab-tl-center"><div class="ab-tl-dot"><i class="fa-solid fa-flag"></i></div></div>
                <div class="ab-tl-empty"></div>
            </div>

            <div class="ab-tl-item ab-tl-item--right">
                <div class="ab-tl-empty"></div>
                <div class="ab-tl-center"><div class="ab-tl-dot"><i class="fa-solid fa-users"></i></div></div>
                <div class="ab-tl-content">
                    <div class="ab-tl-year">2021</div>
                    <div class="ab-tl-title">Team Expansion</div>
                    <p class="ab-tl-desc">Grew to 8 specialists. Launched dedicated Paid Media and Social Media departments. Client base exceeded 30.</p>
                </div>
            </div>

            <div class="ab-tl-item">
                <div class="ab-tl-content">
                    <div class="ab-tl-year">2022</div>
                    <div class="ab-tl-title">First Regional Win</div>
                    <p class="ab-tl-desc">Expanded into the Georgian market. One of our e-commerce clients achieved a record +380% organic traffic growth.</p>
                </div>
                <div class="ab-tl-center"><div class="ab-tl-dot"><i class="fa-solid fa-trophy"></i></div></div>
                <div class="ab-tl-empty"></div>
            </div>

            <div class="ab-tl-item ab-tl-item--right">
                <div class="ab-tl-empty"></div>
                <div class="ab-tl-center"><div class="ab-tl-dot"><i class="fa-solid fa-rocket"></i></div></div>
                <div class="ab-tl-content">
                    <div class="ab-tl-year">2024</div>
                    <div class="ab-tl-title">AI Integration</div>
                    <p class="ab-tl-desc">Integrated AI-powered SEO tools into our core workflow. Now serving 120+ active clients with a 15+ person team.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══ CTA ══ -->
<section class="ab-cta" id="ab-cta">
    <div class="container">
        <div class="ab-cta-inner">
            <div>
                <span class="ab-cta-eyebrow">Next Step</span>
                <h2 class="ab-cta-title">Let's grow your<br>business <em>together</em></h2>
                <p class="ab-cta-sub">Book a free consultation. We respond within 24 hours.</p>
                <ul class="ab-cta-perks">
                    <li>Free initial consultation</li>
                    <li>Response within 24 hours</li>
                    <li>Bespoke approach for every business</li>
                    <li>Long-term partnership focus</li>
                </ul>
            </div>
            <div class="ab-cta-form-card">
                <div class="ab-cta-form-title">Get in Touch</div>
                <?php if ( function_exists( 'odf_render_contact_page_inline' ) ) : ?>
                    <?php odf_render_contact_page_inline(); ?>
                <?php else : ?>
                <div class="ab-form-row">
                    <div class="ab-form-group"><input type="text" placeholder="Your full name"></div>
                    <div class="ab-form-group"><input type="email" placeholder="Email address"></div>
                </div>
                <div class="ab-form-group"><input type="tel" placeholder="Phone number"></div>
                <div class="ab-form-group"><textarea placeholder="Tell us about your project..."></textarea></div>
                <button class="ab-form-submit">
                    <i class="fa-solid fa-paper-plane"></i> Send Message
                </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

</div><!-- /.ab-page -->

<script>
(function () {
    var stages = [
        { label: 'Traffic',   value: 50000, display: '50K',   cvr: null   },
        { label: 'Leads',     value: 8500,  display: '8.5K',  cvr: '17%'  },
        { label: 'Proposals', value: 1700,  display: '1.7K',  cvr: '20%'  },
        { label: 'Clients',   value: 425,   display: '425',   cvr: '25%'  },
    ];

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

<?php get_footer(); ?>
