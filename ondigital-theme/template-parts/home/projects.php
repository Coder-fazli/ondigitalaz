<?php
/**
 * Home - Projects Section
 *
 * @package OnDigital
 */

$projects_query = new WP_Query( array(
    'post_type'      => 'project',
    'posts_per_page' => 8,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

// Fallback static projects
$static_projects = array(
    array( 'title' => __( 'Unique SEO strategy approach', 'ondigital' ), 'tag' => __( 'SEO marketing', 'ondigital' ), 'image' => 'img-s-2.webp' ),
    array( 'title' => __( 'Competitive work analysis', 'ondigital' ), 'tag' => __( 'Email marketing', 'ondigital' ), 'image' => 'img-s-3.webp' ),
    array( 'title' => __( 'Market research with investment', 'ondigital' ), 'tag' => __( 'SEO marketing', 'ondigital' ), 'image' => 'img-s-4.webp' ),
    array( 'title' => __( 'Social connectivity and community', 'ondigital' ), 'tag' => __( 'Social marketing', 'ondigital' ), 'image' => 'img-s-5.webp' ),
);
?>
<div class="container large">
    <section class="project-area">
        <div class="container">
            <div class="project-area-inner section-spacing-top">
                <div class="section-header">
                    <div class="section-title-wrapper">
                        <div class="title-wrapper">
                            <?php
                            $projects_title = ondigital_get_option( 'projects_title', 'Our exclusive <span>case</span> studies' );
                            ?>
                            <h2 class="section-title has_text_move_anim">
                                <?php echo wp_kses_post( $projects_title ); ?>
                            </h2>
                        </div>
                    </div>
                    <div class="text-wrapper">
                        <p class="text has_fade_anim" data-delay="0.30">
                            <?php esc_html_e( 'Our design services starts and ends with a best-in-class experience strategy that builds to provide you with an informed response.', 'ondigital' ); ?>
                        </p>
                    </div>
                    <div class="slider-nav has_fade_anim" data-delay="0.45">
                        <div class="project-button-prev nav-icon">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="project-button-next nav-icon">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="projects-wrapper-box has_fade_anim">
            <div class="projects-wrapper">
                <div class="swiper project-slider">
                    <div class="swiper-wrapper">
                        <?php if ( $projects_query->have_posts() ) : ?>
                            <?php while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?>
                                <div class="swiper-slide">
                                    <div class="project-box">
                                        <div class="thumb">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <?php the_post_thumbnail( 'ondigital-project-card' ); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="meta">
                                            <?php
                                            $categories = get_the_terms( get_the_ID(), 'project_category' );
                                            if ( $categories && ! is_wp_error( $categories ) ) :
                                            ?>
                                                <span class="tag"><?php echo esc_html( $categories[0]->name ); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content">
                                            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <a href="<?php the_permalink(); ?>" class="wc-btn wc-btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <?php foreach ( $static_projects as $project ) : ?>
                                <div class="swiper-slide">
                                    <div class="project-box">
                                        <div class="thumb">
                                            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/project/' . $project['image'] ); ?>" alt="<?php echo esc_attr( $project['title'] ); ?>">
                                        </div>
                                        <div class="meta">
                                            <span class="tag"><?php echo esc_html( $project['tag'] ); ?></span>
                                        </div>
                                        <div class="content">
                                            <h3 class="title"><a href="#"><?php echo esc_html( $project['title'] ); ?></a></h3>
                                            <a href="#" class="wc-btn wc-btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php
                            // Duplicate for slider continuity
                            foreach ( $static_projects as $project ) : ?>
                                <div class="swiper-slide">
                                    <div class="project-box">
                                        <div class="thumb">
                                            <img src="<?php echo esc_url( ONDIGITAL_URI . '/assets/imgs/project/' . $project['image'] ); ?>" alt="<?php echo esc_attr( $project['title'] ); ?>">
                                        </div>
                                        <div class="meta">
                                            <span class="tag"><?php echo esc_html( $project['tag'] ); ?></span>
                                        </div>
                                        <div class="content">
                                            <h3 class="title"><a href="#"><?php echo esc_html( $project['title'] ); ?></a></h3>
                                            <a href="#" class="wc-btn wc-btn-circle"><i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
