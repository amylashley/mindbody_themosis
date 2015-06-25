<footer>
                <div class="container-fluid">
                    <div class="row">
                        <nav id="footer-nav" class="col-sm-8">
                            <?php wp_nav_menu( $fm_left_defaults ); ?>

                            <?php wp_nav_menu( $fm_center_defaults ); ?>

                            <?php wp_nav_menu( $fm_right_defaults ); ?>
                        </nav>
                        <?php wp_nav_menu( $sm_defaults ); ?>
                    </div>
                </div>
            </footer>
        <?php wp_footer();?>    
        </div>
    </body>
</html>
