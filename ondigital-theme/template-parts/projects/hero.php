<?php
/**
 * Projects Archive — Magazine Portfolio Layout
 *
 * @package OnDigital
 */

// Admin options
$lang         = function_exists( 'pll_current_language' ) ? pll_current_language() : 'az';
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
    'lang'           => '',
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

    <!-- Lottie animation — decorative top-right -->
    <div class="pa-hero-lottie">
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player
            src="<?php echo esc_url( ONDIGITAL_URI . '/assets/animations/hero-animation.lottie' ); ?>"
            background="transparent"
            speed="1"
            style="width:420px;height:420px;"
            loop autoplay>
        </dotlottie-player>
    </div>

    <div class="pa-hero-inner">

      <div class="pa-eyebrow has_fade_anim">
        <span></span><?php echo esc_html( $pa_badge ); ?>
      </div>

      <h1 class="pa-title has_text_move_anim">
        <?php echo wp_kses_post( $pa_title ); ?>
      </h1>

      <div class="pa-hero-bottom">
        <p class="pa-desc has_fade_anim">
          <?php echo esc_html( $pa_desc ); ?>
        </p>
        <div class="pa-stats has_fade_anim">
          <div class="pa-stat">
            <div class="pa-stat-n">24<em>+</em></div>
            <div class="pa-stat-l"><?php esc_html_e( 'Müştəri', 'ondigital' ); ?></div>
          </div>
          <div class="pa-stat">
            <div class="pa-stat-n">8</div>
            <div class="pa-stat-l"><?php esc_html_e( 'Sənaye', 'ondigital' ); ?></div>
          </div>
          <div class="pa-stat">
            <div class="pa-stat-n">€2M<em>+</em></div>
            <div class="pa-stat-l"><?php esc_html_e( 'Gəlir', 'ondigital' ); ?></div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php get_template_part( 'template-parts/projects/partners' ); ?>

  <!-- ── Filter bar ── -->
  <?php if ( ! empty( $all_terms ) && ! is_wp_error( $all_terms ) ) : ?>
  <div class="pa-filter">
    <button class="pa-filter-btn active" data-filter="all">
      <?php esc_html_e( 'Hamısı', 'ondigital' ); ?>
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

        // Layout class based on position
        $layout_class = '';
        if ( $card_index === 0 ) $layout_class = 'pa-featured';
        if ( $card_index === 1 ) $layout_class = 'pa-tall';
        if ( $card_index === 4 ) $layout_class = 'pa-wide';

        // Placeholder colour cycles if no thumbnail
        $ph_colors = array( 'pa-ph-1', 'pa-ph-2', 'pa-ph-3', 'pa-ph-4', 'pa-ph-5' );
        $ph_class  = $ph_colors[ $card_index % 5 ];

        $delay_class = 'd' . ( ( $card_index % 4 ) + 1 );
    ?>

    <a href="<?php the_permalink(); ?>"
       class="pa-card <?php echo esc_attr( $layout_class ); ?> has_fade_anim <?php echo esc_attr( $delay_class ); ?>"
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

        <?php if ( ! empty( $cat_names ) ) : ?>
        <div class="pa-tags">
          <span class="pa-tag pa-tag-lime"><?php echo esc_html( $cat_names[0] ); ?></span>
          <?php for ( $i = 1; $i < count( $cat_names ); $i++ ) : ?>
            <span class="pa-tag"><?php echo esc_html( $cat_names[ $i ] ); ?></span>
          <?php endfor; ?>
        </div>
        <?php endif; ?>

        <div class="pa-client"><?php the_title(); ?></div>

        <?php if ( $excerpt ) : ?>
          <p class="pa-desc"><?php echo esc_html( wp_trim_words( $excerpt, 20 ) ); ?></p>
        <?php endif; ?>

        <?php if ( $result_num ) : ?>
        <div class="pa-result">
          <div>
            <div class="pa-result-n">
              <?php echo esc_html( $result_num ); ?>
              <?php if ( $result_label ) : ?>
                <span><?php echo esc_html( $result_label ); ?></span>
              <?php endif; ?>
            </div>
            <?php if ( $result_sub ) : ?>
              <div class="pa-result-l"><?php echo esc_html( $result_sub ); ?></div>
            <?php endif; ?>
          </div>
          <div class="pa-arrow">
            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </div>
        </div>
        <?php else : ?>
        <div class="pa-result">
          <div class="pa-result-l"><?php esc_html_e( 'Ətraflı bax →', 'ondigital' ); ?></div>
          <div class="pa-arrow">
            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </a>

    <?php
        $card_index++;
      endwhile;
      wp_reset_postdata();

    else : ?>

      <!-- No projects yet — placeholder cards -->
      <div class="pa-card pa-featured has_fade_anim">
        <div class="pa-thumb"><div class="pa-thumb-ph pa-ph-1"><span class="pa-ph-lbl">Tezliklə</span></div></div>
        <div class="pa-body">
          <div class="pa-tags"><span class="pa-tag pa-tag-lime">Layihə</span></div>
          <div class="pa-client"><?php esc_html_e( 'Layihələr yüklənir...', 'ondigital' ); ?></div>
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
