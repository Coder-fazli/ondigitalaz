<?php
/**
 * Team Page - Team Grid
 *
 * @package OnDigital
 */

$team_query = new WP_Query( array(
    'post_type'      => 'team_member',
    'posts_per_page' => 8,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

$static_team = array(
    array( 'name' => 'Əli Həsənov',    'role' => __( 'Baş Direktor', 'ondigital' ),        'img' => 'img-s-1.webp' ),
    array( 'name' => 'Leyla Əliyeva',   'role' => __( 'Kreativ Direktor', 'ondigital' ),    'img' => 'img-s-2.webp' ),
    array( 'name' => 'Rəşad Məmmədov',  'role' => __( 'Baş Developer', 'ondigital' ),       'img' => 'img-s-3.webp' ),
    array( 'name' => 'Nərmin Quliyeva', 'role' => __( 'UX Dizayner', 'ondigital' ),         'img' => 'img-s-4.webp' ),
    array( 'name' => 'Orxan Babayev',   'role' => __( 'SEO Mütəxəssis', 'ondigital' ),     'img' => 'img-s-30.webp' ),
    array( 'name' => 'Günel Hüseynova', 'role' => __( 'Layihə Meneceri', 'ondigital' ),     'img' => 'img-s-31.webp' ),
    array( 'name' => 'Tural İsmayılov', 'role' => __( 'Backend Developer', 'ondigital' ),   'img' => 'img-s-32.webp' ),
    array( 'name' => 'Aynur Cəfərova',  'role' => __( 'Qrafik Dizayner', 'ondigital' ),    'img' => 'img-s-33.webp' ),
);
?>
<section class="team-area">
    <div class="container">
        <div class="team-area-inner section-spacing">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title has_text_move_anim"><?php esc_html_e( 'Ehtiras və təcrübəmizi bir araya gətiririk!', 'ondigital' ); ?></h2>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim">
                        <?php esc_html_e( 'Bizi fərqli edən, eyni zamanda birləşdirən şey - strategiya, dizayn və mühəndislik vasitəsilə biznes problemlərini həll etmək üçün ortaq ehtirasdır.', 'ondigital' ); ?>
                    </p>
                </div>
            </div>
            <div class="team-wrapper-box">
                <div class="team-wrapper">
                    <?php if ( $team_query->have_posts() ) :
                        $delay = 0.15;
                        while ( $team_query->have_posts() ) : $team_query->the_post();
                    ?>
                        <div class="team-box has_fade_anim" data-delay="<?php echo esc_attr( $delay ); ?>">
                            <a href="<?php the_permalink(); ?>">
                                <div class="thumb">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'ondigital-team', array( 'alt' => get_the_title() ) ); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="content">
                                    <h3 class="title"><?php the_title(); ?></h3>
                                    <?php
                                    $position = get_post_meta( get_the_ID(), '_team_position', true );
                                    if ( $position ) :
                                    ?>
                                        <p class="text"><?php echo esc_html( $position ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php
                        $delay += 0.15;
                        if ( $delay > 0.60 ) { $delay = 0.15; }
                        endwhile;
                        wp_reset_postdata();
                    else :
                        $delay = 0.15;
                        foreach ( $static_team as $member ) :
                    ?>
                        <div class="team-box has_fade_anim" data-delay="<?php echo esc_attr( $delay ); ?>">
                            <div class="thumb">
                                <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/team/' . $member['img'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>">
                            </div>
                            <div class="content">
                                <h3 class="title"><?php echo esc_html( $member['name'] ); ?></h3>
                                <p class="text"><?php echo esc_html( $member['role'] ); ?></p>
                            </div>
                        </div>
                    <?php
                        $delay += 0.15;
                        if ( $delay > 0.60 ) { $delay = 0.15; }
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
