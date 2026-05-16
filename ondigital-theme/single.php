<?php
/**
 * Single post template.
 *
 * @package OnDigital
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="blog-details-area">
    <div class="container">
        <div class="blog-details-area-inner">

            <!-- Featured image — top, contained, rounded -->
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="blog-thumb">
                <?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?>
            </div>
            <?php endif; ?>

            <!-- Title + meta below image -->
            <div class="blog-post-header">
                <div class="blog-post-meta">
                    <?php
                    $cats = get_the_category();
                    if ( $cats ) :
                    ?>
                    <span class="blog-cat"><?php echo esc_html( $cats[0]->name ); ?></span>
                    <?php endif; ?>
                    <span class="blog-date"><?php echo esc_html( get_the_date( 'd M Y' ) ); ?></span>
                    <span class="blog-read-time">
                        <?php
                        $words    = str_word_count( strip_tags( get_the_content() ) );
                        $minutes  = max( 1, ceil( $words / 200 ) );
                        echo esc_html( $minutes . ' min read' );
                        ?>
                    </span>
                </div>
                <h1 class="blog-post-title"><?php the_title(); ?></h1>
            </div>

            <!-- Two-column: TOC left, content right -->
            <div class="blogdetails__wrapper">

                <!-- Left: Table of Contents -->
                <div class="blogdetails-contentleft">
                    <div class="blog-toc" id="blog-toc">
                        <p class="blog-toc-title"><?php esc_html_e( 'Contents', 'ondigital' ); ?></p>
                        <ul class="blog-toc-list" id="toc-list"></ul>
                    </div>
                    <ul class="blogdetails-overview dark-overview">
                        <li>
                            <i class="fa-solid fa-share-nodes"></i>
                            <span><?php esc_html_e( 'Share', 'ondigital' ); ?></span>
                        </li>
                    </ul>
                </div>

                <!-- Right: Article content -->
                <div class="blogdetails-contentright">
                    <article class="blog-details-fullBody">
                        <div class="text-wrapper" id="post-content">
                            <?php the_content(); ?>
                        </div>
                        <?php
                        $tags = get_the_tags();
                        if ( $tags ) :
                        ?>
                        <div class="tagswrap">
                            <ul class="tags">
                                <li><span><?php esc_html_e( 'Tags:', 'ondigital' ); ?></span></li>
                                <?php foreach ( $tags as $tag ) : ?>
                                    <li><a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </article>

                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="commentform section-spacing-top">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Related Articles -->
<?php
$categories = get_the_category();
if ( ! empty( $categories ) ) :
    $related_query = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post__not_in'   => array( get_the_ID() ),
        'category__in'   => array( $categories[0]->term_id ),
        'orderby'        => 'rand',
    ) );
    if ( $related_query->have_posts() ) :
?>
<section class="blog-area">
    <div class="container">
        <div class="blog-area-inner section-spacing">
            <div class="section-content">
                <div class="section-title-wrapper">
                    <div class="title-wrapper">
                        <h2 class="section-title"><?php esc_html_e( 'Related articles', 'ondigital' ); ?></h2>
                    </div>
                </div>
            </div>
            <div class="blogs-wrapper-box">
                <div class="blogs-wrapper">
                    <?php $count = 1; while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>">
                            <div class="blog-box">
                                <div class="thumb">
                                    <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'ondigital-blog-card' ); ?>
                                </div>
                                <div class="content">
                                    <span class="number"><?php echo esc_html( str_pad( $count, 2, '0', STR_PAD_LEFT ) ); ?></span>
                                    <h3 class="title"><?php the_title(); ?></h3>
                                    <span class="icon"><i class="fa-solid fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    <?php $count++; endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; endif; ?>

<!-- TOC generator -->
<script>
(function(){
    var content  = document.getElementById('post-content');
    var tocList  = document.getElementById('toc-list');
    var toc      = document.getElementById('blog-toc');
    var tocEnabled = <?php echo get_post_meta( get_the_ID(), '_toc_enabled', true ) === '0' ? 'false' : 'true'; ?>;
    var tocDepth   = '<?php echo esc_js( get_post_meta( get_the_ID(), '_toc_depth', true ) ?: 'h2h3' ); ?>';

    if (!content || !tocList || !tocEnabled) { if(toc) toc.style.display = 'none'; return; }

    var selector = tocDepth === 'h2' ? 'h2' : tocDepth === 'h3' ? 'h3' : 'h2, h3';
    var headings = content.querySelectorAll(selector);
    if (headings.length < 2) { toc.style.display = 'none'; return; }

    headings.forEach(function(h, i){
        var id = 'heading-' + i;
        h.id = id;
        var li = document.createElement('li');
        li.className = h.tagName === 'H3' ? 'toc-sub' : '';
        li.innerHTML = '<a href="#' + id + '">' + h.textContent + '</a>';
        tocList.appendChild(li);
    });

    // Sticky TOC — transform:translateY (GPU, no layout reflow = smooth)
    var tocBox     = document.getElementById('blog-toc');
    var wrapper    = document.querySelector('.blogdetails__wrapper');
    var OFFSET     = 110;
    var rafPending = false;

    function updateToc() {
        if (!tocBox || !wrapper) return;

        if (window.innerWidth <= 991) {
            tocBox.style.transform = 'none';
        } else {
            var scrollY      = window.scrollY;
            var wrapperTop   = wrapper.getBoundingClientRect().top + scrollY;
            var maxTranslate = wrapper.offsetHeight - tocBox.offsetHeight;
            var translate    = 0;
            if (scrollY + OFFSET > wrapperTop) {
                translate = Math.min(scrollY + OFFSET - wrapperTop, Math.max(0, maxTranslate));
                translate = Math.max(0, translate);
            }
            tocBox.style.transform = 'translateY(' + translate + 'px)';
        }

        // Highlight active heading
        var scrollYH = window.scrollY + OFFSET + 20;
        headings.forEach(function(h){
            var link = tocList.querySelector('a[href="#' + h.id + '"]');
            if (!link) return;
            if (h.getBoundingClientRect().top + window.scrollY <= scrollYH) {
                tocList.querySelectorAll('a').forEach(function(a){ a.classList.remove('active'); });
                link.classList.add('active');
            }
        });
    }

    function onScroll() {
        if (rafPending) return;
        rafPending = true;
        requestAnimationFrame(function(){ updateToc(); rafPending = false; });
    }

    // Wrap tables in scrollable container for mobile
    content.querySelectorAll('table').forEach(function(table){
        var wrap = document.createElement('div');
        wrap.className = 'table-scroll';
        table.parentNode.insertBefore(wrap, table);
        wrap.appendChild(table);
    });

    window.addEventListener('scroll', onScroll, { passive: true });
    var smoothContent = document.getElementById('smooth-content');
    if (smoothContent) smoothContent.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', updateToc);
    updateToc();
})();
</script>

<?php endwhile; ?>
<?php get_footer();
