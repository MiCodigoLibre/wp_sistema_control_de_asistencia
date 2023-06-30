<?php
function wpeas_attendance_panel() {
  global $wpdb;
  //
  
	get_option('timezone_string');
	$date = date("Y-m-d");
	$ThisDate = date("d-m-Y", strtotime($date));

  $table_name3 = $wpdb->prefix . 'attendance_taken';
  $dates = $wpdb->get_results("SELECT DISTINCT date 
    FROM $table_name3 ORDER BY id DESC");
  // echo json_encode($dates);
  foreach ($dates as $k => $date) {
    if($ThisDate == $date->date){
      echo '<h3><span style="color:#B03F3F;">La asistencia de Hoy ya se encuentra registrado</span> <a href="'.get_site_url().'/wp-admin/admin.php?page=View_Todays_Attendance">Ir a asistencias de Hoy</a></h3>';
      exit;
    }
    // echo $ThisDate ."==". $dates[$k]['date']."<br>";
  }
	
  ?>

  <h1>Hoy es: <?php echo $ThisDate; ?></h1>
  <span style="color:red;">*Recuerde que solo se permite el envio de la asistencia una vez al dia, asegurese de marcar todos los registros antes de enviar.</span><br><br>

  <?php


  // <!-- Checking if attendance is taken for today -->
  $table_name2 = $wpdb->prefix . 'employee_details';
  $count_query = "select count(*) from $table_name2";
  $num = $wpdb->get_var($count_query);
  // echo $num;
  





	// insert attendance starts here 

	if(isset($_POST['submit-attendance'])) {

		global $wpdb;
		$table_name = $wpdb->prefix . 'attendance_taken';

		for($i=0;$i<$num;$i++) { // for loop starts 

		    $att_id=sanitize_text_field($_POST['eid'][$i]);
        $att_emp_name=sanitize_text_field($_POST['name'][$i]);
        $att_date=sanitize_text_field($_POST['date'][$i]);
        $att_value=sanitize_text_field($_POST['attendance'][$i]);
        

        $wpdb->insert(
            $table_name,
            array(
                'eid' => $att_id,
                'name' => $att_emp_name,
                'date' => $att_date,
                'attendance'=>$att_value
            )
        );
        echo "attendance inserted";

    } // for loop close
        
        ?>
      <meta http-equiv="refresh" content="1; url=<?=get_site_url()?>/wp-admin/admin.php?page=View_Todays_Attendance" />
        <?php
        exit;

	}

	// insert attendance starts here 


	?>
	<table width="100%" class="table table-striped table-lightfont">
    <thead>
      <tr>
        <th>Persona ID</th>
        <th>Nombres</th>
        <th class="present_color">Presente</th>
        <th>Ausente</th>
      </tr>
    </thead>
    <tbody>
	
	<form action="" method="post">
	<?php

  global $wpdb;
	$table_name = $wpdb->prefix . 'employee_details'; 
	$att_taken = $wpdb->get_results("SELECT * FROM $table_name");
	foreach ($att_taken as $suhas) {

		?>

	
   <input type="hidden" value="<?php echo esc_html($suhas->id);?>" name="eid[]" />
   <input type="hidden" value="<?php echo esc_html($suhas->name);?>" name="name[]" />
      <tr>
        <td><?php echo esc_html($suhas->id); ?></td>
        <td><?php echo esc_html($suhas->name); ?></td>
        <td><label><input type="checkbox" name="attendance[]" value="Present">Presente</label></td>
        <td><label><input type="checkbox" name="attendance[]" value="Absent">Ausente</label></td>
      </tr>

		<?php
             get_option('timezone_string');
	           $date = date("Y-m-d");
             $ThisDate = date("d-m-Y", strtotime($date));

               ?>

               <input type="hidden" value="<?php echo esc_html($ThisDate);?>" name="date[]" />

               <?php
	}
	?>

	 </tbody>
    </table>
    </br>
   
    <button type="submit" name="submit-attendance" value="submit" class="all-button-classes">Enviar asistencia de hoy</button>
  
 </form> 

	<?php




    
}

?>