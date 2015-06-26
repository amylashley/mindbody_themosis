<?php
//This base class will be extended by several different kinds of data types
//This is abstract and thus should not be implemented. Just used to show structure
class PageLinksCustomContent extends CustomContent {
	
        function createHtml($meta_data){
            $html='';
            
            $page_ids = json_decode($meta_data['layer_page_links']);
            
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '<div class="'.$meta_data['custom_class'].'">';
            }
            if (isset($meta_data['container_id']) && $meta_data['container_id']!=''){
                $html .= '<div id="'.$meta_data['container_id'].'" class="container-fluid">';
            }else {
                $html .= '<div class="container-fluid">';
            }
            $html .= '<div class="row">';
            
            foreach($page_ids as $page_id){
                $this_page = get_post($page_id);
                $html .='<div class="col-sm-3">';
                if( has_post_thumbnail( $this_page->ID) ){
                    $feature_image_id = get_post_thumbnail_id($this_page->ID); 
                    $feature_image_meta = wp_get_attachment_image_src($feature_image_id,'full');
                    $html .= '<a href="'.  get_permalink($this_page->ID).'" class="product-section-item" style="background-image:url('.$feature_image_meta[0].')">';
                }else {
                    $html .= '<a href="'.  get_permalink($this_page->ID).'" class="product-section-item">';
                }
                
                $html .= '<h3>'.$this_page->post_title.'</h3>
                                </a>';            
                $html .= '</div>'; //end col-sm-3
                
            }
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