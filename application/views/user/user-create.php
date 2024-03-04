<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
<div class="col-md-12">
	<a href="<?php echo base_url();?>user/create">
		Add New Company
	</a>
	</div>
</div>
<style>
	td { font-size: 12px; }
</style>
<div class="box">
	<div class="box-body table-responsive">
			
	<form method="POST" action="<?php echo base_url();?>user/save">

	  	<div class="form-group row">
	    <label for="name" class="col-sm-2 col-form-label">
	    Company Name:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="name" name="name" placeholder="Company Name">
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="add1" class="col-sm-2 col-form-label">
	    Add1:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="add1" name="add1" placeholder="Address 1">
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="add2" class="col-sm-2 col-form-label">
	    Add2:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="add2" name="add2" placeholder="Address 2">
	    </div>
  	</div>
			
	<div class="form-group row">
	    <label for="city" class="col-sm-2 col-form-label">
	    City:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="city" name="city" placeholder="City">
	    </div>
  	</div>
	
	<div class="form-group row">
	    <label for="state" class="col-sm-2 col-form-label">
	    State:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="state" name="state" placeholder="State">
	    </div>
  	</div>
	
	<div class="form-group row">
	    <label for="pin" class="col-sm-2 col-form-label">
	    Pin:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="pin" name="pin" placeholder="Pin">
	    </div>
  	</div>
		
	<div class="form-group row">
	    <label for="email" class="col-sm-2 col-form-label">
	    Email:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="contact" class="col-sm-2 col-form-label">
	    Contact:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact">
	    </div>
  	</div>
  	
  	<div class="form-group row">
	    <label for="website" class="col-sm-2 col-form-label">
	    Website:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="website" name="website" placeholder="Website">
	    </div>
  	</div>
	
  	<div class="form-group row">
	    <label for="logo" class="col-sm-2 col-form-label">
	    Logo:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="logo" name="logo" placeholder="Logo">
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="edate" class="col-sm-2 col-form-label">
	    Established Year:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="edate" name="edate" placeholder="Date of Established">
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="category" class="col-sm-2 col-form-label">
	    Category:
		</label>
	    <div class="col-sm-10">
	    <select name="category" id="category" class="form-control">
		 	<option value="small">Small</option>
		 	<option value="medium">Medium</option>
		 	<option value="large">Large</option>
		 </select>
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="gstn" class="col-sm-2 col-form-label">
	    GSTN:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="gstn" name="gstn" placeholder="GST Number">
	    </div>
  	</div>
	
	<div class="form-group row">
	    <label for="grate" class="col-sm-2 col-form-label">
	    Google Rating:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="grate" name="grate" placeholder="grate">
	    </div>
  	</div>

  	<div class="form-group row">
	    <label for="status" class="col-sm-2 col-form-label">
	    Status:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="status" name="status" placeholder="status">
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
