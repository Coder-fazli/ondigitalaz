<?php
/**
 * Glossary archive — hero + alphabet filter + term grid + pagination.
 *
 * @package OnDigital
 */

// Current filter state
$active_letter = isset( $_GET['harf'] ) ? strtoupper( sanitize_text_field( $_GET['harf'] ) ) : 'ALL';
$search_query  = isset( $_GET['s'] )    ? sanitize_text_field( $_GET['s'] )                   : '';

// Build WP_Query args
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args  = array(
    'post_type'      => 'od_glossary',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'orderby'        => 'title',
    'order'          => 'ASC',
);

if ( $search_query ) {
    $args['s'] = $search_query;
}

if ( $active_letter && $active_letter !== 'ALL' ) {
    // Filter by first letter via title LIKE query
    add_filter( 'posts_where', 'ondigital_glossary_letter_where', 10, 2 );
    $GLOBALS['_od_glossary_letter'] = $active_letter;
}

$glossary_query = new WP_Query( $args );

// Remove filter after query
remove_filter( 'posts_where', 'ondigital_glossary_letter_where', 10 );

// Count by letter for disabling empty letters
$letter_counts = array();
$all_terms = get_posts( array(
    'post_type'      => 'od_glossary',
    'posts_per_page' => -1,
    'fields'         => 'ids',
    'orderby'        => 'title',
    's'              => $search_query,
) );
foreach ( $all_terms as $tid ) {
    $title  = get_the_title( $tid );
    $first  = strtoupper( mb_substr( $title, 0, 1 ) );
    if ( ! isset( $letter_counts[ $first ] ) ) {
        $letter_counts[ $first ] = 0;
    }
    $letter_counts[ $first ]++;
}

$archive_url = get_post_type_archive_link( 'od_glossary' );
?>

<!-- ======================== HERO ======================== -->
<section class="glossary-hero">
    <div class="container">
        <div class="glossary-hero__inner">
            <h1 class="glossary-hero__title">
                <?php esc_html_e( 'Rəqəmsal', 'ondigital' ); ?>
                <span class="glossary-hero__accent"><?php esc_html_e( 'Marketinq Sözlüyü', 'ondigital' ); ?></span>
            </h1>
            <p class="glossary-hero__sub">
                <?php esc_html_e( 'Rəqəmsal artımın dilini öyrənin. Sənaye terminlərinin hərtərəfli sözlüyünü araşdırın.', 'ondigital' ); ?>
            </p>

            <form class="glossary-search" action="<?php echo esc_url( $archive_url ); ?>" method="GET" role="search">
                <i class="fa-solid fa-magnifying-glass glossary-search__icon"></i>
                <input
                    type="text"
                    name="s"
                    class="glossary-search__input"
                    placeholder="<?php esc_attr_e( 'Termin axtar (məs. SEO, Dönüşüm dərəcəsi...)', 'ondigital' ); ?>"
                    value="<?php echo esc_attr( $search_query ); ?>"
                    autocomplete="off"
                >
            </form>
        </div>
    </div>
</section>

<!-- ======================== ALPHABET FILTER ======================== -->
<div class="glossary-alpha-bar" id="glossary-alpha">
    <div class="container">
        <div class="glossary-alpha__scroll">
            <a
                href="<?php echo esc_url( $archive_url . ( $search_query ? '?s=' . urlencode( $search_query ) : '' ) ); ?>"
                class="glossary-alpha__btn <?php echo ( $active_letter === 'ALL' ) ? 'is-active' : ''; ?>"
            >
                <?php esc_html_e( 'Hamısı', 'ondigital' ); ?>
            </a>
            <?php foreach ( range( 'A', 'Z' ) as $letter ) :
                $has_terms = ! empty( $letter_counts[ $letter ] );
                $url = add_query_arg( array(
                    'harf' => $letter,
                    's'    => $search_query ?: false,
                ), $archive_url );
                $classes = 'glossary-alpha__btn glossary-alpha__letter';
                if ( $active_letter === $letter ) $classes .= ' is-active';
                if ( ! $has_terms )               $classes .= ' is-empty';
            ?>
            <a
                href="<?php echo $has_terms ? esc_url( $url ) : '#'; ?>"
                class="<?php echo esc_attr( $classes ); ?>"
                <?php echo ! $has_terms ? 'tabindex="-1" aria-disabled="true"' : ''; ?>
            >
                <?php echo esc_html( $letter ); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- ======================== GRID ======================== -->
