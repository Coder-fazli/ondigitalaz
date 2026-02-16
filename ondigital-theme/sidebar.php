<?php
/**
 * Blog Sidebar
 *
 * @package OnDigital
 */

if ( ! is_active_sidebar( 'blog-sidebar' ) ) {
    return;
}
?>

<aside id="secondary" class="sidebar">
    <?php dynamic_sidebar( 'blog-sidebar' ); ?>
</aside>
