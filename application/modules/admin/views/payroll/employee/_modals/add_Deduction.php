
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= lang('Add_deduction ') ?></h4>
</div>

<div class="modal-body">


    <form id="addSubordinate" action="<?php echo site_url('admin/employee/save_Deduction')?>" method="post" onsubmit="return get_Cookie('csrf_cookie_name')">

        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="token">


        <div class="form-group">
            <label><?= lang('department') ?><span
                    class="required">*</span></label>
            <select class="form-control select2" name="department_id" id="department" onchange="get_employee(this.value)">
                <option value=""><?= lang('please_select') ?></option>
                <?php foreach($department as $item){ ?>
                    <option value="<?php echo $item->id ?>" <?php if(!empty($deduction->department)) echo $deduction->department == $item->id? 'selected':''  ?>>
                        <?php echo $item->department ?>
                    </option>
                <?php } ?>
            </select>
        </div>

    <div class="form-group">
        <label><?= lang('employee') ?><span
                class="required">*</span></label>
        <select class="form-control select2" name="employee_id" id="employee" >
            <option value=""><?= lang('please_select') ?></option>
            <?php foreach($employee as $item){ ?>
                <option value="<?php echo $item->id ?>" <?php if(!empty($deduction->employee_id)) echo$deduction->employee_id == $item->id? 'selected':''  ?>>
                    <?php echo  $item->first_name.' '.$item->last_name ?>
                </option>
            <?php } ?>

        </select>
    </div>

    <div class="form-group">
        <label><?= lang('Deduction_name') ?><span
                class="required">*</span></label>
        <input type="text" class="form-control" name="deduction_name" value="<?php if(!empty($deduction->Deduction_name)) echo $deduction->Deduction_name ?>">
    </div>

    <div class="form-group">
        <label><?= lang('deduction_descr') ?></label>
        <input type="text" class="form-control" name="description" value="<?php if(!empty($deduction->Description)) echo $deduction->Description ?>">
    </div>

    <div class="form-group">
        <label><?= lang('Deduction_amount') ?></label>
        <input type="text" class="form-control" name="deduction_amount" value="<?php if(!empty($deduction->deduction_amount)) echo $deduction->deduction_amount ?>">
    </div>

    <div class="form-group">
        <label><?= lang('month') ?></label>
        <div class="input-group">
            <input type="text" name="month" id="month" class="form-control monthyear" value="<?php
            if (!empty($deduction->Deduction_month)) {
                echo date('Y-n', strtotime($deduction->Deduction_month));
            }
            ?>" >
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
        </div>
    </div>


        <input type="hidden" name="id" value="<?php if(!empty($deduction->id)) echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($deduction->id)) ?>">


        <span class="required">*</span> <?= lang('required_field') ?>

        <div class="modal-footer" >

            <button type="button" id="close" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-olive btn-flat" id="btn" >Save</button>


        </div>
    </form>

</div>



<script>

    $('#modalSmall').on('hidden.bs.modal', function () {
        location.reload();
    });

    $(".monthyear").datepicker( {
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months"

    });

    $(".select2").select2();

    $('.select2').css('width','100%');

    function get_Cookie(name) {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        $('#token').val(cookieValue);
    }

    $("#btn").click(function ()  {

        $("#addSubordinate").validate({
            excluded: ':disabled',
            rules: {

                department_id: {
                    required: true
                },
                subordinate_id: {
                    required: true
                }
            },

            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block animated fadeInDown',
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        })
    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });


</script>

<script>

	$('#month').on('changeDate',function(){
     $(this).datepicker('hide');
	});
       
    </script>
	

