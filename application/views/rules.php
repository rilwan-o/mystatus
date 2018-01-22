
    <div class="content-container" id="content">
        <div class="page page-forms-elements">

            <ol class="breadcrumb breadcrumb-small">
            </ol>

            <div class="page-wrap">
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12 col-md-10">

                        <div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
                            <div class="panel-heading">Set Time and Day : <?php foreach($previous_set_time as $time){echo $time->from."hours To ".$time->to."hours ".$time->days;};?></div>
                            <?php $this->load->helper('form');

                            echo $alert_message ;?>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" method="POST" action="<?php base_url();?>set_rules">
                                    <!-- normal control -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-body">
                                                <table class="table">

                                                    <thead>
                                                    <tr>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr>
                                                        <td><div class="ui-checkbox ui-checkbox-primary">
                                                                <label>
                                                                    <input type="checkbox" name="day[]" value="monday">
                                                                    <span>Monday</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><div class="ui-checkbox ui-checkbox-primary">
                                                                <label>
                                                                    <input type="checkbox" name="day[]" value="tuesday">
                                                                    <span>Tuesday</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><div class="ui-checkbox ui-checkbox-primary">
                                                                <label>
                                                                    <input type="checkbox" name="day[]" value="wednesday" >
                                                                    <span>Wednesday</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><div class="ui-checkbox ui-checkbox-primary">
                                                                <label>
                                                                    <input type="checkbox" name="day[]" value="thursday" >
                                                                    <span>Thursday</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td><div class="ui-checkbox ui-checkbox-primary">
                                                                <label>
                                                                    <input type="checkbox" name="day[]" value="friday">
                                                                    <span>Friday</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><div class="ui-checkbox ui-checkbox-primary">
                                                                <label>
                                                                    <input type="checkbox" name="day[]" value="saturday">
                                                                    <span>Saturday</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><div class="ui-checkbox ui-checkbox-primary">
                                                                <label>
                                                                    <input type="checkbox" name="day[]" value="sunday">
                                                                    <span>Sunday</span>
                                                                </label>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>Time :</td>
                                                        <td>From<div class="form-group">

                                                                <select id="personSelec" style="width: 100%" data-placeholder="From" name="from">
                                                                    <option></option>
                                                                    <?php for($i = 0; $i < 24; $i++): ?>
                                                                        <option value="<?= $i; ?>"><?= $i % 12 ? $i % 12 : 12 ?>:00 <?= $i >= 12 ? 'pm' : 'am' ?></option>
                                                                    <?php endfor ?>
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td>To<div class="form-group">

                                                                <select id="personSelec" style="width: 100%" data-placeholder="To" name="to">
                                                                    <option></option>
                                                                    <?php for($i = 0; $i < 24; $i++): ?>
                                                                        <option value="<?= $i; ?>"><?= $i % 12 ? $i % 12 : 12 ?>:00 <?= $i >= 12 ? 'pm' : 'am' ?></option>
                                                                    <?php endfor ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>

                                        <div  class="clearfix right">
                                            <button type="submit" class="btn btn-success">Set Time</button>
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
