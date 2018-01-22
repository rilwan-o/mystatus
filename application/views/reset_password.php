
    <!-- main-container -->
    <div class="main-container clearfix">

        <!-- content-here -->
        <div class="content-container" id="content">
            <div class="page page-auth">
                <div class="auth-container">

                    <div class="form-head mb20">
                        <h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold"><a href="index.html">MyStatus</a></h1>
                        <h5 class="text-normal h5 text-center">Reset Password </h5>
                    </div>
                    <?php $this->load->helper('form');
                    echo $alert_message ;?>
                    <div class="form-container">
                        <form class="form-horizontal" method="POST" action="<?php base_url();?>set_password">

                            <!--

                            <div class="md-input-container md-float-label">
                                <input id="email" type="email"  class="md-input" name="email" >

                                    <label>Email</label>
                                </div>
                            </div>
                            -->
                            <div class="md-input-container md-float-label">
                                <input id="password" type="password"  class="md-input" name="password">

                                    <label>New Password</label>

                            </div>

                            <div class="md-input-container md-float-label">
                                <input id="password-confirm" type="password"  class="md-input" name="cpassword">

                                    <label>Confirm Password</label>

                            </div>




                            <div class="btn-group">
                                <button type="submit" class="btn btn-success">Reset Password</button>
                            </div>


                    </form>
                </div>

            </div> <!-- #end signin-container -->
        </div>



    </div>
    <!-- #end content-container -->

    </div> <!-- #end main-container -->


