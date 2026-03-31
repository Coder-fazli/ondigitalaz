<?php
/**
 * Theme Header
 *
 * @package OnDigital
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<?php
$is_home = is_page_template( 'templates/page-home.php' );
$font_class = $is_home ? 'font-heading-spacegrotesk-bold' : 'font-heading-beatricetrial-regular-2';
?>
<body <?php body_class( $font_class ); ?>>
<?php wp_body_open(); ?>


<!-- Scroll to top -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
</div>

<!-- Offcanvas Mobile Menu -->
<div class="offcanvas-3__area">
    <div class="offcanvas-3__inner">
        <div class="offcanvas-3__meta-wrapper">
            <div>
                <button id="close_offcanvas" class="close-button close-offcanvas" onclick="hideCanvas3()">
                    <span></span>
                    <span></span>
                </button>
            </div>
            <div>
                <div class="offcanvas-3__meta mb-145 d-none d-md-block">
                    <ul>
                        <li>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', ondigital_get_option( 'phone', '+994554314750' ) ) ); ?>">
                                <u><?php echo esc_html( ondigital_get_option( 'phone', '+994 (55) 431 47 50' ) ); ?></u>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:<?php echo esc_attr( ondigital_get_option( 'email', 'office@ondigital.az' ) ); ?>">
                                <?php echo esc_html( ondigital_get_option( 'email', 'office@ondigital.az' ) ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#"><?php echo esc_html( ondigital_get_option( 'address', 'Old Town Plaza, Baku' ) ); ?></a>
                        </li>
                    </ul>
                </div>
                <div class="offcanvas-3__social d-none d-md-block">
                    <p class="title"><?php esc_html_e( 'Follow Us', 'ondigital' ); ?></p>
                    <div class="offcanvas-3__social-links">
                        <?php
                        $social_links = ondigital_get_social_links();
                        $social_icons = array(
                            'facebook'  => 'fa-facebook-f',
                            'instagram' => 'fa-instagram',
                            'linkedin'  => 'fa-linkedin-in',
                            'tiktok'    => 'fa-tiktok',
                            'youtube'   => 'fa-youtube',
                            'behance'   => 'fa-behance',
                            'pinterest' => 'fa-pinterest-p',
                        );
                        foreach ( $social_links as $platform => $url ) :
                            $icon = $social_icons[ $platform ] ?? '';
                        ?>
                            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer">
                                <i class="fa-brands <?php echo esc_attr( $icon ); ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-3__menu-wrapper">
            <nav class="nav-menu offcanvas-3__menu">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '<ul>%3$s</ul>',
                    'fallback_cb'    => false,
                    'depth'          => 2,
                ) );
                ?>
            </nav>
        </div>
    </div>
</div>

<!-- Search Modal -->
<div class="modal fade" id="search-template" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="search-template" aria-hidden="true">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php esc_attr_e( 'Close', 'ondigital' ); ?>"></button>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form-search" method="get">
                    <input type="text" name="s" placeholder="<?php esc_attr_e( 'Search', 'ondigital' ); ?>">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Header -->
<header class="header-area">
    <div class="container large">
        <div class="header-area__inner">
            <div class="header__logo">
                <?php if ( has_custom_logo() ) :
                    $logo_id  = get_theme_mod( 'custom_logo' );
                    $logo_url = wp_get_attachment_image_url( $logo_id, 'full' );
                    $logo_w   = absint( get_theme_mod( 'ondigital_logo_width', 150 ) );
                    $logo_h   = absint( get_theme_mod( 'ondigital_logo_height', 0 ) );
                    $logo_style = 'width:' . $logo_w . 'px;height:' . ( $logo_h ? $logo_h . 'px' : 'auto' ) . ';';
                ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img class="show-light" src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="<?php echo esc_attr( $logo_style ); ?>">
                        <img class="show-dark" src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="<?php echo esc_attr( $logo_style ); ?>">
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                    </a>
                <?php endif; ?>
            </div>
            <div class="header__nav pos-center">
                <nav class="main-menu">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'items_wrap'     => '<ul>%3$s</ul>',
                        'fallback_cb'    => 'ondigital_fallback_menu',
                        'depth'          => 3,
                        'walker'         => new OnDigital_Nav_Walker(),
                    ) );
                    ?>
                </nav>
            </div>
            <div class="header__button">
                <?php
                $header_btn_text  = ondigital_get_option( 'header_btn_text', 'Başlayaq' );
                $header_btn_url   = ondigital_get_option( 'header_btn_url', '/teklif-al/' );
                $_opts            = get_option( 'ondigital_options', array() );
                $header_btn_popup = isset( $_opts['header_btn_popup'] ) && $_opts['header_btn_popup'] === '1';
                ?>
                <a class="wc-btn wc-btn-primary btn-text-flip"
                   href="<?php echo $header_btn_popup ? '#' : esc_url( $header_btn_url ); ?>"
                   <?php echo $header_btn_popup ? 'data-od-form="contact"' : ''; ?>>
                    <span data-text="<?php echo esc_attr( $header_btn_text ); ?>"><?php echo esc_html( $header_btn_text ); ?></span>
                </a>
            </div>
            <div class="header__navicon d-xl-none">
                <button onclick="showCanvas3()" class="open-offcanvas">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<div class="has-smooth" id="has_smooth"></div>
<div id="smooth-wrapper">
<div id="smooth-content">
<div class="body-wrapper <?php echo $is_home ? 'body-seo-agency' : 'body-corporate-agency'; ?>">

<!-- Overlay switcher close -->
<div class="overlay-switcher-close"></div>

<main>
