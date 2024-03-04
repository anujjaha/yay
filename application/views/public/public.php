<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
	<div class="col-md-8">
	</div>
</div>

<style>
	td { font-size: 12px; }
</style>
<div class="box">
	<div class="box-body table-responsive">
	

<style type="text/css">
	.isDealerRates {
		color: green;
	}
	.error {
		color: red;
	}

	.mr-20 {
		margin-right: 20px;
	}
.ui-autocomplete {
	position: absolute;
	z-index: 10000000;
	font-size: 18px;
	font-weight: bolder;
	height: 200px;
	overflow-y: scroll;
	overflow-x: hidden;
	background-color: #e4e2e2;
}
.ui-menu .ui-menu-item a{
    height: 12px;
    font-size: 14px;
    color: black;
}

.mt-20 {
	margin-top: 20px;
}

.w75 {
	width: 75% !important;
}

.d-none {
	display: none;
}

.hide {
	display: none !important;
}
.green {
	color: green;
	font-weight: bolder;
}
</style>
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//require_once('cn.php');


// $isDealerRequest = $_GET['dealer'] ?? '';
// $sql = "SELECT * FROM items";
// $result = $mysqli->query($sql);

// $options = [];
// if ($result->num_rows > 0) {
//   // output data of each row
//   while ($row = $result->fetch_assoc()) 
//   {
//   	$options[$row['id']] = $row['title'];

//   }
// }
// $mysqli->close();
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<aside class="container-fluid bg-3">
<section class="content">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<div class="container-fluid bg-3 text-center">
	<form action="#" method="POST" id="multi-estimate-form">
	<div class="box-body table-responsive">
		<table id="estimateTable" class="example1 table table-bordered table-hover">
			<thead>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><p style="font-size: 18px; font-weight: bold;" id="totalSubAll"></p></td>
					<td><p style="font-size: 18px; font-weight: bold;" id="totalGstAll"></p></td>
					<td><p style="font-size: 18px; font-weight: bold;" id="totalWithGstAll"></p></td>
				</tr>
				<tr>
					<td>Action</td>
					<td>Product</td>
					<td>Print Side</td>
					<td>QTY</td>
					<td>GST (%)</td>
					<td>Refresh</td>
					<td>Per Product</td>
					<td>Sub Total <br/> (Without GST)</td>
					<td>GST Amount</td>
					<td>With GST Total</td>
				</tr>
			</thead>
			<tbody id="tbodyEle">
				<tr>
					<td>
						<a href="javascript:void(0);" onclick="cloneEstimate()" class="btn btn-primary">+</a>
						<input type="hidden" class="perItemCostVal" name="perItemCostInput[1]">
						<input type="hidden" class="totalGSTVal" name="totalGSTInput[1]">
						<input type="hidden" class="perItemTotalCostVal" name="perItemTotalCostInput[1]">
						<input type="hidden" class="totalCostWithGstVal" name="totalCostWithGstInput[1]">
						<a class="removeItemCls hide" href="javascript:void(0);" onclick="removeItem(this)">
							<i class="btn btn-danger red fa fa-2x fa-times"></i>
						</a>
					</td>
					<td>
						<div class="form-inline">
							<select style="width: 300px;" name="item[1]" class="itemValClass category form-control">
								<?php
								foreach($options as $option)
								{
								?>
									<option value="<?=$option['id'];?>"><?=$option['title'];?></option>
								<?php
								}
								?>
							</select>
							<input class="itemCategoryValue" type="hidden" name="categoryValue[1]"  id="categoryValue">
							<p class="isDealerRates"></p>
						</div>
					</td>
					<td>
						<select style="width: 70px;" name="printSide[1]" class="form-control print-side">
							<option>SS</option>
							<option>FB</option>
						</select>

						<select style="display: none;" name="customerCategory[1]" class="form-control customerTypeTitle">
								<option value="customer">Retailer</option>
								<option value="dealer">Dealer</option>
							</select>
					</td>
					<td>
						<input type="text" name="qty[1]" class="form-control print-qty" style="width: 70px;" />
					</td>
					<td>
									<select style="width:80px;" name="gst[1]" class="form-control gst gstClass" onchange="calcEstimate(this)">
										<option value="0">N/A</option>
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="12">12</option>
										<option value="18">18</option>
									</select>
								
							</div>
						</div>
					</td>
					<td>
						<a href="javascript:void(0);" class="btn btn-secondary btn-sm" onclick="calcEstimate(this)">
							<i class="fa fa-refresh" aria-hidden="true"></i>
						</a>
					</td>
					<td class="perItemCost"></td>
					<td class="perItemTotalCost"></td>
					<td class="totalGST"></td>
					<td class="totalCostWithGst"></td>
				</tr>
			</tbody>
		</table>
	</div>

	<input type="hidden" name="estimateDealerName" id="estimateDealerName">
	<input type="hidden" name="estimateDealerMobile" id="estimateDealerMobile">
	<input type="hidden" name="estimateDealerId" id="estimateDealerId">
	<input type="hidden" name="publicEmailId" id="publicEmailId">

	</form>
