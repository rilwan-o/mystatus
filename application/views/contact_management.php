
    <div class="content-container" id="content">
        <div class="page page-forms-elements">

            <div class="page-wrap">
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12 col-md-10">

                        <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
                            <div class="panel-heading">Create Status Group</div>
                            <?php $this->load->helper('form');
                            echo $alert_message ;?>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="POST" action="create_status_group">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status Group Name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="group_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Group Status</label>
                                        <div class="col-md-9">
                                            <textarea rows="5" class="form-control resize-v" placeholder="Message here" name="group_content"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="clearfix right">
                                            <button class="btn btn-primary mr5" type="submit">Create Status Group</button>
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
                            <div class="panel-heading">Assign Contact to a Group</div>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url();?>mystatus/assign_contact_to_group">
                                    <!-- normal control -->

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact Name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="contact_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Mobile Number</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="contact_number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status Group</label>
                                        <div class="col-md-9">


                                                <select id="personSelect" style="width: 100%" data-placeholder="Select a Group" name="group_name">
                                                    <option></option>	<!-- empty, for placeholder -->
                                                   <?php foreach($groups as $row){echo "
                                                    <option value='".$row->content_group_name."''>".$row->content_group_name."</option>" ;}
                                                   ?>
                                                </select>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="clearfix right">
                                            <button class="btn btn-primary mr5" type="submit">Set status</button>
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
                            <div class="panel-heading">Manage Contact</div>
                            <div class="panel-body">

                                    <!-- normal control -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-body">
                                                <table class="table">

                                                    <thead>
                                                    <tr>
                                                        <th >Name</th>
                                                        <th >Number</th>
                                                        <th >Group</th>
                                                        <th class="col-lg-6">Date</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                     <?php foreach($contact_details as $row) {echo "
                                                        <tr >
                                                        <td >". $row->contact_name ."</td >
                                                        <td >". $row->contact_number."</td >
                                                        <td >". $row->customized_contents_group."</td >
                                                        <td >".$row->created_at."</td >
                                                        <td > <form role = 'form' class='form-horizontal' method='POST' action = '".base_url()."mystatus/edit_contact' >
                                                                <input type = 'hidden' name = 'c_id' value = '".$row->id."' >
																<input type = 'hidden' name = 'contact_num' value = '".$row->contact_number."' >
                                                                <button type = 'submit' name = 'edit' class='btn btn-default btn-xs' value = 'edit' > Edit</button ></td >

                                                        <td class='col-lg-1' ><button type = 'submit' name = 'edit' class='btn btn-default btn-sm fa fa-trash' value = 'del' ></button ></td >
                                                        </form >
                                                    </tr >
                                                 " ; }?> </tbody>

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
