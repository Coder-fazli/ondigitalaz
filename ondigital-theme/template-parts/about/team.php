<?php
/**
 * About - Team Section
 *
 * @package OnDigital
 */

$team_title = ondigital_get_option( 'about_team_title', 'Peşəkar komanda' );
$team_body  = ondigital_get_option( 'about_team_body', 'Dünya səviyyəsində kreativ dizayn komandası ilə müştərilərimizin rəqəmsal dünyada uğur qazanmasına kömək edirik.' );

$team_query = new WP_Query( array(
    'post_type'      => 'team_member',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'lang'           => '',
) );

$static_team = array(
    array( 'name' => 'Kamal Abraham',  'position' => 'CEO, OnDigital',       'image' => 'img-s-1.webp' ),
    array( 'name' => 'Selina Gomaze',  'position' => 'Marketinq Meneceri',   'image' => 'img-s-2.webp' ),
    array( 'name' => 'Pedrik Vadra',   'position' => 'Baş Developer',        'image' => 'img-s-3.webp' ),
    array( 'name' => 'Thomas Ribbon',  'position' => 'UX Dizayner',          'image' => 'img-s-4.webp' ),
);
?>
<section class="team-area">
    <div class="container">
        <div class="team-area-inner section-spacing">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_fade_anim"><?php echo esc_html( $team_title ); ?></h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim"><?php echo esc_html( $team_body ); ?></p>
                </div>
            </div>
            <div class="team-wrapper-box">
                <div class="team-wrapper">
                    <?php if ( $team_query->have_posts() ) : ?>
                        <?php $delay = 0.15; while ( $team_query->have_posts() ) : $team_query->the_post(); ?>
                            <div class="team-box has_fade_anim" data-fade-from="left" data-delay="<?php echo esc_attr( $delay ); ?>">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="thumb">
                                        <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'ondigital-team' ); endif; ?>
                                    </div>
                                    <div class="content">
                                        <h3 class="title"><?php the_title(); ?></h3>
                                        <p class="text"><?php echo esc_html( get_post_meta( get_the_ID(), '_team_position', true ) ); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php $delay += 0.15; endwhile; wp_reset_postdata(); ?>
                    <?php else : ?>
                        <?php foreach ( $static_team as $i => $member ) : ?>
                            <div class="team-box has_fade_anim" data-fade-from="left" data-delay="<?php echo esc_attr( 0.15 + ( $i * 0.15 ) ); ?>">
                                <a href="#">
                                    <div class="thumb">
                                        <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/team/' . $member['image'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>">
                                    </div>
                                    <div class="content">
                                        <h3 class="title"><?php echo esc_html( $member['name'] ); ?></h3>
                                        <p class="text"><?php echo esc_html( $member['position'] ); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
