
    <div class="content-container" id="content">
        <div class="page page-forms-elements">

            <ol class="breadcrumb breadcrumb-small">
            </ol>

            <div class="page-wrap">
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12 col-md-10">

                        <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
                            <div class="panel-heading">Invite Friends</div>
                            <?php $this->load->helper('form');
                            echo $alert_message ;
                            ?>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url() ;?>mystatus/send_invitation"><!-- form horizontal acts as a row -->
                                    <!-- normal control -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Friend's Number</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="contact_num">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="clearfix right">
                                            <button class="btn btn-primary mr5" type="submit">Send Invitation</button>
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
