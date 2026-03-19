<?php
/**
 * Home - Team Section
 *
 * @package OnDigital
 */

$team_query = new WP_Query( array(
    'post_type'      => 'team_member',
    'posts_per_page' => 4,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'lang'           => '',
) );

// Fallback static team
$static_team = array(
    array( 'name' => 'Kamal Abraham', 'post' => 'CEO', 'social' => 'linkedin', 'image' => 'img-s-21.webp' ),
    array( 'name' => 'Selina Gomaze', 'post' => 'Jr. Executive', 'social' => 'twitter', 'image' => 'img-s-22.webp' ),
    array( 'name' => 'Pedrik Vadra', 'post' => 'Logo Designer', 'social' => 'linkedin', 'image' => 'img-s-23.webp' ),
    array( 'name' => 'Thomas Ribbon', 'post' => 'Sr. Designer', 'social' => 'twitter', 'image' => 'img-s-24.webp' ),
);

$delays = array( '0.15', '0.30', '0.45', '0.60' );
?>
<div class="container large">
    <section class="team-area">
        <div class="container">
            <div class="team-area-inner section-spacing-top">
                <div class="shape-1">
                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-56.webp' ); ?>" alt="<?php esc_attr_e( 'shape', 'ondigital' ); ?>">
                </div>
                <div class="section-header">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <h2 class="section-title has_text_move_anim">
                                <?php echo wp_kses_post( __( 'Talented <span>team</span> behind the marketing, innovation and creativity', 'ondigital' ) ); ?>
                            </h2>
                        </div>
                    </div>
                    <div class="text-wrapper">
                        <p class="text has_fade_anim" data-fade-from="left">
                            <?php esc_html_e( 'We\'ll work with you to develop more flexible, autonomous teams that drive more meaningful, successful outcomes.', 'ondigital' ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="team-wrapper-box">
            <div class="shape-1 has_fade_anim" data-fade-offset="0">
                <a href="#">
                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-57.webp' ); ?>" alt="<?php esc_attr_e( 'shape', 'ondigital' ); ?>">
                </a>
            </div>
            <div class="team-wrapper">
                <?php if ( $team_query->have_posts() ) : ?>
                    <?php $i = 0; while ( $team_query->have_posts() ) : $team_query->the_post();
                        $member_role = get_post_meta( get_the_ID(), '_team_role', true );
                        $linkedin    = get_post_meta( get_the_ID(), '_team_linkedin', true );
                        $twitter     = get_post_meta( get_the_ID(), '_team_twitter', true );
                        $instagram   = get_post_meta( get_the_ID(), '_team_instagram', true );
                        $behance     = get_post_meta( get_the_ID(), '_team_behance', true );

                        // Build social links array
                        $socials = array();
                        if ( $linkedin )  $socials[] = array( 'url' => $linkedin,  'icon' => 'fa-linkedin-in', 'label' => 'LinkedIn' );
                        if ( $twitter )   $socials[] = array( 'url' => $twitter,   'icon' => 'fa-twitter',     'label' => 'Twitter' );
                        if ( $instagram ) $socials[] = array( 'url' => $instagram, 'icon' => 'fa-instagram',   'label' => 'Instagram' );
                        if ( $behance )   $socials[] = array( 'url' => $behance,   'icon' => 'fa-behance',     'label' => 'Behance' );
                    ?>
                        <div class="team-box has_fade_anim" data-fade-from="bottom" data-delay="<?php echo esc_attr( $delays[ $i % 4 ] ); ?>">
                            <div class="thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            </div>
                            <div class="content">
                                <div class="top">
                                    <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p class="post"><?php echo esc_html( $member_role ); ?></p>
                                </div>
                                <?php if ( ! empty( $socials ) ) : ?>
                                    <div class="wc-btn-group">
                                        <?php $primary = $socials[0]; ?>
                                        <a class="wc-btn wc-btn-circle" href="<?php echo esc_url( $primary['url'] ); ?>" target="_blank" rel="noopener">
                                            <i class="fa-brands <?php echo esc_attr( $primary['icon'] ); ?>"></i>
                                        </a>
                                        <a class="wc-btn wc-btn-primary" href="<?php echo esc_url( $primary['url'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $primary['label'] ); ?></a>
                                        <a class="wc-btn wc-btn-circle" href="<?php echo esc_url( $primary['url'] ); ?>" target="_blank" rel="noopener">
                                            <i class="fa-brands <?php echo esc_attr( $primary['icon'] ); ?>"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php $i++; endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php foreach ( $static_team as $i => $member ) :
                        $icon_class = $member['social'] === 'linkedin' ? 'fa-linkedin-in' : 'fa-twitter';
                        $social_label = ucfirst( $member['social'] );
                    ?>
                        <div class="team-box has_fade_anim" data-fade-from="bottom" data-delay="<?php echo esc_attr( $delays[ $i ] ); ?>">
                            <div class="thumb">
                                <a href="#">
                                    <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/team/' . $member['image'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>">
                                </a>
                            </div>
                            <div class="content">
                                <div class="top">
                                    <h3 class="name"><a href="#"><?php echo esc_html( $member['name'] ); ?></a></h3>
                                    <p class="post"><?php echo esc_html( $member['post'] ); ?></p>
                                </div>
                                <div class="wc-btn-group">
                                    <a class="wc-btn wc-btn-circle" href="#">
                                        <i class="fa-brands <?php echo esc_attr( $icon_class ); ?>"></i>
                                    </a>
                                    <a class="wc-btn wc-btn-primary" href="#"><?php echo esc_html( $social_label ); ?></a>
                                    <a class="wc-btn wc-btn-circle" href="#">
                                        <i class="fa-brands <?php echo esc_attr( $icon_class ); ?>"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
