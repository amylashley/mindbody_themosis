<?php
//This base class will be extended by several different kinds of data types
//This is abstract and thus should not be implemented. Just used to show structure
class IconDefinitionsCustomContent extends CustomContent {
	
        function createHtml($meta_data){
            
            $icons = $this->getAllActiveIcons();
            $html='';

            
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '<div class="'.$meta_data['custom_class'].'">';
            }
            if (isset($meta_data['custom_title']) && $meta_data['custom_title']!=''){
                $html .= '<h2>'.$meta_data['custom_title'].'</h2>';
            }
            if (isset($meta_data['container_id']) && $meta_data['container_id']!=''){
                $html .= '<div id="'.$meta_data['container_id'].'" class="container-fluid">';
            }else {
                $html .='<div class="container-fluid">';
            }
            
            $html .= '<div class="row">';
           
            $counter = 0;
            foreach($icons as $icon){
                $html .= '<div class="col-sm-5 ';
                if ($counter== 0) { $html .= 'col-sm-offset-1';}
                $html .= '">';
                $html .= '<div class="benefit-item">
                                    <div class="benefit-image">';
                if (isset($icon['image'])){
                    $html .= '<img src="'.$icon['image'].'">';
                }
                $html .= ' </div>
                                    <h3>'.$icon['title'].'</h3>
                                    <p>'.$icon['content'].'</p>
                                </div>
                            </div>';
                if ($counter==1){$counter=0;}else{$counter=1;} //toggle counter
            }
        
            
            $html .= '</div>'; //end row
            $html .= '</div>'; //end container-fluid
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '</div>'; //end custom div class
            }
            return $html;
	}
        
        protected function getAllActiveIcons(){
            $icons = array();
            $the_query = new WP_Query( array( 'post_type' => 'icon', 'post_status'=>'publish'));
            
            if ( $the_query->have_posts()) :
                    while ($the_query->have_posts() ) : $the_query->the_post();
                            $this_icon = array();
                            $this_icon['title'] = get_the_title();
                            $this_icon['content'] = get_the_content();
               
                            if (has_post_thumbnail() ): 
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); 
                                $this_icon['image'] = $image[0];
                            endif; 
                            array_push($icons, $this_icon);
                    endwhile;
            else :
                wp_reset_postdata();
                return false;
            endif;

            wp_reset_postdata();
            return $icons;
        }
	
}
?>