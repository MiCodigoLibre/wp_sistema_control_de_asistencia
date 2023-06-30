<?php
//echo "update page";

function wpeas_employee_update(){
    //echo "update page in";
    $i=sanitize_text_field($_GET['id']);
    global $wpdb;
    $table_name = $wpdb->prefix . 'employee_details';
    $employees = $wpdb->get_results("SELECT id,name,gender,email,DOB,contact_no,department from $table_name where id=$i");
//    echo $employees[0]->id;
    ?>
<div class="dashboard-admin skwp-content-inner">
    <div class="skwp-card-info-wrap skwp-clearfix"> 
        <div class="attendance-common-div"> 
            <div class="skwp-card-inner"> 
                <div class="table-responsive">
                    <table class="form-table">
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
                                <td>Nombres:</td>
                                <td><input type="text" name="update-employee-name" value="<?= $employees[0]->name; ?>"></td>
                            </tr>

                            <tr>
                                <td>Genero:</td>
                                <td>

                                <label><input type="radio" name="update-employee-gender" value="male" <?php if($employees[0]->gender=="male"){echo esc_html("checked");} ?>>Masculino</label>

                                <label><input type="radio" name="update-employee-gender" value="female" <?php if($employees[0]->gender=="female"){echo esc_html("checked");} ?>>Femenino</label>

                                <!-- <label><input type="radio" name="update-employee-gender" value="other" <?php if($employees[0]->gender=="other"){echo esc_html("checked");} ?>>Other</label> -->

                                </td>
                            </tr>

                            
                            <tr>
                                <td>Correo:</td>
                                <td><input type="email" name="update-employee-email" value="<?= esc_html($employees[0]->email); ?>"></td>
                            </tr>

                            <tr>
                                <td>Fecha de Nacimiento:</td>
                                <td><input type="text" name="update-employee-dateofbirth" value="<?= esc_html($employees[0]->DOB); ?>"></td>
                            </tr>

                            <tr>
                                <td>Nro Contacto:</td>
                                <td><input type="text" name="update-employee-contact" value="<?= esc_html($employees[0]->contact_no); ?>"></td>
                            </tr>

                            <tr>
                                <td>Departamento:</td>
                                <td><input type="text" name="update-employee-department" value="<?= esc_html($employees[0]->department); ?>"></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td><input type="submit" value="Actualizar" name="employee-update" class="all-button-classes"></td>
                            </tr>
                        </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
    <?php
}
if(isset($_POST['employee-update']))
{
    global $wpdb;
    $table_name=$wpdb->prefix.'employee_details'; // table name
        $id=sanitize_text_field($_POST['id']);
        $employee_name=sanitize_text_field($_POST['update-employee-name']);
        $employee_gender=sanitize_text_field($_POST['update-employee-gender']);
        $employee_email=sanitize_email($_POST['update-employee-email']);
        $employee_dateofbirth=sanitize_text_field($_POST['update-employee-dateofbirth']);
        $employee_contact=sanitize_text_field($_POST['update-employee-contact']);
        $employee_department=sanitize_text_field($_POST['update-employee-department']);

        if(is_email($employee_email)) {

    $wpdb->update(
        $table_name,
        array(
                'name' => $employee_name,
                'gender' => $employee_gender,
                'email' => $employee_email,
                'DOB' => $employee_dateofbirth,
                'contact_no' => $employee_contact,
                'department'=>$employee_department
            ),
        array(
            'id'=>$id
        )
    );
    $url=admin_url('admin.php?page=Employee_List');
    header("location:".get_site_url()."/wp-admin/admin.php?page=Employee_Listing");
    } else {
        echo "invalid email";
    }
}
?>