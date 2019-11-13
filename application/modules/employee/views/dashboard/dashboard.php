
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/empCalander.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="box"><!-- /primary heading -->
            <div id="portlet2" class="panel-collapse collapse in">
                <div class="box-body" style="">
                    <div id="calendar" class="col-centered"></div>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                       <form class="addEvent form-horizontal" id="addEventForm">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label">Color</label>
                                            <div class="col-sm-10">
                                                <select name="color" class="form-control" id="color">
                                                    <option value="">Choose</option>
                                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                                    <option style="color:#008000;" value="#008000">&#9724; Green</option>
                                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                                    <option style="color:#000;" value="#000">&#9724; Black</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="start" class="col-sm-2 control-label">Start date</label>
                                            <div class="col-sm-4">
                                                <input type="text"  name="start" class="form-control" id="start" data-date-format="yyyy-mm-dd">
                                            </div>

                                            <label for="start" class="col-sm-2 control-label">Time</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text"  name="startTime" class="form-control" id="startTime" data-date-format="HH:mm:ss">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="end" class="col-sm-2 control-label">End date</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="end" class="form-control" id="end" data-date-format="yyyy-mm-dd" >
                                            </div>

                                            <label for="start" class="col-sm-2 control-label">Time</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text"  name="endTime" class="form-control" id="endTime" data-date-format="HH:mm:ss">
                                                </div>
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
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label">Color</label>
                                            <div class="col-sm-10">
                                                <select name="color" class="form-control" id="color">
                                                    <option value="">Choose</option>
                                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                                    <option style="color:#008000;" value="#008000">&#9724; Green</option>
                                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                                    <option style="color:#000;" value="#000">&#9724; Black</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="start" class="col-sm-2 control-label">Start date</label>
                                            <div class="col-sm-4">
                                                <input type="text"  name="start" class="form-control" id="eStart" data-date-format="yyyy-mm-dd">
                                            </div>

                                            <label for="start" class="col-sm-2 control-label">Time</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text"  name="startTime" class="form-control" id="eStartTime" data-date-format="HH:mm:ss">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="end" class="col-sm-2 control-label">End date</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="end" class="form-control" id="eEnd" >
                                            </div>

                                            <label for="start" class="col-sm-2 control-label">Time</label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text"  name="endTime" class="form-control" id="eEndTime" data-date-format="HH:mm:ss">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
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


<script src='<?php echo base_url('assets')?>/assets/plugin/daterangepicker/moment.min.js'></script>

<script src='<?php echo base_url('assets')?>//assets/plugin/datepicker/bootstrap-datepicker.js'></script>
<script src='<?php echo base_url('assets')?>//plugin/colorpicker/bootstrap-colorpicker.min.js'></script>
<script src='<?php echo base_url('assets')?>//plugin/timepicker/bootstrap-timepicker.min.js'></script>

<script src='<?php echo base_url('assets')?>//assets/plugin/fullcalendar/fullcalendar.min.js'></script>



<script>
	$('form').attr('autocomplete', 'off');
	</script>


