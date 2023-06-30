<?php

function wpeas_employee_list() {
    ?>

<div class="dashboard-admin skwp-content-inner">
  <div class="skwp-card-info-wrap skwp-clearfix"> 
  <div class="attendance-common-div"> 
  <div class="skwp-card-inner"> 
    <div class="table-responsive">
        <table width="100%" class="table table-striped table-lightfont">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Genero</th>
                <th>Correo Electronico</th>
                <th>Fecha de Nacimiento</th>
                <th>Nro de Contacto</th>
                <th>Departamento</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            <?php
            global $wpdb;
            $table_name = $wpdb->prefix . 'employee_details';
            $employees = $wpdb->get_results("SELECT id,name,gender,email,DOB,contact_no,department from $table_name");
            foreach ($employees as $employee) {
                ?>
                <tr>
                    <td><?= $employee->id; ?></td>
                    <td><?= $employee->name; ?></td>
                    <td><?= $employee->gender; ?></td>
                    <td><?= $employee->email; ?></td>
                    <td><?= $employee->DOB; ?></td>
                    <td><?= $employee->contact_no; ?></td>
                    <td><?= $employee->department; ?></td>
                    <td><a href="<?php echo esc_html(admin_url('admin.php?page=Employee_Update&id=' . $employee->id)); ?>">Editar</a>&nbsp; <a href="<?php echo esc_html(admin_url('admin.php?page=Employee_Delete&id=' . $employee->id)); ?>"> Eliminar</a></td>
                </tr>
            <?php } ?>

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