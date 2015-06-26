@include('header')
    <!--include banner here-->
    @loop

    {{ Loop::content() }}

    @endloop
    <main id="main-content">
        <div class="product-grid center-grid white-stripe">
                    
                    
                    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                          </div>
                          <div class="modal-body">
                            <form>
                              <div class="form-group">
                                <label for="recipient-name" class="control-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name">
                              </div>
                              <div class="form-group">
                                <label for="message-text" class="control-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Send message</button>
                          </div>
                        </div>
                      </div>
                    </div>
            <div class="container-fluid">
                        <div class="row">
                            @query(array('post_type'         => 'mb_product',
                                         'posts_per_page'    => -1,
                                         'post_status'       => 'publish'))

                          
                            <div class="col-xs-6 col-sm-3">
                                <a href="#" class="product-item" data-toggle="modal" data-target="#productModal" data-whatever="@mdo">
                                    <div class="img-container">
                                        {{Loop::thumbnail('medium')}}
                                    </div>
                                    <h3>{{ Loop::title() }}</h3>
                                    <p class="price">
                                        <strong><sup>$</sup>{{ Meta::get(Loop::id(), 'mb_price') }}</strong> (1 count)  |  <strong><sup>$</sup>???</strong> (5 count)
                                    </p>
                                    <div class="btn">Book Now</div>
                                </a>
                            </div>

                            @endquery
                            
                            <div class="col-xs-6 col-sm-3">
                                <a href="#" class="product-item">
                                    <div class="img-container">
                                        <img src="img/download.png">
                                    </div>
                                    <h3>Download a Menu of Services</h3>
                                </a>
                            </div>
                        </div>
                    </div>
        </div><!--end product-grid-->
        <?php echo $custom_content; ?>
    </main>
@include('footer')
