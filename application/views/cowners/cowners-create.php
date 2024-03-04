<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
<div class="col-md-12">
	<a href="<?php echo base_url();?>cowners/create">
		Add Employess
	</a>
	</div>
</div>
<style>
	td { font-size: 12px; }
</style>
<div class="box">
	<div class="box-body table-responsive">
			
	<form method="POST" action="<?php echo base_url();?>cowners/save">

	 <div class="form-group row">
	    <label for="name" class="col-sm-2 col-form-label">
	    Company:
		</label>
	    <div class="col-sm-10">
			<select name="company_id" id="company_id"  class="form-control" >
			<?php
			foreach ($companies as $company) 
			{
				$selected = '';
				if($result->company_id == $company['id'])
				{
					$selected = 'selected="selected"';
				}
			?>
				<option <?php echo $selected;?> value="<?php echo $company['id'];?>"><?php echo $company['name'];?></option>
			<?php	
			}
			?>
			
		</select>
	    </div>
  	</div>

	<div class="form-group row">
	    <label for="oname" class="col-sm-2 col-form-label">
	    Owner Name:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="oname" name="oname" placeholder="Owner Name">
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="oemail" class="col-sm-2 col-form-label">
	    Owner Email:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="oemail" name="oemail" placeholder="Owner Email">
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="omobile" class="col-sm-2 col-form-label">
	    Owner Mobile:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="omobile" name="omobile" placeholder="Owner Mobile">
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="omobile2	" class="col-sm-2 col-form-label">
	    Mobile 2:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="omobile2" name="omobile2" placeholder=" Owner Mobile2">
	    </div>
  	</div>
  	<div class="form-group row">
	    <label for="gender	" class="col-sm-2 col-form-label">
	    Gender:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="gender" name="gender" placeholder=" Gender">
	    </div>
  	</div>
  	<div class="form-group row">
	    <label for="omobile2	" class="col-sm-2 col-form-label">
	    Date of Birth:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="dob" name="dob" placeholder="Date of Birth">
	    </div>
  	</div>
  	<div class="form-group row">
	    <label for="oadd1" class="col-sm-2 col-form-label">
	    Address1:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="oadd1" name="oadd1" placeholder="Address1">
	    </div>
  	</div>
  	<div class="form-group row">
	    <label for="oadd2" class="col-sm-2 col-form-label">
	    Address2:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="oadd2" name="oadd2" placeholder="Address2">
	    </div>
  	</div>
  	<div class="form-group row">
	    <label for="ocity" class="col-sm-2 col-form-label">
	    City:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="ocity" name="ocity" placeholder="City">
	    </div>
  	</div>
  	<div class="form-group row">
	    <label for="ostate" class="col-sm-2 col-form-label">
	    State:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="ostate" name="ostate" placeholder="State">
	    </div>
  	</div>
  	<div class="form-group row">
	    <label for="opin" class="col-sm-2 col-form-label">
	    Pin:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="opin" name="opin" placeholder="Pin">
	    </div>
  	</div>

	<button type="submit" name="submit" class="btn btn-primary mb-2" value="Save">Save</button>
	
</form>




	</div><!-- /.box-body -->
	</div><!-- /.box -->
	</div>

<script src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>

<script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "iDisplayLength": 50,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true,
                    "bDestroy": true,
                });
            });
    
    $(document).ready(function() {
      $('.fancybox').fancybox({
        'width':900,
        'height':600,
        'autoSize' : false,
    });
});
            
function update_status(id,value) {
	var oTable = $('#example1').dataTable();
	 $.ajax({
         type: "POST",
         url: "<?php echo site_url();?>/dealer/update_dealer_status/"+id+"/"+value, 
         success: 
              function(data){
				  location.reload();
			 }
          });
}
function show_job_status(job_id){
    $.ajax({
         type: "POST",
         url: "<?php echo site_url();?>/ajax/ajax_jobstatus_history/"+job_id, 
         success: 
            function(data){
                  jQuery("#job_status").html(data);
            }
          });
}

function show_job_details(job_id){
    $.ajax({
         type: "POST",
         url: "<?php echo site_url();?>/ajax/ajax_job_details/"+job_id, 
         success: 
            function(data){
                  jQuery("#job_view").html(data);
            }
          });
}
function update_job_status(id, defaultstatus) {
	
	var setDefault = false;
	
	if(defaultstatus)
	{
		setDefault = true;
	}
	var value = $( "input:radio[name=jstatus]:checked" ).val();
	var send_sms = $( "input:radio[name=send_sms]:checked" ).val();
	var is_delivered = $( "input:radio[name=is_delivered]:checked" ).val();
	var bill_number = $( "#bill_number").val();
	var voucher_number = $( "#voucher_number").val();
	var receipt = $( "#receipt").val();
	
	jQuery("#saveJobStatusBtn").attr('disabled', true);
	
	if(jQuery("#jobStatusTbl") && setDefault == false)
	{
		alert('Job Status Updated');
		jQuery("#jobStatusTbl").hide();
	}
	
	$.ajax({
         type: "POST",
         url: "<?php echo site_url();?>/prints/update_job_status/"+id, 
         data:{"j_id":id, "is_delivered": is_delivered,"j_status":value,"send_sms" : send_sms,"receipt":receipt,"bill_number":bill_number,"voucher_number":voucher_number},
         success: 
              function(data){
				  console.log(data);
				  if(setDefault)
				  {
					$.fancybox.close();
                    location.reload();
				  }
							
			 }
          });
}

function save_shipping(jid) {
	var c_name,d_number;
	c_name = $("#courier_name").val();
	d_number = $("#docket_number").val();
	if(c_name.length > 0 ) 
	{
		
	jQuery("#saveShippingBtn").hide();
	$.ajax({
         type: "POST",
         url: "<?php echo site_url();?>/ajax/save_courier/"+jid, 
         data:{"courier_name":c_name,"docket_number":d_number},
         success: 
              function(data)
              {
				$.fancybox.close();
                location.reload();
			 }
          });
	}
	else
	{
		$("#courier_name").focus();
		alert("Courier Name is missig !");
	}
}

jQuery(document).on('click', ".fancybox-close", function()
{
	location.reload();
});

$(document).keyup(function(e) 
{
     if (e.keyCode == 27)
     {
		 location.reload();
    }
});


function setDelievered(jobId)
{
	jQuery.ajax(
	{
		url: "<?php echo site_url();?>/ajax/delieveredJobSuccess",
		method: 'POST',
		dataType: 'JSON',
		data: {
			jobId: jobId
		},
		success: function(data)
		{
			if(data.status == true)
			{
				jQuery("#jobd-"+jobId).html("( Delivered )");
			}
		},
		error: function(data)
		{
			alert("Something Went Wrong !");
		}
	});
}
</script>
<div id="view_job_status" style="width:900px;display: none;margin-top:-75px;">
<div style="width: 900px; margin: 0 auto; padding: 120px 0 40px;">
    <div id="job_status"></div>
</div>
</div>

<div id="view_job_details" style="width:900px;display: none;margin-top:-75px;">
<div style="width: 900px; margin: 0 auto; padding: 120px 0 40px;">
    <div id="job_view"></div>
</div>
</div>
