<?php

function wpeas_view_all_attendance() {
	?>
     
<div class="dashboard-admin skwp-content-inner">
    <div class="skwp-card-info-wrap skwp-clearfix"> 
        <div class="attendance-common-div"> 
            <div class="skwp-card-inner"> 
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-lightfont">
                        <!-- date : 27 October Time : 4 PM Code starts here -->
                        <tr>
                            <td>
                                <form method="post">
                                <select name="select-date" style="margin-top:15px ;">
                                <option value="Select Date">Seleccione Fecha</option>
                                <?php
                                global $wpdb;
                                $table_name2 = $wpdb->prefix . 'attendance_taken';
                                $date = $wpdb->get_results("SELECT DISTINCT date FROM $table_name2 ORDER BY id DESC");
                                foreach ($date as $dates) {
                                    ?>
                                    <option value="<?php echo esc_html($dates->date); ?>"><?php echo esc_html($dates->date); ?></option>
                                    
                                    <?php
                                }
                                ?>
                                <td><input type="submit" name="fetch-attendance" value="Mostrar Asistencias" class="all-button-classes"></td>
                                </form>
                            </td>
                        </tr>
                        <!-- date : 27 October Time : 4 PM Code ends here -->
                    </table>
                </div>

                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-lightfont">

                        <thead>
                          <tr>
                            <th>EID</th>
                            <th>Nombres</th>
                    		<th>Fecha</th>
                    		<th>Presente/Ausente</th>
                          </tr>
                        </thead>
                            <tbody>
                        	<?php
                            if(isset($_POST['fetch-attendance'])) {

                            $fetch_date = sanitize_text_field($_POST['select-date']);

                        	global $wpdb;
                            $table_name = $wpdb->prefix . 'attendance_taken';
                            $employees_all_attn = $wpdb->get_results("SELECT * FROM $table_name where date='$fetch_date' ORDER BY id ASC");
                            foreach ($employees_all_attn as $emp_all_att) {
                            	# code...
                            	?>
                            	<tr>
                                <td><?php echo esc_html($emp_all_att->eid); ?></td>
                                <td><?php echo esc_html($emp_all_att->name); ?></td>
                        		<td><?php echo esc_html($emp_all_att->date); ?></td>
                        		<td><?php echo esc_html($emp_all_att->attendance); ?></td>
                        	   </tr>
                            	<?php
                            }
                            }
                            ?>
                            </tbody>
                    </table>
	            </div>
            </div>
        </div>
    </div>
</div>
    <?php
}

?>