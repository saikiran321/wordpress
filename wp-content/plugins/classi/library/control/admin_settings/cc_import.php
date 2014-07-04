<div class="wrap" id="of_container">
    <div id="of-popup-save" class="of-save-popup">
        <div class="of-save-save"></div>
    </div>
    <div id="of-popup-reset" class="of-save-popup">
        <div class="of-save-reset"></div>
    </div>
    <div id="header">
        <div class="logo">
            <h2><?php echo IMPRT_EXPRT; ?> <?php echo OPTIONS; ?></h2>
        </div>
        <a href="http://www.inkthemes.com" target="_new">
            <div class="icon-option"> </div>
        </a>
        <div class="clear"></div>
    </div>
    <div id="main">
        <div id="of-nav">
            <ul>
                <li> <a  class="pn-view-a" href="#of-option-import" title="Import Export"><?php echo IMPRT_EXPRT; ?></a></li> 
            </ul>
        </div>
        <div id="content">                                   
            <div class="group" id="of-option-import">
                <div class="section section-text trialhint">
                    <br/>
                    <h3 class="heading"><?php echo "Export to CSV from ads"; ?> (Only Work In Premium Version)</h3>
                    <div class="option">
                        <div class="controls">
                            <a class="button-primary" href="" title="Export to CSV"><?php echo EXPRT_CSV; ?></a>                      
                        </div>
                        <div class="explain"><p> </p></div>
                        <div class="clear"> </div>
                    </div>
                </div>
                <style type="text/css">
                    #submit_csv{
                        width:70px !important;
                    }
                </style>
                <div class="clear"></div>
                <br/><br/>
                <div class="section section-text trialhint">
                    <h3 class="heading"><?php echo UPLD_CSV; ?> (Only Work In Premium Version)</h3>
                    <div class="option">
                        <div class="controls">
                            <form action="<?php admin_url('wp-admin/admin.php?page=import'); ?>" method="post"  enctype="multipart/form-data">
                                <input type="file" name="upload_csv" id="upload_csv"/> 
                                <input type="submit" class="button-primary" id="submit_csv" name="submit_csv" value="<?php echo IMPRT; ?>"/>
                            </form>                    
                        </div>
                        <div class="explain"><p> </p></div>
                        <div class="clear"> </div>
                    </div>
                </div>
                <div class="section section-text ">              
                    <div class="option">
                        <div class="controls">
                            <?php
                            if (isset($_REQUEST['upload_msg'])) {
                                $upload_msg = $_REQUEST['upload_msg'];
                                if ($_REQUEST['upload_msg'] == 'success') {
                                    echo "<h3>" . IMPRT_SUCCESS . "</h3>";
                                }
                            } elseif (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 'error') {
                                echo "<h3>" . UPLD_ERR . "</h3>";
                            } elseif (isset($_REQUEST['emsg']) && $_REQUEST['emsg'] == 'invalid_file') {
                                echo "<h3>" . INV_FILE . "</h3>";
                            } elseif (isset($_REQUEST['emsg']) && $_REQUEST['emsg'] == 'csvonly') {
                                echo "<h3>" . ALW_CSV > "</h3>";
                            } elseif (isset($_REQUEST['emsg']) && $_REQUEST['emsg'] == 'tmpfile') {
                                echo "<h3>" . TMP_FILE . "</h3>";
                            }
                            ?>
                        </div>
                        <div class="explain"><p> </p></div>
                        <div class="clear"> </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div> 
        </div>
        <div class="clear"></div>
    </div>
    <div class="save_bar_top">
        <img style="display:none" src="<?php echo ADMINURL; ?>/admin/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
<!--            <input type="submit" id="submit" name="submit" value="<?php echo SAVE_ALL_CHNG; ?>" class="button-primary" />      -->


    </div>            
    <div style="clear:both;"></div>

</div>
<!--wrap-->