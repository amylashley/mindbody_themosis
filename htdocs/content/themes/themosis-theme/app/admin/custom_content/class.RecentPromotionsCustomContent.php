<?php
//This base class will be extended by several different kinds of data types
//This is abstract and thus should not be implemented. Just used to show structure
class RecentPromotionsCustomContent extends CustomContent {
	
        function createHtml($meta_data){
            
            $html='';
            
            $args = array(
            'numberposts' => 3,
            'offset' => 0,
            'category' => 'promotions',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish');

            $recent_posts = wp_get_recent_posts( $args );
            
            
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '<div class="'.$meta_data['custom_class'].'">';
            }
           
            $html .= '<div class="row">';
            
            $counter=0;
            foreach( $recent_posts as $recent ){
                if( has_post_thumbnail($recent["ID"]) ){
                    $feature_image_id = get_post_thumbnail_id($recent["ID"]); 
                    $feature_image_meta = wp_get_attachment_image_src($feature_image_id,'full');
                }
                if ($counter==0){
                    $html .= '<div class="col-sm-6">
                            <div class="callout-item primary" style="background-image: url('.$feature_image_meta[0].');">';
                }else {
                    $html .= '<div class="col-sm-3">
                            <div class="callout-item" style="background-image: url('.$feature_image_meta[0].');">';
                }
                $html .= '<h3>'.$recent["post_title"].'</h3>
                            <p>'.$recent["post_excerpt"].'</p>
                                <div class="btn-row">
                                    <a href="'.get_permalink($recent["ID"]).'" class="btn">Learn More</a>
                                </div>
                            </div>
                        </div>';
                $counter++;
            }

            $html .= '</div>'; //end row
           
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '</div>'; //end custom div class
            }
            return $html;
	}
        
        
	
}
?>