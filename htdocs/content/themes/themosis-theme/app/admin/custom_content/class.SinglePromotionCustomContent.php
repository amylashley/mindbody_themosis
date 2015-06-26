<?php
//This base class will be extended by several different kinds of data types
//This is abstract and thus should not be implemented. Just used to show structure
class SinglePromotionCustomContent extends CustomContent {
	
        function createHtml($meta_data){
            
            $promo = get_post($meta_data['layer_single_promo']); //$promo->post_title
            $html='';
            
            if( has_post_thumbnail( $promo->ID) ){
                $feature_image_id = get_post_thumbnail_id($promo->ID); 
                $feature_image_meta = wp_get_attachment_image_src($feature_image_id,'full');
                
            }

            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '<div class="'.$meta_data['custom_class'].'">';
            }
            if (isset($meta_data['container_id']) && $meta_data['container_id']!=''){
                $html .= '<div id="'.$meta_data['container_id'].'" class="container-fluid">';
            }else {
                $html .='<div class="container-fluid">';
            }
            
            $html .= '<div class="row">';
            
            $html .= '<div class="col-xs-4 col-sm-4 col-sm-offset-2">
                                <figure><img src="'.$feature_image_meta[0].'"></figure>
                            </div>';
            
            $html .= '<div class="col-xs-8 col-sm-3 col-sm-offset-1">
                                <div class="app-callout-content">
                                    '.$promo->post_excerpt.'
                                    <a href="'.get_permalink($promo->ID) .'" class="btn">Learn More</a>
                                </div>
                            </div>';
            
            $html .= '</div>'; //end row
            $html .= '</div>'; //end container-fluid
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '</div>'; //end custom div class
            }
            return $html;
	}
        
        
	
}
?>