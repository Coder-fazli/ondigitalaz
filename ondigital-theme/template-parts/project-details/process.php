<?php
/**
 * Project Details — Process / Steps Section
 *
 * @package OnDigital
 */

$eyebrow = ondigital_get_option( 'project_process_eyebrow', __( 'Our Process', 'ondigital' ) );
$heading = ondigital_get_option( 'project_process_heading', __( 'How we made it happen.', 'ondigital' ) );
$steps   = ondigital_get_repeater( 'project_steps', array() );

// Default demo steps shown until admin fills in real data
if ( empty( $steps ) ) {
    $steps = array(
        array( 'title_az' => 'Kəşfiyyat',          'title_en' => 'Discovery',       'desc_az' => 'Analitika və reklam xərclərinin tam auditi, müştəri müsahibələri və rəqib analizi.',                                       'desc_en' => 'Full audit of analytics & ad spend, customer interviews, and deep competitor benchmarking to find the real growth gaps.',               'duration' => '2 weeks' ),
        array( 'title_az' => 'Strategiya',           'title_en' => 'Strategy',        'desc_az' => 'Tam huni arxitekturası, auditoriya seqmentasiyası, media kanalı qarışığı və konversiyaya yönəlmiş məzmun strategiyası.',    'desc_en' => 'Full-funnel architecture, audience segmentation, media channel mix, and a content strategy built around conversion — not just traffic.', 'duration' => '2 weeks' ),
        array( 'title_az' => 'Dizayn & Qurulum',    'title_en' => 'Design & Build',  'desc_az' => 'Yeni yüksək konversiyalı vebsayt, reklam kreativləri, e-poçt avtomatlaşdırması və CRO-optimizasiyalı açılış səhifələri.', 'desc_en' => 'New high-converting website, ad creatives, email automation flows, and CRO-optimized landing pages — all built from scratch.',           'duration' => '6 weeks' ),
        array( 'title_az' => 'Buraxılış & Miqyas',  'title_en' => 'Launch & Scale',  'desc_az' => 'Canlı kampaniyalar, davamlı A/B testləri, həftəlik performans icmalları və aylıq strateji görüşlər.',                       'desc_en' => 'Go live with campaigns, continuous A/B testing, weekly performance reviews, and monthly strategy calls to keep scaling profitably.',      'duration' => 'Ongoing' ),
    );
}

// Per-step SVG icons (fixed set of 4, loops if more steps added)
$icons = array(
    '<svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
    '<svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>',
    '<svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>',
    '<svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
    '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
);

$lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';
?>
<section class="cs-section cs-process-sec">
    <div class="cs-inner">
        <div class="cs-stag cs-fade"><?php echo esc_html( $eyebrow ); ?></div>
        <h2 class="cs-process-heading cs-fade cs-d1"><?php echo esc_html( $heading ); ?></h2>

        <div class="cs-steps">
            <?php foreach ( $steps as $i => $step ) :
                $delay  = 'd' . ( ( $i % 4 ) + 1 );
                $num    = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
                $icon   = $icons[ $i % count( $icons ) ];
                $title  = $step[ 'title_' . $lang ] ?? $step['title_az'] ?? '';
                $desc   = $step[ 'desc_' . $lang ]  ?? $step['desc_az']  ?? '';
                $dur    = $step['duration'] ?? '';
            ?>
                <div class="cs-step cs-fade <?php echo esc_attr( $delay ); ?>">
                    <div class="cs-step-n"><?php echo esc_html( $num ); ?></div>
                    <div class="cs-step-connector"></div>
                    <div class="cs-step-icon"><?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
                    <div class="cs-step-body">
                        <div class="cs-step-title"><?php echo esc_html( $title ); ?></div>
                        <div class="cs-step-desc"><?php echo esc_html( $desc ); ?></div>
                    </div>
                    <?php if ( $dur ) : ?>
                        <div class="cs-step-dur"><?php echo esc_html( $dur ); ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
