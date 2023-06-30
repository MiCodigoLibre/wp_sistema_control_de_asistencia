<?php
function wpeas_employee_attendance_welcome() {

	// shows total number of employees starts here

	global $wpdb;
    $table_name = $wpdb->prefix . 'employee_details';
    
    $count_query = "select count(*) from $table_name";
    
    $num = $wpdb->get_var($count_query);
    

    // shows total number of employees ends here

    // check todays attendance taken or not starts here

	get_option('timezone_string');
	$date = date("Y-m-d");
    $ThisDate = date("d-m-Y", strtotime($date));

    $table_name1 = $wpdb->prefix . 'attendance_taken';
    $count_query1 = "select count(*) from $table_name1 where date='$ThisDate'";
    $num1 = $wpdb->get_var($count_query1);

    // check todays attendance taken or not ends here

    // available employees today code starts here
    global $wpdb;
    $table_name2 = $wpdb->prefix . 'attendance_taken';
    $count_query2 = "select count(*) from $table_name2 where date='$ThisDate' and attendance='Present'";
    $num2 = $wpdb->get_var($count_query2);
    // available employees today code ends here

    // not available employees today code starts here
    global $wpdb;
    $table_name3 = $wpdb->prefix . 'attendance_taken';
    $count_query3 = "select count(*) from $table_name3 where date='$ThisDate' and attendance='Absent'";
    $num3 = $wpdb->get_var($count_query3);
    // not available employees today code ends here

    // show current user code starts here

	?>

	<!-- admin grid starts here -->
<div class="dashboard-admin skwp-content-inner">
	<div class="admin-welcome admin-dash-grid-area">
		<div class="admin-welcome-inner admin-dash-grid-item skwp-clearfix">
			<div class="eas-wp-user-img">
							<?php  
							// show current user image code starts here


							global $current_user; wp_get_current_user(); 
							if ( is_user_logged_in() ) { 

							echo get_avatar( esc_html($current_user->ID));
						    } 
							else { 
							wp_loginout(); 
						    } 

						    // show current user iamge code ends here
							?>
				
			</div>
					<div class="eas-wp-admin-info">
						<h2 class="welcome-user">
							<?php  
							// show current user code starts here


							global $current_user; wp_get_current_user(); 
							if ( is_user_logged_in() ) { 
							echo 'Hola, ' . esc_html($current_user->user_login) . "\n";  

						    } 
							else { 
							wp_loginout(); 
						    } 

						    // show current user code ends here
							?>
								
						</h2>
						<h4 class="welcome-txt">Bienvenido de nuevo</h4>
					</div>
		</div>


		<div class="employees-counter admin-dash-grid-item skwp-user-counter-item skwp-clearfix">
			<div class="eas-wp-role-info">
				<h2 class="user-item-count"><?php echo  esc_html($num) ; ?></h2>
				<h4 class="user-count-role">Total Personas</h4>
			</div>
		</div>
        <div class="available-counter admin-dash-grid-item skwp-user-counter-item skwp-clearfix">
			<div class="eas-wp-role-info">
				<h2 class="user-item-count"><?php echo  esc_html($num2) ; ?></h2>
				<h4 class="user-count-role">Disponible hoy</h4>
			</div>
		</div>
		
		<div class="onleave-counter admin-dash-grid-item skwp-user-counter-item skwp-clearfix">
			<div class="eas-wp-role-info">
				<h2 class="user-item-count"><?php echo  esc_html($num3) ; ?></h2>
				<h4 class="user-count-role">Faltas</h4>
			</div>
		</div>
		
</div>
	<!-- admin grid ends here  -->

<div class="dashboard-admin skwp-content-inner">
    <div class="skwp-card-info-wrap skwp-clearfix">
		<div class="skwp-dash-widget-area">
			<div class="skwp-info-card skwp-exam-card">
				<div class="skwp-card-inner">
					<h2 class="card-title">Estadísticas de Asistencia</h2>
						<!-- start of class table -->
					<div class="table-responsive">
						<table id="dataTable1" width="100%" class="table table-striped table-lightfont">
							<thead>
								<tr>
									<th>Nombre del árticulo</th>
										
									<th>Estado</th>
										
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Total Persona</td>
										
									<td><?php echo  esc_html($num) ; ?></td>
										
								</tr>
								<tr>
									<td>Asistencia tomada hoy</td>		
																		
									<td>
									<?php  

									    if($num1 >= 1) {
										    	echo esc_html("Si");
										    }
										    else 
										    {
										    	echo esc_html("No");
										    }
									?>												
									</td>													
								</tr>	
							</tbody>
						</table>
					</div>
							<!-- end of class table -->
				</div>
			</div>
<!-- 
					<div class="skwp-info-card skwp-exam-card">
						<div class="skwp-card-inner">
							<h2 class="card-title">Free Version vs Pro Features</h2>
						
								<div class="table-responsive">
									<table id="ujian-online" width="100%" class="table table-lightborder table-lightfont">
										<thead>
											<tr>
												<th>Features</th>
												<th class="text-center">Free Version</th>
												<th>Pro Version</th>
											</tr>
										</thead>
										<tbody>
									 </tbody>
									</table>
								</div>
					      
						</div>
					</div>
-->					
				</div>
			</div>
		</div>
	</div>	
<?php
}
?>