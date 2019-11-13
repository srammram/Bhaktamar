<style type="text/css">
    /*=============*/
    /*table*/
	.title_fr_c h3{text-align: center;}
    .form_che_k {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .form_che_k td,.form_che_k
    th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }
    .form_che_k input[type="text"] {
        width: 100%;
        border: honeydew;
        outline: none;
        background-color: transparent;
    }

    .area {
        overflow: auto;
        resize: vertical;
        width: 100%;
        min-height: 56px;
        border: 0px;
        outline: none;
        border-right: 1px solid #0000001a;
        border-bottom: 1px solid #0000001a;
    }

.form_che_k tr td
    input[type=checkbox], .form_che_k tr td
    input[type=radio] {
        zoom: 1.5;
    }

    </style>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


<div class="row">
    <div class="col-sm-12">

        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('edit_roles') ?></h3>
                        </div>
                        <div class="panel-body">

                            <?php echo form_open('admin/panel/update_roles', array('class' => 'form-horizontal')) ?>



                            <div class="panel_controls">
                                <div class="form-group margin">
                                    <label class="col-sm-3 control-label"><?= lang('name') ?> </label>

                                    <div class="col-sm-7">
                                        <input type="text" name="name"  value="<?php if(!empty($admin_groups)) echo $admin_groups->name ?>" class="form-control"  >
                                    </div>
                                </div>

                                <div class="form-group margin">
                                    <label class="col-sm-3 control-label"><?= lang('description') ?> </label>

                                    <div class="col-sm-7">
										<input type="text" name="description" value="<?php if(!empty($admin_groups)) echo $admin_groups->description ?>" class="form-control"  >
                                    </div>
                                </div>
							
                                <input type="hidden" name="id" value="<?php if(!empty($admin_groups)) echo $admin_groups->id  ?>">

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('save') ?></button>
                                    </div>
                                </div> 
                            </div>
                            <?php echo form_close() ?>







                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

   
<script>
	$('form').attr('autocomplete', 'off');
	</script>