<section class="glossary-grid-section">
    <div class="container">

        <div class="glossary-grid-header">
            <h2 class="glossary-grid-header__title">
                <span class="glossary-grid-header__bar"></span>
                <?php
                if ( $search_query ) {
                    printf( esc_html__( '"%s" axtarışı', 'ondigital' ), esc_html( $search_query ) );
                } elseif ( $active_letter !== 'ALL' ) {
                    printf( esc_html__( '"%s" hərfi ilə terminlər', 'ondigital' ), esc_html( $active_letter ) );
                } else {
                    esc_html_e( 'Bütün terminlər', 'ondigital' );
                }
                ?>
            </h2>
            <?php if ( $glossary_query->found_posts ) : ?>
            <span class="glossary-grid-header__count">
                <?php printf(
                    esc_html__( '%d termin tapıldı', 'ondigital' ),
                    $glossary_query->found_posts
                ); ?>
            </span>
            <?php endif; ?>
        </div>

        <?php if ( $glossary_query->have_posts() ) : ?>

        <div class="glossary-grid">
            <?php while ( $glossary_query->have_posts() ) : $glossary_query->the_post();
                $terms = get_the_terms( get_the_ID(), 'glossary_cat' );
                $cat   = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0] : null;
            ?>
            <a href="<?php the_permalink(); ?>" class="glossary-card">
                <div class="glossary-card__top">
                    <span class="glossary-card__cat">
                        <?php echo $cat ? esc_html( $cat->name ) : esc_html__( 'Ümumi', 'ondigital' ); ?>
                    </span>
                    <i class="fa-solid fa-arrow-up-right glossary-card__arrow"></i>
                </div>
                <h3 class="glossary-card__title"><?php the_title(); ?></h3>
                <p class="glossary-card__excerpt">
                    <?php echo wp_trim_words( get_the_excerpt() ?: wp_strip_all_tags( get_the_content() ), 20, '...' ); ?>
                </p>
            </a>
            <?php endwhile; ?>
        </div>

        <?php
        // Pagination
        $total_pages = $glossary_query->max_num_pages;
        if ( $total_pages > 1 ) :
            $current = max( 1, get_query_var( 'paged' ) );
        ?>
        <nav class="glossary-pagination" aria-label="<?php esc_attr_e( 'Səhifələr', 'ondigital' ); ?>">
            <?php if ( $current > 1 ) : ?>
            <a href="<?php echo esc_url( get_pagenum_link( $current - 1 ) ); ?>" class="glossary-pagination__btn glossary-pagination__btn--prev">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <?php endif; ?>

            <?php
            $range = 2;
            $pages = paginate_links( array(
                'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'format'    => '?paged=%#%',
                'current'   => $current,
                'total'     => $total_pages,
                'mid_size'  => $range,
                'type'      => 'array',
                'prev_next' => false,
            ) );
            if ( $pages ) :
                foreach ( $pages as $page ) :
                    $is_current = strpos( $page, 'current' ) !== false;
                    echo '<span class="glossary-pagination__item' . ( $is_current ? ' is-current' : '' ) . '">' . $page . '</span>';
                endforeach;
            endif;
            ?>

            <?php if ( $current < $total_pages ) : ?>
            <a href="<?php echo esc_url( get_pagenum_link( $current + 1 ) ); ?>" class="glossary-pagination__btn glossary-pagination__btn--next">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
            <?php endif; ?>
        </nav>
        <?php endif; ?>

        <?php else : ?>

        <div class="glossary-empty">
            <i class="fa-solid fa-book-open glossary-empty__icon"></i>
            <p><?php esc_html_e( 'Heç bir termin tapılmadı.', 'ondigital' ); ?></p>
            <a href="<?php echo esc_url( $archive_url ); ?>" class="glossary-empty__reset">
                <?php esc_html_e( 'Hamısını göstər', 'ondigital' ); ?>
            </a>
        </div>

        <?php endif; wp_reset_postdata(); ?>

    </div>
</section>

<?php
/**
 * Helper: filter posts by first letter of title (WHERE clause injection).
 * Hooked to posts_where only during the main glossary query.
 */
function ondigital_glossary_letter_where( string $where, WP_Query $q ): string {
    global $wpdb;
    $letter = $GLOBALS['_od_glossary_letter'] ?? '';
    if ( $letter ) {
        $where .= $wpdb->prepare( " AND {$wpdb->posts}.post_title LIKE %s", $wpdb->esc_like( $letter ) . '%' );
    }
    return $where;
}
