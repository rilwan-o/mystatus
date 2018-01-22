
    <!-- main-container -->
    <div class="main-container clearfix">

        <!-- content-here -->
        <div class="content-container" id="content">
            <div class="page page-auth">

                <div class="auth-container">

                    <div class="form-head mb20">
                        <h1 class="site-logo h2 mb30 mt5 text-center text-uppercase text-bold"><a href="index.html">MyStatus Sign Up</a></h1>
                        <p class="small">Already have an account. <a href="<?php echo base_url() ;?>mystatus/login">Sign In Now</a></p>
                    </div>
                    <?php $this->load->helper('form');
                    echo $alert_message;
                    ?>
                    <div class="form-container">
                        <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>mystatus/signUpValidation">


                                <div class="md-input-container md-float-label">
                                    <input type="text"  class="md-input" name="name" value="<?php echo set_value('name'); ?>"  >

                                    <label>Full Name</label>
                                </div>

                                <div class="md-input-container md-float-label">
                                    <input type="text"  class="md-input" name="number" value="<?php echo set_value('number'); ?>" >

                                    <label>Mobile Number</label>
                                </div>
                                </div>

                                    <div class="md-input-container md-float-label">
                                        <input id="email" type="email"  class="md-input" name="email" value="<?php echo set_value('email'); ?>" >

                                        <label>Email Id</label>
                                    </div>

                                        <div class="md-input-container md-float-label">
                                            <input id="password" type="password"  class="md-input" name="password">

                                            <label>Password</label>
                                        </div>

                                            <div class="md-input-container md-float-label">
                                                <input id="password-confirm" type="password"  class="md-input" name="cpassword">

                                                <label>Retype Password</label>
                                            </div>

                                            <div class="clearfix mt10">
                                                <!--   <div class="ui-checkbox ui-checkbox-primary">
                                                       <label>
                                                           <input type="checkbox">
                                                           <span>I agree to the terms and conditions for use.</span>
                                                       </label>
                                                   </div>-->
                                            </div>
                                            <div class="clearfix">
                                                <button type="submit" class="btn btn-primary right">Sign Up</button>
                                            </div>

                        </form>

                    </div>

                </div> <!-- #end signin-container -->
            </div>



        </div>
        <!-- #end content-container -->

    </div> <!-- #end main-container -->

