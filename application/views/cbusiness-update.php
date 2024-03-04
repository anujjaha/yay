<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<style>
	td { font-size: 12px; }
</style>
<div class="box">
	<div class="box-body table-responsive">
			
	<form method="POST" action="<?php echo base_url();?>cbusiness/update_data">

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
			<option <?php echo $selected;?> value="<?php echo $company['id'];?>"><?php echo $company['name'];?> </option>
			<?php	
			}
		?>
			
		</select>
	    </div>
  	</div>

	<div class="form-group row">
	    <label for="name" class="col-sm-2 col-form-label">
	    Business:
		</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="title" name="title" value="<?php echo $result->title;?>">
	    </div>
  	</div>

	<input type="hidden" name="id" id="id" value="<?php echo $result->id;?>">
	<button type="submit" name="submit" class="btn btn-primary mb-2" value="Update">Update</button>

</form>
</body>
</html>