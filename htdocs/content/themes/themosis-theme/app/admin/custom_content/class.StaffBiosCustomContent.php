<?php
//This base class will be extended by several different kinds of data types
//This is abstract and thus should not be implemented. Just used to show structure
class StaffBiosCustomContent extends CustomContent {
	
        function createHtml($meta_data){
            $staff_ids = json_decode($meta_data['staff-bios']);
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
                $html .= '<div class="container-fluid">';
            }
            $html .= '<div class="row">';
            
            $html .= '<div class="col-sm-10 col-sm-offset-1">
                                <p>
                                    The Solution is staffed by licensed medical professionals, including 
                                    Doctors and Registered Nurse Practitioners. The quality of care you 
                                    receive as a client exceeds standards established by the State of California. 
                                    Our HealthPorts are clean, modern, state-of-the-art facilities, professionally 
                                    managed to ensure your experience is exceptional
                                </p>
                            </div>';
            
            $counter = 0;
            foreach($staff_ids as $staff_id){
                $this_staff = get_post($staff_id);
                $html .= '<div class="col-xs-6 col-sm-2">
                                <div class="bio-item">';
                if( has_post_thumbnail( $this_staff->ID) ){
                    $feature_image_id = get_post_thumbnail_id($this_staff->ID); 
                    $feature_image_meta = wp_get_attachment_image_src($feature_image_id,'full');
                    $html .= '<img src="'.$feature_image_meta[0].'">';
                }
                $html .='<h4>'.$this_staff->post_title.' <span class="title">'.$this_staff->post_excerpt.'</span></h4>
                                </div>
                            </div>';
                
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