</div>
<input type="hidden" name="dealerCode" id="dealerCode">
<input type="hidden" name="incrementalEle" id="incrementalEle" value="1">
<input type="hidden" name="itemTitle[1]" id="itemTitle" value="">
<script type="text/javascript">
	$(document).ready(function() {
		var incremental = 1;
		<?php 
		if(isset($isDealerRequest) && $isDealerRequest ==1)
		{
		?>
			$("#dealerLogin").modal('show');
		<?php
		}
		?>
	});

	function calcEstimate(element) 
	{
		let trEle 		= $(element).closest('tr');
		let categoryId 	= $(trEle).find('.category').val();
		let categoryTitle = $(trEle).find('.category option:selected').text();
		let customerType 	= $(trEle).find('.customerTypeTitle').val();
		let pside 	= $(trEle).find('.print-side').val();
		let qty 		= $(trEle).find('.print-qty').val();
		let gst 		= $(trEle).find('.gst').val();
		let total 		= 0;
		let callUrl 	= "<?php echo site_url();?>/welcome/confirmQty";
		let fburl 		= "<?php echo site_url();?>/welcome/confirmQtyFB";
		let dealerId    = $("#dealerCode").val();

		if(qty.toString().trim().length < 1)
		{
			swal('Oh!' , 'Please add correct QTY', 'error');
			return;
		}

		$(trEle).find('.itemCategoryValue').val(categoryTitle);

 		
		if(pside.toLowerCase() == 'fb')
		{
			callUrl = fburl;			
		}

		$.ajax({
	        type: "POST",
	        dataType: 'JSON',
	        url: callUrl, 
	        data: {
	            isDealer: customerType,
	            categoryId,
	            pside,
	            qty,
	            dealerId
	        },
	        beforeSend: function(){
		        swal('Please Hold On..' , 'Estimating....');
		    },
	        success: function(data)
	        {
	            if(data.cost.toString() == "0")
	            {
	            	setTimeout(function() {
	            		swal('Oh!', 'Please add correct details for estimation');  	
	            	}, 1000);
	            	return;
	            }
	            if(data.status)
	            {
	            	// show download button
	            	$("#downloadBtn").show();
	            	$("#mailBtn").show();

	            	total = data.perItem * qty;
	            	$(trEle).find('.perItemTotalCost').html(total + '<br><span class="green">[' + qty + '  * ' + data.perItem +']<span>');
	            	$(trEle).find('.perItemTotalCostVal').val(total);
	            	if(gst)
	            	{
	            		let gstCost = ((total * gst ) / 100);
	            		total = total + gstCost;
	            		$(trEle).find('.totalGST').html(gstCost);
	            		$(trEle).find('.totalGSTVal').val(gstCost);
	            	}
	                $(trEle).find('.perItemCost').html(data.perItem);
	                $(trEle).find('.perItemCostVal').val(data.perItem);

	                $(trEle).find('.totalCostWithGst').html(total);
	                $(trEle).find('.totalCostWithGstVal').val(total);
	                // $(trEle).find('.customerTypeTitle').html(jQuery("#customerType").val().toUpperCase());
	                totalAll();

	                $("#dealerContainer").hide();
	                if(data.isDealer && data.isDealer.toString() == "1")
	                {
	                	$(trEle).find('.isDealerRates').html('Special Dealer Rates');
	                	$("#estimateDealerMobile").val(data.dealerRec.mobile);
	                	$("#estimateDealerId").val(data.dealerRec.id);
	                	var dealerHtml = '';
	                	if(data.dealerRec.companyname)
	                	{
	                		dealerHtml = '<p><strong>Company: ' + data.dealerRec.companyname + '</strong></p>';
	                		$("#estimateDealerName").val(data.dealerRec.companyname);
	                	}
	                	else if(data.dealerRec.name)
	                	{
	                		dealerHtml = '<p><strong>Name:' + data.dealerRec.name + '</strong></p>';
	                		
	                		$("#estimateDealerName").val(data.dealerRec.name);
	                	}

	                	$("#dealerContainer").html(dealerHtml);
	                	$("#dealerContainer").show();
	                }

	            }
	        },
	        complete: function(){
			    swal.close();
			},
	    });
	}


	function cloneEstimate()
	{
		var incremental = parseInt(parseInt($("#incrementalEle").val()) + 1);
		$("#incrementalEle").val(incremental);

		$(".category").select2('destroy');
		var ele = $($("#estimateTable").find('tr')[2]).clone();

		$(ele).find('.perItemCostVal').attr('name', 'perItemCostInput['+incremental+']');
		$(ele).find('.totalGSTVal').attr('name',  'totalGSTInput['+incremental+']');
		$(ele).find('.perItemTotalCostVal').attr('name', 'perItemTotalCostInput['+incremental+']');
		$(ele).find('.totalCostWithGstVal').attr('name',  'totalCostWithGstInput['+incremental+']');
		$(ele).find('.itemValClass').attr('name', 'item['+incremental+']');
		$(ele).find('.print-side').attr('name',  'printSide['+incremental+']');
		$(ele).find('.customerTypeTitle').attr('name',  'customerCategory['+incremental+']');
		$(ele).find('.print-qty').attr('name',  'qty['+incremental+']');
		$(ele).find('.gstClass').attr('name',  'gst['+incremental+']');
		$(ele).find('.itemCategoryValue').attr('name',  'categoryValue['+incremental+']');


		$(ele).find('.removeItemCls').removeClass('hide');
		$(ele).find('.removeItemCls').show();
		$(ele).find('.btn-primary').hide();
		
		$(ele).find('.perItemCost').html('');
		$(ele).find('.perItemTotalCost').html('');
		$(ele).find('.totalGST').html('');
		$(ele).find('.totalCostWithGst').html('');
		$(ele).find('.isDealerRates').html('');

		$("#tbodyEle").append(ele)

		$('#tbodyEle tr:last').find('input:text').val('');
		$(".category").select2();
	}

	function removeItem(element)
	{
		let trEle = $(element).closest('tr');
		trEle.remove();
		totalAll();
	}

	function totalAll()
	{
		$($("#estimateTable").find('tr')[2]).find('.removeItemCls').hide();

		let subTotal = 0;
		let gstTotal = 0;
		let allTotal = 0;

		$(".perItemTotalCost").each(function(i,j) {
			subTotal = subTotal + parseFloat($(j).html());
		});

		$(".totalGST").each(function(i,j) {
			gstTotal = gstTotal + parseFloat($(j).html());
		});

		$(".totalCostWithGst").each(function(i,j) {
			allTotal = allTotal + parseFloat($(j).html());
		});

		$("#totalSubAll").html(subTotal);
		$("#totalGstAll").html(gstTotal);
		$("#totalWithGstAll").html(allTotal);
	}

	$(".category").select2();

	function validateDealerLogin()
	{
		var mobile = $("#mobile_number").val();

		$("#mobileErrorContainer").hide();

		if(mobile.trim().length < 5)
		{
			$("#mobileErrorContainer").show();
			return;
		}

		$("#dealerCode").val(mobile);
		$("#dealerLogin").modal('hide');
		$("#dealerLoginBtn").hide();
	}

	function validatePublicEmail()
	{
		var publicEmail = $("#public_email_id").val();

		$("#emailErrorContainer").hide();

		if(publicEmail.trim().length < 5)
		{
			$("#emailErrorContainer").show();
			return;
		}

		$("#publicEmailId").val(publicEmail);
		$("#publicEmailModalBox").modal('hide');
		$("#dealerLoginBtn").hide();
	}

	/**
	 * Generate PDF
	 */
	function generatePDF() 
	{
		var input = $('form').serialize();
    	$.ajax({
	        type: "POST",
	        dataType: 'JSON',
	        url: "<?php echo site_url();?>/welcome/generatePDF", 
	        data: input,
	        beforeSend: function(){
		        swal('Please Hold On..' , 'Generating PDF....');
		    },
	        success: function(data)
	        {
	            if(data.file)
	            {
	            	window.open("<?php echo site_url();?>assets/pdf/"+data.file);
	            }
	        },
	        complete: function(){
			    swal.close();
			},
	    });    
        
    }

    /**
	 * Mail PDF
	 */
	function mailPDF() 
	{
		var dealerId = $("#estimateDealerId").val().trim();

		if(dealerId.length == 0 )
		{
			if($("#publicEmailId").val().length == 0 )
			{
				$("#publicEmailModalBox").modal('show');
				return;
			}
		}

		var input = $('form').serialize();
    	$.ajax({
	        type: "POST",
	        dataType: 'JSON',
	        url: "<?php echo site_url();?>/welcome/sendEmail",
	        data: input,
	        beforeSend: function(){
		        swal('Please Hold On..' , 'Sending Email....');
		    },
	        success: function(data)
	        {
	            console.log(data);
	        },
	        complete: function(){
			    swal.close();
			},
	    });    
        
    }
</script>				


<!-- Modal -->
<div class="modal fade" id="dealerLogin" tabindex="-1" role="dialog" aria-labelledby="dealerLogin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dealer Rates</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="mobile_number" class="col-form-label">Mobile Number or Email Address:</label>
            <input type="text" class="form-control" id="mobile_number">
            <p style="display:none;" id="mobileErrorContainer" class="error">Please enter valid input</p>
            <p>Please enter registered mobile number or email address to get special dealer rates</p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="validateDealerLogin();" class="btn btn-primary">Validate</button>
      </div>
    </div>
  </div>
</div>

<!-- PUBLIC EMAIL MODAL-->
<div class="modal fade" id="publicEmailModalBox" tabindex="-1" role="dialog" aria-labelledby="publicEmailModalBox" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Need Email Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="public_email_id" class="col-form-label">Email Address:</label>
            <input type="text" class="form-control" id="public_email_id">
            <p style="display:none;" id="emailErrorContainer" class="error">Please enter valid input</p>
            <p>Please enter valid email address</p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="validatePublicEmail();" class="btn btn-primary">Validate</button>
      </div>
    </div>
  </div>
</div>



	</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>