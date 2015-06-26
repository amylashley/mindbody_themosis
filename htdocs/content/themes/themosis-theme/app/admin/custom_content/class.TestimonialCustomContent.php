<?php
//This base class will be extended by several different kinds of data types
//This is abstract and thus should not be implemented. Just used to show structure
class TestimonialCustomContent extends CustomContent {
	
        function createHtml($meta_data){
            $html='';
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '<div class="'.$meta_data['custom_class'].'">';
            }
            
            if (isset($meta_data['container_id']) && $meta_data['container_id']!= ''){
                $html .= '<div id="'.$meta_data['container_id'].'" class="container-fluid">';
            }
            $html .= '<blockquote>';
            $html .= Meta::get($meta_data['layer_testimonial'], 'quote');
            $html .= '</blockquote>'; //end row
            $html .= '<cite>'.Meta::get($meta_data['layer_testimonial'], 'client').', '.Meta::get($meta_data['layer_testimonial'], 'company').'</cite>';
            if (isset($meta_data['container_id']) && $meta_data['container_id']!= ''){
                $html .= '</div>'; //end container-fluid
            }
            //Does this block have a custom class assigned? 
            if (isset($meta_data['custom_class']) && $meta_data['custom_class']!=''){
                $html .= '</div>'; //end custom div class
            }
            return $html;
	}
	
}
?>