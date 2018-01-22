
    <div class="content-container" id="content">
        <div class="page page-forms-elements">

            <ol class="breadcrumb breadcrumb-small">
            </ol>

            <div class="page-wrap">
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12 col-md-10">

                        <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
                            <div class="panel-heading">Current status</div>
                            <div class="panel-body">
                                <?php $this->load->helper('form');
                                echo $alert_message ;?>
                                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url();?>mystatus/black_list_number">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact Number</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="contact_num">

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="clearfix right">
                                            <button class="btn btn-primary mr5" type="submit">Blacklist</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Data Table -->
                        <div class="col-md-10">
                            <div class="panel panel-lined table-responsive panel-hovered mb20 data-table" style="padding-bottom: 20px">
                                <div class="panel-heading">List of blacklisted numbers</div>

                                                    <!-- data table -->
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <th>
                                                                number
                                                            </th> <th>
                                                                date/time
                                                            </th>
                                                        <th></th>
                                                        </thead>
                                                        <tbody><?php foreach($black_number as $row){echo "
                                                        <tr><td>".$row->number."</td><td>$row->created_at</td>
                                                        <form role='form' class='form-horizontal' method='POST' action=".base_url()."mystatus/del_from_blacklist>
                                                        <input type='hidden' name='c_id' value='".$row->id."' >
                                                        <td class='col-lg-1'><button type='submit' class='btn btn-default btn-sm fa fa-trash'></button></td></tr>
                                                       </form>
                                                            ";}?>
                                                        </tbody>
                                                    </table>
                                                    <!-- #end data table -->

                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
