<?php

class NavigationModel{
    /*
     * Default arguments for our social media menu
     * @array
     */
    protected $sm_defaults;
    
    /*
     * Default args for header menu
     * @array
     */
    protected $hm_defaults;
    
    /*
     * Default args for footer menus. 
     * @array
     */
    protected $fm_defaults;
    
    /*
     * Default args for left footer menus. 
     * @array
     */
    protected $fm_left_defaults;
    
    /*
     * Default args for right footer menus. 
     * @array
     */
    protected $fm_right_defaults;
    
    /*
     * Default args for center footer menus. 
     * @array
     */
    protected $fm_center_defaults;
    
    public function __construct() {
        $this->create_menus();
    }
    
    function get_hm_defaults(){
        return $this->hm_defaults;
    }
    
    function get_fm_defaults(){
        return $this->fm_defaults;
    }
    
    function get_sm_defaults(){
        return $this->sm_defaults;
    }
    
    function get_fm_right_defaults(){
        return $this->fm_right_defaults;
    }
    
    function get_fm_left_defaults(){
        return $this->fm_left_defaults;
    }
    
    function get_fm_center_defaults(){
        return $this->fm_center_defaults;
    }
    
    /*
     * The footer menu will have to be created here in this controller
     * because the formatting is not standard so we cannot use the built
     * in wordpress function
     */
    public function setFooterMenus(){
        //<nav id="footer-nav" class="col-sm-8">
        $this->fm_defaults = array(
        'theme_location'  => 'social_media',
        'menu'            => '',
        'container'       => 'nav',
        'container_class' => 'col-sm-8',
        'container_id'    => 'footer-nav',
        'menu_class'      => '',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        );
        
        $this->fm_left_defaults = array(
        'theme_location'  => 'footer_left_menu',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => '',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        );
        
        $this->fm_right_defaults = array(
        'theme_location'  => 'footer_right_menu',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => '',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        );
        
        $this->fm_center_defaults = array(
        'theme_location'  => 'footer_center_menu',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => '',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul class="two-column">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        );
        
        
    }
    
    public function setHeaderMenu(){
        //<div id="nav-wrapper">
        $this->hm_defaults = array(
        'theme_location'  => 'header-nav',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => '',
        'container_id'    => 'nav-wrapper',
        'menu_class'      => '',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul class="container-fluid">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        );
    }
    
    public function setSocialMedia(){
        $this->sm_defaults = array(
        'theme_location'  => 'social_media',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'col-sm-2 col-sm-offset-2"',
        'container_id'    => 'social-links',
        'menu_class'      => '',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        );
    }
    
    private function create_menus(){
        $this->setFooterMenus();
        $this->setHeaderMenu();
        $this->setSocialMedia();
    }
    
    
}
