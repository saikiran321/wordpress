<?php foreach ( (array) $messages as $message ): ?>
    <?php echo awpcp_print_message( $message ); ?>
<?php endforeach; ?>

<form class="awpcp-preview-ad-form" action="<?php echo $this->url(); ?>" method="post">
    <?php foreach($hidden as $name => $value): ?>
    <input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
    <?php endforeach ?>
    <input type="hidden" name="step" value="preview-ad" />

    <span><?php _e( 'This is a preview of your Ad. Use the buttons below to go back and edit your Ad, manage the uploaded images or finish the posting process.', 'AWPCP' ); ?></span>
    <br>
    <input class="button" type="submit" name="edit-details" value="<?php _e("Edit Details", "AWPCP"); ?>" />
    <?php if ( $ui['manage-images'] ): ?>
    <input class="button" type="submit" name="manage-images" value="<?php _e("Manage Images", "AWPCP"); ?>" />
    <?php endif; ?>
    <input class="button button-primary" type="submit" name="finish" value="<?php _e("Finish", "AWPCP"); ?>" />
</form>

<?php echo showad($ad->ad_id, true, true, false, false); ?>
