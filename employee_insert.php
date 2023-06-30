<?php

function wpeas_employee_insert()
{
    //echo "insert page";
    ?>
<h1>Registro de Personas</h1>
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
                        <tr>
                            <td>Persona:</td>
                            <td><input type="text" name="employee-name" placeholder="" required></td>
                        </tr>
                        <tr>
                            <td>Genero:</td>
                            <td>
                            <label><input type="radio" name="employee-gender" value="male" checked>Masculino</label>
                            <label><input type="radio" name="employee-gender" value="female">Femenino</label>
                            <!-- <label><input type="radio" name="employee-gender" value="other">Other</label> -->
                            </td>
                        </tr>
                        <tr>
                            <td>Correo:</td>
                            <td>
                            <input type="text" name="employee-email" placeholder="" required>
                            </td>
                        </tr>
                            <tr>
                            <td>Fecha de Nacimiento:</td>
                            <td><input type="date" name="employee-dateofbirth" placeholder="" required></td>
                        </tr>
                        <tr>
                        <tr>
                            <td>N° Celular:</td>
                            <td><input type="text" name="employee-contact" placeholder="" required></td>
                        </tr>
                         <tr>
                            <td>Departamento :</td>
                            <td><input type="text" name="employee-department" placeholder="CSE , IT..." required></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Insertar nueva persona" name="insert-employee" class="all-button-classes"></td>
                            
                        </tr>
                        </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- form post methods starts here -->
<?php
    if(isset($_POST['insert-employee'])){
    global $wpdb;
    $table_name = $wpdb->prefix . 'employee_details';
        $employee_name=sanitize_text_field($_POST['employee-name']);
        $employee_gender=sanitize_text_field($_POST['employee-gender']);
        $employee_email=sanitize_email($_POST['employee-email']);
        $employee_dateofbirth=sanitize_text_field($_POST['employee-dateofbirth']);
        $employee_contact=sanitize_text_field($_POST['employee-contact']);
        $employee_department=sanitize_text_field($_POST['employee-department']);
        
        

        if(is_email($employee_email)) {

        $wpdb->insert(
            $table_name,
            array(
                'name' => $employee_name,
                'gender' => $employee_gender,
                'email' => $employee_email,
                'DOB' => $employee_dateofbirth,
                'contact_no' => $employee_contact,
                'department'=>$employee_department
            )
        );
        echo esc_html("inserted");
        
        ?>
        <meta http-equiv="refresh" content="1; url=<?=get_site_url()?>/wp-admin/admin.php?page=Employee_Listing" />
        <?php
        exit;
    } else {
        echo "invalid email";
    }

    } // if_isset bracket close here
} // function bracket close here

?>