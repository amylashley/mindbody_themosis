<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $wpalchemy_media_access; ?>
<div class="my_meta_control">
 	
	<p class="warning"><i><?php _e( 'These textareas will NOT work without javascript enabled.' );?></i></p> 
	<p><?php _e( 'You can add custom content blocks to any page using the "NPP Basic Page" template. ' );?></p> 
	<a href="#" class="dodelete-npp_content_blocks button"><?php _e('Remove All', 'wpalchemy-grail');?></a> 
	<p><?php _e( 'Add new textareas by using the "Add Textarea" button.  Rearrange the order of textareas by dragging and dropping.', 'wpalchemy-grail' );?></p>
 
	

	<?php while( $mb->have_fields_and_multi( 'npp_content_blocks' ) ): ?>

	<?php $mb->the_group_open(); ?>

	<div class="group-wrap <?php echo $mb->get_the_value( 'toggle_state' ) ? ' closed' : ''; ?>" >

		<?php $mb->the_field('toggle_state'); ?>
		<?php // @ TODO: toggle should be user specific ?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="1" <?php checked( 1, $mb->get_the_value() ); ?> class="toggle_state hidden" />

		<div class="group-control dodelete" title="<?php _e( 'Click to remove Slide', 'wpalchemy-grail' );?>"></div>
		<div class="group-control toggle" title="<?php _e( 'Click to toggle', 'wpalchemy-grail' );?>"></div>
		
		<h3 class="handle">Content Block</h3>
		<HR>

		

		
		<?php // need to html_entity_decode() the value b/c WP Alchemy's get_the_value() runs the data through htmlentities() ?>


			
		<div class="group-inside">	
			<?php $mb->the_field('custom_title'); ?>
			<p>Content block title to display on page</p>
			<input type="text" class="custom_title" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/><BR>

                        <?php $mb->the_field('custom_class'); ?>
			<p>Custom class name for block wrapper</p>
			<input type="text" class="custom_class" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/><BR>
                        
                         <?php $mb->the_field('container_id'); ?>
			<p>ID value for the container element inside the wrapper class (if applicable).</p>
			<input type="text" class="container_id" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/><BR>
                        
                        
			<p>Please select the display format you want in this block. Then enter content in the text areas below. Please note that for </p>
			<?php $displays = array('1','2','3','4','5','6','7','8','9','10','11'); ?>
			<table>
			<?php foreach ($displays as $i => $display){
				$mb->the_field('r_ex2'); 
			if ($i==0 || $i==6){
				if($i!=0){ 
			?>
				</tr>
				<tr>
				<td title="Test Title"><input type="radio"  class="r-ex2" name="<?php $mb->the_name(); ?>" value="<?php echo $display; ?>"<?php $mb->the_radio_state($display); ?>/><label id="r-rex2-<?php echo $display; ?>"><?php echo $display; ?></label></td>
			<?php
				}else{ ?>
				<tr><td title="Test Title"><input type="radio" class="r-ex2"  name="<?php $mb->the_name(); ?>" value="<?php echo $display; ?>"<?php $mb->the_radio_state($display); ?>/><label id="r-rex2-<?php echo $display; ?>"><?php echo $display; ?></label></td>	
			<?php	}
			}else {?>
				<td title="Test Title"><input type="radio" class="r-ex2"  name="<?php $mb->the_name(); ?>" value="<?php echo $display; ?>"<?php $mb->the_radio_state($display); ?>/><label id="r-rex2-<?php echo $display; ?>"><?php echo $display; ?></label></td>
			<?php
			}?>
			<?php } ?>
			</tr>
			</table>
			<?php $mb->the_field('cols'); ?>
			<input type="hidden" class="no-cols" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
			<div class="npp-user-msg" style="display:none;"></div>

			<div class="npp-branding-box" style="display:none;"><p>Please select an image and enter a target URL for your branding box</p>				

				<?php $mb->the_field('imgurl'); ?>
				<p>
					<?php echo $wpalchemy_media_access->getField(array('name'=> $mb->get_the_name(), 'value'=>$mb->get_the_value())); ?>
					<?php echo $wpalchemy_media_access->getButton(); ?>
				</p>
				<?php $wpalchemy_media_access->setGroupName('n' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
				
				<?php $mb->the_field('imgtitle'); ?>
				<span>Enter a Title</span>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>				

				<?php $mb->the_field('imgcontent'); ?>
				<span>Enter the main content</span>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>				

				<?php $mb->the_field('imgbtntext'); ?>
				<span>Enter the text for the button</span>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>				

				<?php $mb->the_field('target-url'); ?>
				<span>Enter a valid target URL</span>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
				
			</div> <!--end branding box-->
                        
                        <div class="choose-slider-box" style="display:none;"><p>Please select the slider that you'd like to display:</p>				

				
				<?php $mb->the_field('layer_slider'); ?>
				<span>Enter Slider Shortcode</span>
				<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>				
				
			</div> <!--end choose-slider box-->
                        
                        <div class="testimonials-box" style="display:none;"><p>Please select the testimonial that you'd like to display:</p>				
                                <?php $mb->the_field('layer_testimonial'); ?>
				<?php $query = new WP_Query( array( 'post_type' => 'testimonials') );  ?>
                                
                                
                                <select name="<?php $mb->the_name(); ?>">
                                 <?php  while ( $query->have_posts() ) : $query->the_post();
                                            if ($mb->the_value()==''){
                                               ?><option value="-1">Please choose a testimonial</option><?php
                                            }
                                            echo '<option value="'. get_the_ID() .'"'; $thevalue = get_the_ID(); if ($mb->get_the_value() == "$thevalue") echo 'selected'; ?> 
<?php echo '>' . get_the_title() .'</option>';
                                        endwhile;
                                ?>
                                </select>
				
			</div> <!--end testimonials box-->

			<p class="warning update-warning"><?php _e( 'Sort order has been changed.  Remember to save the post to save these changes.' );?></p>
	
			<?php
			// 'html' is used for the "Text" editor tab.
			if ( 'html' === wp_default_editor() ) {
				add_filter( 'the_editor_content', 'wp_htmledit_pre' );
				$switch_class = 'html-active';
			} else {
				add_filter( 'the_editor_content', 'wp_richedit_pre' );
				$switch_class = 'tmce-active';
			}
			?>
			<?php $mb->the_field('textarea-0'); ?>
			<div id="customEditor-0" class="customEditor-0 customEditor wp-core-ui wp-editor-wrap <?php echo 'tmce-active'; //echo $switch_class;?>">				
				<div class="wp-editor-tools hide-if-no-js">
					<div class="wp-media-buttons custom_upload_buttons">
						<?php do_action( 'media_buttons' ); ?>
					</div>
					<div class="wp-editor-tabs">
						<a data-mode="html" class="wp-switch-editor switch-html"> <?php _ex( 'Text', 'Name for the Text editor tab (formerly HTML)' ); ?></a>
						<a data-mode="tmce" class="wp-switch-editor switch-tmce"><?php _e('Visual'); ?></a>
					</div>

				</div><!-- .wp-editor-tools -->

				<div class="wp-editor-container">
					<textarea class="wp-editor-area" rows="10" cols="50" name="<?php $mb->the_name(); ?>" rows="3"><?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $mb->get_the_value() ) ) ); ?></textarea>
				</div>
				<p><span><?php _e('Enter in some text');?></span></p>

			</div>
			<?php $mb->the_field('textarea-1'); ?>
			<div id="customEditor-1" class="customEditor-1 customEditor wp-core-ui wp-editor-wrap <?php echo 'tmce-active'; //echo $switch_class;?>">				
				<div class="wp-editor-tools hide-if-no-js">
					<div class="wp-media-buttons custom_upload_buttons">
						<?php do_action( 'media_buttons' ); ?>
					</div>
					<div class="wp-editor-tabs">
						<a data-mode="html" class="wp-switch-editor switch-html"> <?php _ex( 'Text', 'Name for the Text editor tab (formerly HTML)' ); ?></a>
						<a data-mode="tmce" class="wp-switch-editor switch-tmce"><?php _e('Visual'); ?></a>
					</div>

				</div><!-- .wp-editor-tools -->

				<div class="wp-editor-container">
					<textarea class="wp-editor-area" rows="10" cols="50" name="<?php $mb->the_name(); ?>" rows="3"><?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $mb->get_the_value() ) ) ); ?></textarea>
				</div>
				<p><span><?php _e('Enter in some text');?></span></p>

			</div>
			<?php $mb->the_field('textarea-2'); ?>
			<div id="customEditor-2" class="customEditor-2 customEditor wp-core-ui wp-editor-wrap <?php echo 'tmce-active'; //echo $switch_class;?>">				
				<div class="wp-editor-tools hide-if-no-js">
					<div class="wp-media-buttons custom_upload_buttons">
						<?php do_action( 'media_buttons' ); ?>
					</div>
					<div class="wp-editor-tabs">
						<a data-mode="html" class="wp-switch-editor switch-html"> <?php _ex( 'Text', 'Name for the Text editor tab (formerly HTML)' ); ?></a>
						<a data-mode="tmce" class="wp-switch-editor switch-tmce"><?php _e('Visual'); ?></a>
					</div>

				</div><!-- .wp-editor-tools -->

				<div class="wp-editor-container">
					<textarea class="wp-editor-area" rows="10" cols="50" name="<?php $mb->the_name(); ?>" rows="3"><?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $mb->get_the_value() ) ) ); ?></textarea>
				</div>
				<p><span><?php _e('Enter in some text');?></span></p>

			</div>
			<?php $mb->the_field('textarea-3'); ?>
			<div id="customEditor-3" class="customEditor-3 customEditor wp-core-ui wp-editor-wrap <?php echo 'tmce-active'; //echo $switch_class;?>">				
				<div class="wp-editor-tools hide-if-no-js">
					<div class="wp-media-buttons custom_upload_buttons">
						<?php do_action( 'media_buttons' ); ?>
					</div>
					<div class="wp-editor-tabs">
						<a data-mode="html" class="wp-switch-editor switch-html"> <?php _ex( 'Text', 'Name for the Text editor tab (formerly HTML)' ); ?></a>
						<a data-mode="tmce" class="wp-switch-editor switch-tmce"><?php _e('Visual'); ?></a>
					</div>

				</div><!-- .wp-editor-tools -->

				<div class="wp-editor-container">
					<textarea class="wp-editor-area" rows="10" cols="50" name="<?php $mb->the_name(); ?>" rows="3"><?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $mb->get_the_value() ) ) ); ?></textarea>
				</div>
				<p><span><?php _e('Enter in some text');?></span></p>

			</div>

		

		</div><!-- .group-inside -->

	</div><!-- .group-wrap -->

	<?php $mb->the_group_close(); ?>
	<?php endwhile; ?>

	<p><a href="#" class="docopy-npp_content_blocks button"><span class="icon add"></span><?php _e( 'Add Another Content Block', 'wpalchemy-grail' );?></a></p>	
		
	<p class="meta-save"><button type="submit" class="button-primary" name="save"><?php _e('Update');?></button></p>

</div>