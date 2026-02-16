<?php
/**
 * About - Team Section
 *
 * @package OnDigital
 */

$team_query = new WP_Query( array(
    'post_type'      => 'team_member',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

$static_team = array(
    array(
        'name'     => 'Kamal Abraham',
        'position' => __( 'CEO, OnDigital', 'ondigital' ),
        'image'    => 'img-s-1.webp',
    ),
    array(
        'name'     => 'Selina Gomaze',
        'position' => __( 'Marketinq Meneceri', 'ondigital' ),
        'image'    => 'img-s-2.webp',
    ),
    array(
        'name'     => 'Pedrik Vadra',
        'position' => __( 'Baş Developer', 'ondigital' ),
        'image'    => 'img-s-3.webp',
    ),
    array(
        'name'     => 'Thomas Ribbon',
        'position' => __( 'UX Dizayner', 'ondigital' ),
        'image'    => 'img-s-4.webp',
    ),
);
?>
<section class="team-area">
    <div class="container">
        <div class="team-area-inner section-spacing">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_fade_anim"><?php esc_html_e( 'Peşəkar komanda', 'ondigital' ); ?></h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim">
                        <?php esc_html_e( 'Dünya səviyyəsində kreativ dizayn komandası ilə müştərilərimizin rəqəmsal dünyada uğur qazanmasına kömək edirik.', 'ondigital' ); ?>
                    </p>
                </div>
            </div>
            <div class="team-wrapper-box">
                <div class="team-wrapper">
                    <?php if ( $team_query->have_posts() ) : ?>
                        <?php $delay = 0.15; while ( $team_query->have_posts() ) : $team_query->the_post(); ?>
                            <div class="team-box has_fade_anim" data-fade-from="left" data-delay="<?php echo esc_attr( $delay ); ?>">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="thumb">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'ondigital-team' ); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="content">
                                        <h3 class="title"><?php the_title(); ?></h3>
                                        <p class="text"><?php echo esc_html( get_post_meta( get_the_ID(), '_team_position', true ) ); ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php $delay += 0.15; endwhile; ?>
                        <?php wp_reset_postdata(); ?>
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
