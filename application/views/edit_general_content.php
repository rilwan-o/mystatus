<div class="content-container" id="content">
    <div class="page page-forms-elements">



        <div class="page-wrap">
            <!-- row -->
            <div class="row">
                <div class="col-sm-12 col-md-10">

                    <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
                        <div class="panel-heading">Edit MyStatus Contents </div>
                        <?php $this->load->helper('form');
                        echo validation_errors();?>
                        <div class="panel-body">
                            <form role="form" class="form-horizontal" method="POST" action="<?php base_url();?>update_general_contents"><!-- form horizontal acts as a row -->

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
                                        <input type= "hidden" name= "c_id" value= "<?php foreach($content as $row){echo $row->id ;}?>" >
                                        <textarea rows="5" name="content" class="form-control resize-v" ><?php foreach($content as $row){echo $row->content ;}?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="clearfix right">
                                        <button class="btn btn-primary mr5" type="submit">Update Status</button>
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