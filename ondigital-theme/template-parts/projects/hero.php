<?php
/**
 * Projects Archive — Magazine Portfolio Layout
 *
 * @package OnDigital
 */

// Admin options
$lang         = function_exists( 'pll_current_language' ) ? pll_current_language() : 'en';
$pa_badge     = ondigital_get_option( 'projects_archive_badge_' . $lang )
             ?: ondigital_get_option( 'projects_archive_badge_az', 'Layihələr və Keyslar' );
$pa_title     = ondigital_get_option( 'projects_archive_title_' . $lang )
             ?: ondigital_get_option( 'projects_archive_title_az', 'Nəticə danışır.' );
$pa_desc      = ondigital_get_option( 'projects_archive_desc_' . $lang )
             ?: ondigital_get_option( 'projects_archive_desc_az', 'Hər layihə real problemlə başlayır, ölçülə bilən nəticə ilə bitir. Boş göstəricilər yox — yalnız böyüməni əks etdirən rəqəmlər.' );

// Fetch all projects
$project_query = new WP_Query( array(
    'post_type'      => 'project',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
    // Only the current language's projects, so cards link to same-language pages
    // (was '' = all languages, which mixed AZ/EN and linked to the wrong language).
    'lang'           => function_exists( 'pll_current_language' ) ? pll_current_language() : '',
) );

// Collect all project_category terms for filter bar
$all_terms = get_terms( array(
    'taxonomy'   => 'project_category',
    'hide_empty' => true,
) );
?>

