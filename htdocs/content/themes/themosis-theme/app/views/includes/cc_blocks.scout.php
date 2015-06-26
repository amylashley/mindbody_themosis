 <!--now we start pulling in the content boxes-->
                <?php 
               // global $npp_content_blocks;                
                if( isset( $npp_content_blocks) ){
                    $npp_content_blocks->the_meta();
                    while( $npp_content_blocks->have_fields( 'npp_content_blocks' ) ){                     
                        //echo '<h3>' . sprintf( __( 'Text Area #%d', 'wpalchemy-grail' ), $npp_content_blocks->get_the_index() + 1 ) . '</h3>';
                        $data_format =  $npp_content_blocks->get_the_value( 'r_ex2' );
                        $custom_title = $npp_content_blocks->get_the_value('custom_title');
                        
                        if ($data_format >= 7){ //this indicates a component
                            switch ($data_format) {
                                case '7':  //related posts slider
                                if ($custom_title!=''){
                                    echo do_shortcode('[npp-related-posts-slider custom_title="'.$custom_title.'"]');
                                }else {
                                    echo do_shortcode('[npp-related-posts-slider]');
                                }                                    
                                break;
                                case '8':  //child pages
                                    if ($custom_title!=''){
                                        echo do_shortcode('[npp-child-pages custom_title="'.$custom_title.'"]');
                                    }else {
                                        echo do_shortcode('[npp-child-pages]');
                                    }  
                                    break;
                                case '9':  //marketing message
                                   ?>
                                   <div class="branding-box" style="background-image:url(<?php echo $npp_content_blocks->the_value( 'imgurl' ); ?>);">
                                        <?php  if ($npp_content_blocks->the_value( 'custom_title' )!=''){
                                        //echo '<h2 class="module-header">'+ $npp_content_blocks->the_value( 'custom_title' )+'</h2>';
                                        } ?>
                                        <div class="abs-content">
                                            <h2><?php echo $npp_content_blocks->the_value( 'imgtitle' ); ?></h2>
                                            <p>
                                                <?php echo $npp_content_blocks->the_value( 'imgcontent' ); ?>
                                            </p>
                                            <a href="<?php echo $npp_content_blocks->the_value( 'target-url' ); ?>" class="btn primary"><?php echo $npp_content_blocks->the_value( 'imgbtntext' ); ?></a>
                                        </div>
                                    </div>

                                   <?php                                  
                                    break;
                                case '10':  //find jobs listings
                                
                                if ($custom_title!=''){
                                    echo do_shortcode('[npp-find-positions custom_title="'.$custom_title.'"]');
                                }else {
                                    echo do_shortcode('[npp-find-positions]');
                                }  
                                   
                                    break;
                                case '11':  //become a partner
                                    if ($custom_title!=''){
                                    echo do_shortcode('[npp-become-a-partner custom_title="'.$custom_title.'"]');
                                }else {
                                    echo do_shortcode('[npp-become-a-partner]');
                                } 
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                        }else {
                            switch ($data_format) {
                                case '1':  //related posts slider
                                ?>
                                <div class="secondary-content">
                                  <?php  if ($npp_content_blocks->the_value( 'custom_title' )!=''){
                                        echo '<h2 class="module-header">'+ $npp_content_blocks->the_value( 'custom_title' )+'</h2>';
                                    } ?>
                                    <div class="col-container">
                                        <div class="col-12">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-0' ) ) ) ); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    break;
                                case '2':  //child pages          
                                ?>                          
                                <div class="secondary-content">
                                     <?php  if ($npp_content_blocks->the_value( 'custom_title' )!=''){
                                        echo '<h2 class="module-header">'+ $npp_content_blocks->the_value( 'custom_title' )+'</h2>';
                                    } ?>
                                    <div class="col-container">
                                        <div class="col-6">
                                            <?php echo esc_html( apply_filters( 'meta_content', $npp_content_blocks->the_value( 'textarea-0' ) ) ); ?>
                                        </div>
                                        <div class="col-6">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-1' ) ) ) ); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    break;
                                case '3':  //marketing message
                                ?>                          
                                <div class="secondary-content">
                                    <?php  if ($npp_content_blocks->the_value( 'custom_title' )!=''){
                                        echo '<h2 class="module-header">'+ $npp_content_blocks->the_value( 'custom_title' )+'</h2>';
                                    } ?>
                                    <div class="col-container">
                                        <div class="col-4">
                                           <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-0' ) ) ) ); ?>
                                        </div>
                                        <div class="col-4">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-1' ) ) ) ); ?>
                                        </div>
                                        <div class="col-4">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-2' ) ) ) ); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    break;
                                case '4':  
                                    ?>                          
                                <div class="secondary-content">
                                    <?php  if ($npp_content_blocks->the_value( 'custom_title' )!=''){
                                        echo '<h2 class="module-header">'+ $npp_content_blocks->the_value( 'custom_title' )+'</h2>';
                                    } ?>
                                    <div class="col-container">
                                        <div class="col-3">
                                           <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-0' ) ) ) ); ?>
                                        </div>
                                        <div class="col-3">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-1' ) ) ) ); ?>
                                        </div>
                                        <div class="col-3">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-2' ) ) ) ); ?>
                                        </div>
                                        <div class="col-3">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-3' ) ) ) ); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    break;
                                case '5':  
                                        ?>                          
                                <div class="secondary-content">
                                    <?php  if ($npp_content_blocks->the_value( 'custom_title' )!=''){
                                        echo '<h2 class="module-header">'+ $npp_content_blocks->the_value( 'custom_title' )+'</h2>';
                                    } ?>
                                    <div class="col-container">
                                        <div class="col-8">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-0' ) ) ) ); ?>
                                        </div>                                        
                                        <div class="col-4">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-1' ) ) ) ); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    break;
                                case '6':  
                                            ?>                          
                                <div class="secondary-content">
                                    <?php  if ($npp_content_blocks->the_value( 'custom_title' )!=''){
                                        echo '<h2 class="module-header">'+ $npp_content_blocks->the_value( 'custom_title' )+'</h2>';
                                    } ?>
                                    <div class="col-container">
                                        <div class="col-4">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-0' ) ) ) ); ?>
                                        </div>
                                        <div class="col-8">
                                            <?php echo esc_html( apply_filters( 'meta_content', html_entity_decode( $npp_content_blocks->the_value( 'textarea-1' ) ) ) ); ?>
                                        </div>                          
                                        
                                    </div>
                                </div>
                                <?php
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                        }
                    }
                }else {
                    echo "&nbsp;";
                }

              ?>   