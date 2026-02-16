<?php
/**
 * Comments template.
 *
 * @package OnDigital
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            printf(
                esc_html( _nx( '%s Şərh', '%s Şərh', $comment_count, 'comments title', 'ondigital' ) ),
                number_format_i18n( $comment_count )
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
            ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav class="comment-navigation">
                <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Əvvəlki şərhlər', 'ondigital' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Sonrakı şərhlər', 'ondigital' ) ); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Şərhlər bağlıdır.', 'ondigital' ); ?></p>
    <?php endif; ?>

    <?php
    comment_form( array(
        'title_reply'         => esc_html__( 'Şərh yazın', 'ondigital' ),
        'title_reply_to'      => esc_html__( '%s-ə cavab yazın', 'ondigital' ),
        'cancel_reply_link'   => esc_html__( 'Cavabı ləğv et', 'ondigital' ),
        'label_submit'        => esc_html__( 'Şərh göndər', 'ondigital' ),
        'comment_notes_before' => '',
        'class_form'          => 'comment-form',
        'class_submit'        => 'wc-btn wc-btn-primary btn-text-flip',
    ) );
    ?>

</div>
