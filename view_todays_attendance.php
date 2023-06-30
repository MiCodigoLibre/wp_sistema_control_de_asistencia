<?php

function wpeas_view_todays_attendance() {
	get_option('timezone_string');
	$date = date("Y-m-d");
  $Today = date("d-m-Y", strtotime($date));
	?>
	<h1>Asistencia de hoy: <?php echo esc_html($Today); ?></h1>
  <div class="dashboard-admin skwp-content-inner">
      <div class="skwp-card-info-wrap skwp-clearfix"> 
          <div class="attendance-common-div"> 
              <div class="skwp-card-inner"> 
                  <div class="table-responsive">
                      <table width="100%" class="table table-striped table-lightfont">
                          <thead>
                            <tr>
                              <th>EID</th>
                              <th>Nombres</th>
                          		<th>Fecha</th>
                          		<th>Presente/Ausente</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
	<?php
	  global $wpdb;
    $table_name = $wpdb->prefix . 'attendance_taken';
    $employees_all_attn = $wpdb->get_results("SELECT * FROM $table_name WHERE date='$Today' ORDER BY id ASC");
    foreach ($employees_all_attn as $emp_all_att) {
    	# code...
    	?>
                            	<tr>
                                <td><?php echo esc_html($emp_all_att->eid); ?></td>
                                <td><?php echo esc_html($emp_all_att->name); ?></td>
                        		    <td><?php echo esc_html($emp_all_att->date); ?></td>
                        		    <td><?php echo esc_html($emp_all_att->attendance); ?></td>
                                <td><a href="<?php echo esc_html(admin_url('admin.php?page=Attendance_Update&id=' . $emp_all_att->id)); ?>">Editar</a> </td>
                        	    </tr>
    	<?php
    }
    ?>
                          </tbody>
                      </table> 
                    	 <form method="post">
                         <input type="submit" name="delete-todays-attendance" value="Eliminar asistencia de hoy" class="all-button-classes">    
                       </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

    <?php

    // delete todays attendance code starts here Time : 18 October 2020 ,01:30 PM

    if(isset($_POST['delete-todays-attendance'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'attendance_taken';
        $employees_all_attn = $wpdb->get_results("DELETE FROM $table_name WHERE date='$Today'");
        ?>
      <meta http-equiv="refresh" content="1; url=<?=get_site_url()?>/wp-admin/admin.php?page=View_Todays_Attendance" />
        <?php
        exit;
    }

  //  echo get_site_url() .'/wp-admin/admin.php?page=View_Todays_Attendance';
   
    // delete todays attendance code ends here
}

?>