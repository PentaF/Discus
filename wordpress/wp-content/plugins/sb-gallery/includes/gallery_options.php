<div class="admin-form-wrap">
<?php 
    if($_POST['azalaan_hidden'] == 'Y') { 
        $hover_effect = $_POST['hover_effect'];
        update_option('hover_effect', $hover_effect);
         
        $fancybox_setting = $_POST['fancybox_setting'];
        update_option('fancybox_setting', $fancybox_setting);
       
        ?>
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
        <?php
    }
?>
<?php 
$hover_effect=  get_option('hover_effect');
$fancybox_setting= get_option('fancybox_setting');
?>
    <?php    echo "<h2>" . __( 'SB Gallery Settings', 'azalaan_heading' ) . "</h2>"; ?>
<form name="azalaan_settings_form" class="sb_gallery" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="azalaan_hidden" value="Y">
	  				<div class="form-sb-field">
                      <label class="control-label" for="Select Over Effect">Images Hover Effect:</label>
                     
                        <select id="Select Over Effect" name="hover_effect" class="input-xlarge">
                         <option value="no-effect" <?php if($hover_effect=='no-effect'){?> selected<?php }?>>No-Effect</option>
                        <option value="blur" <?php if($hover_effect=='blur'){?> selected<?php }?>>Blur on Hover</option>
                        <option value="tilt" <?php if($hover_effect=='tilt'){?> selected<?php }?>>Tilt on Hover</option>
                        <option value="morph" <?php if($hover_effect=='morph'){?> selected<?php }?>>Morph on Hover</option>
                        <option value="bw" <?php if($hover_effect=='bw'){?> selected<?php }?>>Grey Scale on Hover</option>
                        </select>  
                        </div>
                        
                        <div class="form-sb-field">
                      <label class="control-label" for="Popup">Fancy Box:</label>
                     
                        <select id="fancybox_setting" name="fancybox_setting" class="input-xlarge">
                          <option value="off"  <?php if($fancybox_setting=='off'){?> selected<?php }?>>Off</option>
                        	<option value="on"  <?php if($fancybox_setting=='on'){?> selected<?php }?>>On</option> 
                        </select>  
                        </div>
                        <div class="form-sb-field">
				<input type="submit" class="button button-primary button-large" name="Submit"  value="Save Gallery Settings" />			
                		</div>
			 
			</form>

</div>