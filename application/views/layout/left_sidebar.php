<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php

								$profile = $this->session->userdata['profile_pic'] ?? '';
								if(empty($profile)) {
									$profile = 'avatar5.png';
								}
                            ?>
                            <img src="<?php echo base_url('assets/users/'.$profile)?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $this->session->userdata['username'] ?? '';?></p>

                            <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
                        </div>
                    </div>
                    <!-- search form -->
                   
                    <form target="_blank" action="#" method="post" class="sidebar-form">
                        <div class="input-group">
                        <?php
                        $q = $this->input->post('q');
                        ?>
                            <input type="text" name="old_q" value="<?php echo $q;?>" class="form-control" placeholder="Temporary Not Working..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo base_url();?>user">
                                <i class="fa fa-dashboard"></i> <span>Company List</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url();?>cbusiness">
                                <i class="fa fa-dashboard"></i> <span>Company Businesses</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url();?>cemployees">
                                <i class="fa fa-dashboard"></i> <span>Company Employees</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url();?>cowners">
                                <i class="fa fa-dashboard"></i> <span>Company Owners</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url();?>clocations">
                                <i class="fa fa-dashboard"></i> <span>Company Branch Info</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url();?>email">
                                <i class="fa fa-dashboard"></i> <span>Email</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
<script>
jQuery("document").ready(function(){
	/*$.ajax({
         type: "POST",
         url: "<?php echo site_url();?>/user/get_leftbar_status/", 
          dataType: 'json',
         success: 
            function(data){
				jQuery("#show_jobs").html(data.jobs);
				jQuery("#show_dealers").html(data.dealers);
				jQuery("#show_customers").html(data.customers);
				jQuery("#show_prospects").html(data.prospects);
				jQuery("#show_vouchers").html(data.vouchers);
				jQuery("#show_tasks").html(data.tasks);
				
				
				/*
				
				function blinker() {
					$('.blink_me').fadeOut(500);
					$('.blink_me').fadeIn(500);
				}
				setInterval(blinker, 1000); //Runs every second
				* /
				
				if(data.tasks > 0 ) {
					function blinker() {
						$(".blink_me").css('color','red');
					$('.blink_me').fadeOut(5000);
					$('.blink_me').fadeIn(5000);
				}
					setInterval(blinker, 3000); 
				}
			}
          });*/
});
</script>
