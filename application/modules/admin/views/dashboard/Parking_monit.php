
<script type="text/javascript" src="<?php echo base_url('assets/admin/bootstrap/js/rTabs.js')?>"></script>
 <style>
 .btn_size_opt{width:100px;height:80px;font-size:16px;margin-bottom:10px;margin-right:7px;}
 .btn_size_opt .fa{font-size:18px;}
        </style>
 <script type="text/javascript">
            $(function() {
                $("#tabauto").rTabs({
                    bind : 'click',
                    defaultShow:true,
                    auto: false
                });

                $("#tab").rTabs();

                $("#tab2").rTabs({
                    bind : 'click',
                    animation : 'left'
                });

                $("#tab3").rTabs({
                    bind : 'hover',
                    animation : 'up'
                });

                $("#tab4").rTabs({
                    bind : 'hover',
                    animation : 'fadein'
                });

                $("#gallery").rTabs({
                    bind : 'hover',
                    animation : 'fadein'
                });
            })
        </script>
 <!-- Main content -->
 <section class="content">
      <!-- Info boxes -->
      <div class="row">
          </div>
		  <p class="er"></p>
          <div class="row">
          	<div class="dropdown pull-right">
			 </div>
        </div>
         <div class="row">
		 <div class="col-sm-12">
			<h3 style="border-bottom:1px solid #ccc;margin:0px 0px 30px;padding-bottom:5px;">Parking Details</h3>
		 </div>
			<div class="col-sm-12">
			<?php   
			  if(!empty($Slot)){
				  foreach($Slot as $Slots){
			?>
						<!--	href=".myModal"-->
				<button 

				data-toggle="modal" type="button" class="btn 
				<?php   switch($Slots->Isbooked){
case 1:
echo 'btn-danger';
break;
case 0:
echo 'btn-success';
break;

				}				?>
				
				 btn_size_opt"><i class="fa fa-car"></i><br> <?php echo  $Slots->Slot_No ?><br>
				 <?php   switch($Slots->Isbooked){
case 1:
echo '<p style="font-size:10px;">Booked</p>';
break;
case 0:
echo '<p style="font-size:10px;">Available</p>';
break;

				}				?></button>
				<?php  
				  }
				  }
				  ?>
				

			</div>
			 <div class="modal fade myModal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				  <h4 class="modal-title">Slot Details</h4>
				</div>
				<div class="modal-body">
				 
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				 
				</div>
			  </div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		  </div><!-- /.modal -->
		 </div>
    </section>
<script>
$('.project').click(function(){
	  var c_id	=	$(this).text();
	  if(c_id){
		  $.ajax({
			url: '<?php echo site_url('admin/Dashboard/Unit_load') ?>',
			type:'POST',
			data:{Project_id:c_id},
			success:function(result){
			$('#pages').html(result);
			 }
		  });
	  }  
	});

</script>
