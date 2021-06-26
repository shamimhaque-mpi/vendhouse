    <!--credential include css-->
    <link rel="stylesheet" href="<?php echo base_url('public/css/credential.css');?>">
    <style>
        .d-none {
            display: none;
        }
    </style>
    <!-- credential section start -->
    <section class="credential_section">
        <div class="container">
            <?php  if(isset($_GET['user'])){ ?>
                <div class="alert alert-success" style="margin-top:15px;"><h3><i class="fa fa-warning"></i> Success</h3><button type="button" class="close"><span aria-hidden="true">×</span></button><p>Sign Up Complete</p></div>
            <?php } ?>
            
            <?php  if(isset($_GET['msg'])){ ?>
                <div class="alert alert-success" style="margin-top:15px;"><h3><i class="fa fa-warning"></i> Success</h3><button type="button" class="close"><span aria-hidden="true">×</span></button><p><?=($_GET['msg'])?></p></div>
            <?php } ?>
        </div>    
        <div class="section_cover" ng-controller="SubscriberLoginCtrl">
            <!-- signup area start -->
            <div class="credential_area">
                <div class="credential_header">
                    <a href="" class="active">Sign In</a>
                    <a href="<?php echo base_url('signup');?>">Sign Up</a>
                </div>
                <div class="credential_body">
                    <form ng-submit="getAccessLogin();">
                        <div class="form-group">
                            <p class="text-warning">{{ login_error }}</a>
                        </div>
                        <div class="{{(verified==true ? 'd-none' : '')}}">
                            <div class="form-group">
                                <input type="text" ng-model="mobile" ng-init="mobile='<?php echo (isset($_GET['user']) ? $_GET['user'] : '')?>'" name="username_or_email" placeholder="Mobile Number" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <input type="password" ng-model="password" name="password" placeholder="Password" class="form-control">
                            </div>
    
                            <div class="form-check d-flex">
                                <div>
                                    <input id="remember" type="checkbox" class="form-check-input">
                                    <label class="form-check-label" for="remember">Remember</label>
                                </div>
                                <a href="<?php echo base_url('reset_password');?>">Forgot password</a>
                            </div>
                        </div>
                        
                        <div class="{{(verified==false ? 'd-none' : '')}}">
                            <div class="form-group">
                                <input type="text" ng-model="code" name="code" placeholder="Enter Your Validation Code" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
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
    <!-- credential section end -->