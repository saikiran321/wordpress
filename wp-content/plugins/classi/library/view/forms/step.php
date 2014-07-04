<?php if(file_exists(LIBRARYPATH.'js/ad_field_validation.php')) require_once(LIBRARYPATH.'js/ad_field_validation.php'); ?>
<form name="add_post_form" id="Add_post_form" action="" method="post" enctype="multipart/form-data">
    <!--Start Step1-->
    <div class="step1">
        <div class="label">
            <label><?php echo AD_TTLE; ?><span class="required">*</span></label>
        </div>
        <div class="row">
            <input type="text" name="cc_title" id="title"/>
        </div>   
        <div class="label">
            <label><?php echo SLT_CAT; ?></label>
        </div>
        <div class="row">
            <?php
            $taxonomies = array(CUSTOM_CAT_TYPE);
            $args = array('orderby' => 'count', 'hide_empty' => false);
            echo cc_get_terms_dropdown($taxonomies, $args);
            ?>
        </div>                               
        <div class="label">
            <label><?php echo TAGS; ?></label>
        </div>
        <div class="row">
            <input type="text" name="cc_tags"/>
            <p class="description"><?php echo TAGS_DES; ?></p>
        </div>
        <div class="label">
            <label for="cc_desc"><?php echo DESC; ?><span class="required">*</span></label>
        </div>
        <div class="row">
            <textarea name="cc_description" id="cc_desc"></textarea>           
            <span class="desc_error"></span>
        </div>                             
    </div>
    <!--End Step1-->
    <input class="submit" type="submit" name="step1" value="<?php echo NEXT; ?>" onclick="tinyMCE.triggerSave()"/>
</form>