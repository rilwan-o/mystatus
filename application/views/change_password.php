
    <div class="content-container" id="content">
        <div class="page page-forms-elements">

            <ol class="breadcrumb breadcrumb-small">
            </ol>

            <div class="page-wrap">
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12 col-md-10">

                        <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
                            <div class="panel-heading">Change Password</div>
                            <div class="panel-body">
                                <?php $this->load->helper('form');
                                echo $alert_message;
                                ?>
                                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url() ;?>mystatus/set_password_after_login"> <!-- form horizontal acts as a row -->
                                    <!-- normal control -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Number</label>
                                        <div class="col-md-9">
                                            <label class="col-md-3 control-label">08033599692</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">New Password</label>
                                        <div class="col-md-9">
                                            <input type="password" name="password" class="form-control" placeholder="Password Text">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Confirm Password</label>
                                        <div class="col-md-9">
                                            <input type="password" name="cpassword" class="form-control" placeholder="Password Text">

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="clearfix right">
                                            <button class="btn btn-primary mr5" type="submit">Change Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
