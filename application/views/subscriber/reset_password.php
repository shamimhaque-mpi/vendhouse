    <!--credential include css-->
    <link rel="stylesheet" href="<?php echo base_url('public/css/credential.css');?>">
    <!-- credential section start -->
    <section class="credential_section">
        <div class="section_cover">
            
            <div class="credential_area">
                
                <div class="credential_header"> 
                   <h5 class="forgot_title" id="msg">Reset Your Password</h5>
                </div>
                
                <div class="credential_body">
                    <form action="" method="POST">
                        <div class="options" data-option="mobile">
                            <div class="form-group">
                                <input type="text" placeholder="Mobile Number" data-mobile class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <button type="button" data-get_code class="btn btn-primary mb-2">Send Code</button>
                            </div>
                        </div>
                        
                        <div class="options" data-option="code" style="display:none">
                            <div class="form-group">
                                <input type="text" placeholder="Enter Code No" data-code class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <button type="button" data-verify class="btn btn-primary mb-2">Verify Code</button>
                            </div>
                        </div>
                        
                        <div class="options" data-option="password" style="display:none">
                            <div class="form-group">
                                <input type="text" placeholder="Enter New Password" data-password class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <button type="button" data-set_password class="btn btn-primary mb-2">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div class="credential_footer">
                        <p>New to Vendhouse? <a href="<?php echo base_url('signup');?>">Sign up now</a></p>
                    </div>
                </div>
            </div>
            <!-- signup area end -->
        </div>
    </section>
    <script src="<?=site_url('private/js/custom.app.js')?>"></script>
    <!-- credential section end -->