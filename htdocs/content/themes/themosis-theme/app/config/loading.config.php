<?php

return array(

    /**
     * Mapping for all classes without a namespace.
     * The key is the class name and the value is the
     * absolute path to your class file.
     *
     * Watch your commas...
     */
    // Controllers
    'BaseController'        => themosis_path('app').'controllers'.DS.'BaseController.php',
    'MindBodyController'        => themosis_path('app').'controllers'.DS.'MindBodyController.php',
    'LayoutController'        => themosis_path('app').'controllers'.DS.'LayoutController.php',
    'ProductsController'        => themosis_path('app').'controllers'.DS.'ProductsController.php',

    // Models
    'PostModel'             => themosis_path('app').'models'.DS.'PostModel.php',
    'MindBodyUserModel'     => themosis_path('app').'models'.DS.'MindBodyUserModel.php',
    'MindBodyProductModel'     => themosis_path('app').'models'.DS.'MindBodyProductModel.php',
    'NavigationModel'     => themosis_path('app').'models'.DS.'NavigationModel.php',
    
    //Mindbody Classes
    'SourceCredentials'       => themosis_path('app').'admin/mindbody/includes/mbapi.php',
    'MBAPIService'            => themosis_path('app').'admin/mindbody/includes/mbapi.php',
    'MBSaleService'           => themosis_path('app').'admin/mindbody/includes/saleService.php',
    
    //Layout Editor
    'ContentFactory'           => themosis_path('app').'admin/custom_content/class.ContentFactory.php',
    'CustomContent'            => themosis_path('app').'admin/custom_content/class.CustomContent.php',
    'SingleColCustomContent'   => themosis_path('app').'admin/custom_content/class.SingleColCustomContent.php',
    'TwoColCustomContent'   => themosis_path('app').'admin/custom_content/class.TwoColCustomContent.php',
    'ThreeColCustomContent'   => themosis_path('app').'admin/custom_content/class.ThreeColCustomContent.php',
    'FourColCustomContent'   => themosis_path('app').'admin/custom_content/class.FourColCustomContent.php',
    'LayerSliderCustomContent'   => themosis_path('app').'admin/custom_content/class.LayerSliderCustomContent.php',
    'TestimonialCustomContent'   => themosis_path('app').'admin/custom_content/class.TestimonialCustomContent.php',
    'PageLinksCustomContent'   => themosis_path('app').'admin/custom_content/class.PageLinksCustomContent.php',
    'IconDefinitionsCustomContent' => themosis_path('app').'admin/custom_content/class.IconDefinitionsCustomContent.php',
    'SinglePromotionCustomContent' => themosis_path('app').'admin/custom_content/class.SinglePromotionCustomContent.php',
    'RecentPromotionsCustomContent' => themosis_path('app').'admin/custom_content/class.RecentPromotionsCustomContent.php',
    'StaffBiosCustomContent' => themosis_path('app').'admin/custom_content/class.StaffBiosCustomContent.php',

    // Miscellaneous

);
