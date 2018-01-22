
    <div class="content-container" id="content">
        <div class="page page-forms-elements">

            <ol class="breadcrumb breadcrumb-small">
            </ol>

            <div class="page-wrap">
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12 col-md-10">

                        <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
                            <div class="panel-heading">Update profile</div>
                            <div class="panel-body">
                                <?php $this->load->helper('form');
                                echo $alert_message ;?>
                                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url();?>mystatus/update_user_profile">
                                    <!-- normal control -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Full Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="clearfix right">
                                            <button class="btn btn-primary mr5" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-12 col-md-10">

                        <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
                            <div class="panel-heading">current profile details</div>
                            <div class="panel-body">

                                    <!-- normal control -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-body">
                                                <table class="table">

                                                    <thead>
                                                    <tr>

                                                        <th class="col-lg-6">Name</th>
                                                        <th >Email</th>
                                                        <th class="col-lg-6">Date</th>


                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr><?php echo "
                                                        <td>$name</td>
                                                        <td>$email</td>
                                                        <td >$date</td>
                                                       </tr>";?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


