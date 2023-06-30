<?php
//echo "update page";
function wpeas_attendance_update(){

    //echo "update page in";
    echo "<br><div style='font-size:25px;'>Edición de Asistencia</div>";

    get_option('timezone_string');
	$date = date("Y-m-d");
    $Today = date("d-m-Y", strtotime($date));

    $i=sanitize_text_field($_GET['id']);
    global $wpdb;
    $table_name = $wpdb->prefix . 'attendance_taken';
    $employees = $wpdb->get_results("SELECT id,eid,name,attendance from $table_name where id=$i and date='$Today' ORDER BY id ASC");
   // echo $employees[0]->id;
    ?>
    <br>
    <table>
        <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <form name="frm" action="#" method="post">
            <input type="hidden" name="id" value="<?= $employees[0]->id; ?>">
            <tr>
                <td>Persona ID</td>
                <td><?= esc_html($employees[0]->id); ?></td>
            </tr>
            <tr>
                <td>Nombres:</td>
                <td><?= esc_html($employees[0]->name); ?></td>
            </tr>

            <tr>
                <td>Estado de Asistencia:</td>
                <td>

                <label><input type="radio" name="update-employee-attendance" value="Present" <?php if($employees[0]->attendance=="Present"){echo esc_html("checked");} ?>>Presente</label>

                <label><input type="radio" name="update-employee-attendance" value="Absent" <?php if($employees[0]->attendance=="Absent"){echo esc_html("checked");} ?>>Ausente</label>

                

                </td>
            </tr>

            <tr>
                <td colspan="2"><input type="submit" value="Actualizar" name="attendance-update"></td>
                
            </tr>
        </form>
        </tbody>
    </table>
    <?php
}
if(isset($_POST['attendance-update']))
{
    global $wpdb;
    $table_name=$wpdb->prefix.'attendance_taken'; // table name
        $id=sanitize_text_field($_POST['id']);
  //      $employee_name=$_POST['update-employee-name'];
        $employee_attendance=sanitize_text_field($_POST['update-employee-attendance']);
        
    $wpdb->update(
        $table_name,
        array(
                
                'attendance'=>$employee_attendance
            ),
        array(
            'id'=>$id
        )
    );
    $url=admin_url('admin.php?page=View_Todays_Attendance');
    header("location:".get_site_url()."/wp-admin/admin.php?page=View_Todays_Attendance");
}
?>