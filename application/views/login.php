
    <!-- main-container -->
    <div class="main-container clearfix">

        <!-- content-here -->
        <div class="content-container" id="content">
            <div class="page page-auth">
                <div class="auth-container">

                    <div class="form-head mb20">
                        <h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold"><a href="index.html">MyStatus</a></h1>
                        <h5 class="text-normal h5 text-center">Sign In </h5>
                    </div>
                    <?php $this->load->helper('form');
                    echo $alert_message ;?>


                    <div class="form-container">
                        <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>mystatus/login_validation">


                                <div class="md-input-container md-float-label">
                                    <input id="number" type="text"  class="md-input" name="number" value="<?php echo set_value('number'); ?>" >



                                    <label>Mobile Number</label>
                                </div>

                                    <div class="md-input-container md-float-label">
                                        <input id="password" type="password"  class="md-input" name="password">


                                        <label>Password</label>
                                    </div>


                                    <div class="clearfix mb15"><a href="<?php echo base_url();?>mystatus/reset_link_email" class="text-success small">Forget your password?</a></div>
                                    <div class="btn-group btn-group-justified mb15">

                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-success">Sign In</button>
                                        </div>
                                    </div>
                                    <div class="clearfix text-center small">
                                        <p>Don't have an account? <a href="<?php echo base_url();?>mystatus/register">Create Now</a></p>
                                    </div>
                        </form>
                    </div>

                </div> <!-- #end signin-container -->
            </div>



        </div>
        <!-- #end content-container -->

    </div> <!-- #end main-container -->








