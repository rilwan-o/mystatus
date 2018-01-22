<div class="content-container" id="content">
    <div class="page page-forms-elements">



        <div class="page-wrap">
            <!-- row -->
            <div class="row">
                <div class="col-sm-12 col-md-10">

                    <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
                        <div class="panel-heading">Create MyStatus </div>
                        <?php $this->load->helper('form');
                        echo $alert_message ;?>
                        <div class="panel-body">
                            <form role="form" class="form-horizontal" method="POST" action="<?php base_url();?>set_general_contents"><!-- form horizontal acts as a row -->

                                <!-- normal control -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mobile Number</label>
                                    <div class="col-md-9">
                                        <label class="col-md-3 control-label" name="number"><?php echo $number ;?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status Content</label>
                                    <div class="col-md-9">
                                        <textarea rows="5" name="content" class="form-control resize-v" placeholder="Message here"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="clearfix right">
                                        <button class="btn btn-primary mr5" type="submit">Set Status</button>
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
                        <div class="panel-heading">History</div>
                        <div class="panel-body">
                            <!-- form horizontal acts as a row -->
                                <!-- normal control -->
                                <div class="col-md-12">
                                    <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                        <div class="panel-body">
                                            <table class="table">

                                                <thead>
                                                <tr>
                                                    <th class="col-lg-8">Status Content</th>

                                                    <th class="col-lg-6">Date</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($content as $row){echo "
                                                <tr>
                                                    <td>".$row->content."</td>

                                                    <td >".$row->created_at."</td>
                                                
                                                 <td> <form role='form' class='form-horizontal' method='POST' action=".base_url()."mystatus/edit_delete_general_content>
                                                        <input type='hidden' name='c_id' value='".$row->id."' >
                                                    <button type='submit' name='edit' class='btn btn-default btn-xs' value='edit'>Edit</button></td>
                               
                                                 <td class='col-lg-1'><button type='submit' name='edit' class='btn btn-default btn-sm fa fa-trash' value='del'></button></td>
                                                 </form>
                                                </tr>" ;}?>
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