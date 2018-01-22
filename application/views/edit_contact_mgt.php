<div class="content-container" id="content">
    <div class="page page-forms-elements">

        <div class="page-wrap">
<div class="row">
    <div class="col-sm-12 col-md-10">

        <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
            <div class="panel-heading">Re-Assign Contact to a Group</div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url();?>mystatus/update_contact">
                    <!-- normal control -->
                    <?php $this->load->helper('form');
                    echo $alert_message ;?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contact Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="contact_name" value= "<?php foreach($contact_details as $row){echo $row->contact_name ;}?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mobile Number</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="contact_number" value= "<?php foreach($contact_details as $row){echo $row->contact_number ;}?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Status Group</label>
                        <div class="col-md-9">


                            <select id="personSelect" style="width: 100%" data-placeholder="Select a Group" name="group_name">
                                <?php foreach($contact_details as $row){echo "<option value='".$row->customized_contents_group."'>".$row->customized_contents_group."</option>";}?>	<!-- empty, for placeholder -->
                                <?php foreach($groups as $row){echo "
                                                    <option value='".$row->content_group_name."'>".$row->content_group_name."</option>" ;}
                                ?>
                            </select>


                        </div>
                    </div>
                    <div class="form-group">
                        <div class="clearfix right">
                            <input type= "hidden" name= "c_id" value= "<?php foreach($contact_details as $row){echo $row->id ;}?>" >
                            <button class="btn btn-primary mr5" type="submit">Update contact status</button>
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