<?php
/**
 * Projects - Hero & Work Grid Section
 *
 * @package OnDigital
 */

$project_query = new WP_Query( array(
    'post_type'      => 'project',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'lang'           => '',
) );

$static_projects = array(
    array(
        'title' => 'Victoria Kinko',
        'tag'   => __( 'Dizayn - 2023', 'ondigital' ),
        'image' => 'img-s-12.webp',
        'size'  => '',
    ),
    array(
        'title' => 'Jimmy Fermin',
        'tag'   => __( 'Dizayn - 2023', 'ondigital' ),
        'image' => 'img-s-13.webp',
        'size'  => '',
    ),
    array(
        'title' => 'Briyokath Woody',
        'tag'   => __( 'Dizayn - 2022', 'ondigital' ),
        'image' => 'img-s-14.webp',
        'size'  => 'large',
    ),
    array(
        'title' => 'Mastartery',
        'tag'   => __( 'Dizayn - 2022', 'ondigital' ),
        'image' => 'img-s-15.webp',
        'size'  => '',
    ),
    array(
        'title' => 'Festonax Card',
        'tag'   => __( 'Dizayn - 2021', 'ondigital' ),
        'image' => 'img-s-16.webp',
        'size'  => '',
    ),
);
?>
<section class="work-area">
    <div class="container">
        <div class="work-area-inner section-spacing-bottom">
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h1 class="section-title large has_text_move_anim"><?php esc_html_e( 'Layihələr', 'ondigital' ); ?></h1>
                    </div>
                </div>
                <div class="text-wrapper">
                    <p class="text has_fade_anim">
                        <?php esc_html_e( 'Müasir və unikal dizayn yanaşması ilə istifadəçi dostu rəqəmsal həllər yaradırıq.', 'ondigital' ); ?>
                    </p>
                </div>
                <div class="icon has_fade_anim">
                    <img class="show-light" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-82.webp' ); ?>" alt="<?php esc_attr_e( 'dekor', 'ondigital' ); ?>">
                    <img class="show-dark" src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/shape/img-s-82-light.webp' ); ?>" alt="<?php esc_attr_e( 'dekor', 'ondigital' ); ?>">
                </div>
            </div>
            <div class="works-wrapper-box">
                <div class="works-wrapper">
                    <?php if ( $project_query->have_posts() ) : ?>
                        <?php while ( $project_query->have_posts() ) : $project_query->the_post(); ?>
                            <div class="has_fade_anim">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="work-box">
                                        <div class="thumb">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <?php the_post_thumbnail( 'ondigital-project-card' ); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <h3 class="title"><?php the_title(); ?></h3>
                                            <div class="meta">
                                                <?php
                                                $categories = get_the_terms( get_the_ID(), 'project_category' );
                                                $cat_name   = ! empty( $categories ) ? $categories[0]->name : '';
                                                ?>
                                                <span class="tag"><?php echo esc_html( $cat_name . ' - ' . get_the_date( 'Y' ) ); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <?php foreach ( $static_projects as $project ) : ?>
                            <div class="has_fade_anim">
                                <a <?php echo $project['size'] ? 'class="large"' : ''; ?> href="#">
                                    <div class="work-box">
                                        <div class="thumb">
                                            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/works/' . $project['image'] ); ?>" alt="<?php echo esc_attr( $project['title'] ); ?>">
                                        </div>
                                        <div class="content">
                                            <h3 class="title"><?php echo esc_html( $project['title'] ); ?></h3>
                                            <div class="meta">
                                                <span class="tag"><?php echo esc_html( $project['tag'] ); ?></span>
                                            </div>
                                        </div>
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
