<?php
class MindBodyProductModel {
        /**
	 * Return all published products.
	 * 
	 * @return \WP_Query
	*/
         public static function all()
        {
            $query = new WP_Query(array(
                'post_type'         => 'mb_product',
                'posts_per_page'    => -1,
                'post_status'       => 'publish'
            ));

            return $query->get_posts();
        }
}
?>