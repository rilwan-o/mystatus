
    <!-- main-container -->
    <div class="main-container clearfix">

        <!-- content-here -->
        <div class="content-container" id="content">
            <div class="page page-auth">

                <div class="auth-container">

                    <div class="form-head mb20">
                        <h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold"><a href="/">MyStatus</a></h1>
                    </div>
                    <?php $this->load->helper('form');
                    echo $alert_message ;?>
                    <div class="form-container">

                        <form class="form-horizontal" method="POST" action="<?php echo base_url();?>mystatus/reset_link">

                            <p class="small text-center mb20">Enter your email address you've registered with you. We'll send you reset link to that address.</p>
                            <div class="md-input-container md-float-label">
                                <input id="email" type="email"  class="md-input" name="email" >
                                <label>Email Id</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block text-uppercase btn-lg">Reset</button>
                    </form>
                </div>

            </div> <!-- #end signin-container -->
        </div>



    </div>
    <!-- #end content-container -->

    </div> <!-- #end main-container -->

