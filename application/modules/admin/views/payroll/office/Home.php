<script src="<?php echo site_url('assets/js/Shiftplanner.js') ?>"></script>
<div class="row">
    <div class="col-md-12">
        <!-- Calender Start from Here -->

        <div class="box"><!-- /primary heading -->

            <div id="portlet2" class="panel-collapse collapse in">
                <div class="box-body" style="">
                    <div id="calendar" class="col-centered"></div>
                    <!-- Modal -->
                    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                       <form class="addEvent form-horizontal" id="addEventForm">
                        <input type="hidden" name="employee_id" value="<?php echo $employee_id;  ?>" id="employee_id">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?= lang('Add_shift') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label"><?= lang('Shift_name') ?></label>
                                            <div class="col-sm-10">
                                                 <select name="shift[]" class="form-control select2" id="shift"   multiple style="width: 100%;">
                                                   <?php   if(isset($shifts)){ foreach($shifts as $shift){  ?>
												   <option value="<?php   echo $shift->id;  ?>"><?php  echo $shift->shift_name;  ?></option>
												   <?php   }  } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="start" class="col-sm-2 control-label">Start date</label>
                                            <div class="col-sm-4">
                                                <input type="text"  name="start" class="form-control" id="start" data-date-format="yyyy-mm-dd" readonly>
                                            </div>
                                        </div>

                                       

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="addEvent" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form class="editEvent form-horizontal">
								 <input type="hidden" name="employee_id" value="<?php echo $employee_id;  ?>" id="employee_id">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                                    </div>
                                    <div class="modal-body">

                                      
                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label">Color</label>
                                            <div class="col-sm-10">
                                                 <select name="shift[]" class="form-control select2" id="shift"   multiple style="width: 100%;">
                                                   <?php   if(isset($shifts)){ foreach($shifts as $shift){  ?>
												   <option value="<?php   echo $shift->id;  ?>"><?php  echo $shift->shift_name;  ?></option>
												   <?php   }  } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="start" class="col-sm-2 control-label">Start date</label>
                                            <div class="col-sm-4">
                                                <input type="text"  name="start" class="form-control" id="eStart" data-date-format="yyyy-mm-dd">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label class="text-danger"><input type="checkbox"  name="delete"><?= lang('Delete_shift') ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id" class="form-control" id="id">


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="editEvent" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <!-- Calender End from Here -->










    </div>
   
</div>

<script>
	$('form').attr('autocomplete', 'off');
	</script>