<div class="pa-section">

  <!-- ── Hero ── -->
  <div class="pa-hero">
    <div class="pa-hero-line"></div>

    <div class="pa-hero-inner">

      <h1 class="pa-title has_text_move_anim">
        <?php echo wp_kses_post( $pa_title ); ?>
      </h1>

    </div>
  </div>

  <?php // Partners marquee disabled for now (was infinite-looping logo-cloud.js when hidden). ?>

  <!-- ── Filter bar ── -->
  <?php if ( ! empty( $all_terms ) && ! is_wp_error( $all_terms ) ) : ?>
  <div class="pa-filter">
    <button class="pa-filter-btn active" data-filter="all">
      <?php echo esc_html( $lang === 'en' ? 'All' : 'Hamısı' ); ?>
    </button>
    <?php foreach ( $all_terms as $term ) : ?>
      <button class="pa-filter-btn" data-filter="<?php echo esc_attr( $term->slug ); ?>">
        <?php echo esc_html( $term->name ); ?>
      </button>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <!-- ── Magazine grid ── -->
  <div class="pa-grid">

    <?php
    $card_index = 0;

    if ( $project_query->have_posts() ) :
      while ( $project_query->have_posts() ) :
        $project_query->the_post();

        $post_id     = get_the_ID();
        $cats        = get_the_terms( $post_id, 'project_category' );
        $cat_slugs   = $cats && ! is_wp_error( $cats ) ? implode( ' ', wp_list_pluck( $cats, 'slug' ) ) : '';
        $cat_names   = $cats && ! is_wp_error( $cats ) ? wp_list_pluck( $cats, 'name' ) : array();

        // ACF / post meta fields — fall back to empty
        $result_num   = get_post_meta( $post_id, 'project_result_number',  true ) ?: '';
        $result_label = get_post_meta( $post_id, 'project_result_label',   true ) ?: '';
        $result_sub   = get_post_meta( $post_id, 'project_result_sub',     true ) ?: '';
        $excerpt      = get_the_excerpt() ?: get_post_meta( $post_id, 'project_short_desc', true );

        // Placeholder colour cycles if no thumbnail
        $ph_colors = array( 'pa-ph-1', 'pa-ph-2', 'pa-ph-3', 'pa-ph-4', 'pa-ph-5' );
        $ph_class  = $ph_colors[ $card_index % 5 ];
        $delay_class = 'd' . ( ( $card_index % 4 ) + 1 );

        // First card is the orange-accented "featured" one.
        $feat_class = $card_index === 0 ? 'pa-feat' : '';

        // Client logo (image) + name; single category tag.
        $client_logo_id  = (int) get_post_meta( $post_id, '_project_client_logo', true );
        $client_logo_url = $client_logo_id ? wp_get_attachment_image_url( $client_logo_id, 'medium' ) : '';
        $client_name     = get_post_meta( $post_id, '_od_client', true );
        $cat_tag         = ! empty( $cat_names ) ? $cat_names[0] : '';
        $read_label      = $lang === 'en' ? 'Read' : 'Ətraflı';
    ?>

    <a href="<?php the_permalink(); ?>"
       class="pa-card <?php echo esc_attr( $feat_class ); ?> has_fade_anim <?php echo esc_attr( $delay_class ); ?>"
       data-cat="<?php echo esc_attr( $cat_slugs ); ?>">

      <div class="pa-thumb">
        <?php if ( has_post_thumbnail() ) : ?>
          <?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?>
        <?php else : ?>
          <div class="pa-thumb-ph <?php echo esc_attr( $ph_class ); ?>">
            <span class="pa-ph-lbl"><?php the_title(); ?></span>
          </div>
        <?php endif; ?>
      </div>

      <div class="pa-body">

        <div class="pa-head">
          <div class="pa-client">
            <?php if ( $client_logo_url ) : ?>
              <img class="pa-client-logo" src="<?php echo esc_url( $client_logo_url ); ?>" alt="<?php echo esc_attr( $client_name ?: get_the_title() ); ?>">
            <?php elseif ( $client_name ) : ?>
              <span class="pa-client-name"><?php echo esc_html( $client_name ); ?></span>
            <?php endif; ?>
          </div>
          <?php if ( $cat_tag ) : ?>
            <span class="pa-cat"><?php echo esc_html( $cat_tag ); ?></span>
          <?php endif; ?>
        </div>

        <h3 class="pa-title"><?php the_title(); ?></h3>

        <?php if ( $excerpt ) : ?>
          <p class="pa-desc"><?php echo esc_html( wp_trim_words( $excerpt, 18 ) ); ?></p>
        <?php endif; ?>

        <span class="pa-read"><?php echo esc_html( $read_label ); ?>
          <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </span>

      </div>
    </a>

    <?php
        $card_index++;
      endwhile;
      wp_reset_postdata();

    else : ?>

      <!-- No projects yet — placeholder card -->
      <div class="pa-card has_fade_anim">
        <div class="pa-thumb"><div class="pa-thumb-ph pa-ph-1"><span class="pa-ph-lbl">Tezliklə</span></div></div>
        <div class="pa-body">
          <div class="pa-head"><span class="pa-cat">Layihə</span></div>
          <h3 class="pa-title"><?php echo esc_html( $lang === 'en' ? 'Loading projects...' : 'Layihələr yüklənir...' ); ?></h3>
        </div>
      </div>

    <?php endif; ?>

  </div><!-- .pa-grid -->

</div><!-- .pa-section -->

<script>
(function(){
  var btns  = document.querySelectorAll('.pa-filter-btn');
  var cards = document.querySelectorAll('.pa-card');
  btns.forEach(function(btn){
    btn.addEventListener('click', function(){
      btns.forEach(function(b){ b.classList.remove('active'); });
      btn.classList.add('active');
      var filter = btn.dataset.filter;
      cards.forEach(function(card){
        var cats = ' ' + (card.dataset.cat || '') + ' ';
        var show = filter === 'all' || cats.indexOf(' ' + filter + ' ') !== -1;
        card.style.opacity       = show ? '1' : '.15';
        card.style.transform     = show ? '' : 'scale(.97)';
        card.style.pointerEvents = show ? '' : 'none';
        card.style.transition    = 'opacity .3s ease, transform .3s ease';
      });
    });
  });
})();
</script>
