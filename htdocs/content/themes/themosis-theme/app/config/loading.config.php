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

    // Models
    'PostModel'             => themosis_path('app').'models'.DS.'PostModel.php',
    'MindBodyUserModel'     => themosis_path('app').'models'.DS.'MindBodyUserModel.php',
    'MindBodyProductModel'     => themosis_path('app').'models'.DS.'MindBodyProductModel.php',
    
    //Mindbody Classes
    'SourceCredentials'       => themosis_path('app').'admin/mindbody/includes/mbapi.php',
    'MBAPIService'            => themosis_path('app').'admin/mindbody/includes/mbapi.php',
    'MBSaleService'           => themosis_path('app').'admin/mindbody/includes/saleService.php',

    // Miscellaneous

);
