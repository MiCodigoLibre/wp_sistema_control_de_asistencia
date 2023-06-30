<?php
//echo "employee delete";
function wpeas_employee_delete(){
    echo esc_html("employee delete");
    if(isset($_GET['id'])){
        global $wpdb;
        $table_name=$wpdb->prefix.'employee_details';
        $i=sanitize_text_field($_GET['id']);
        $wpdb->delete(
            $table_name,
            array('id'=>$i)
        );
        echo esc_html("deleted");
    }
    echo esc_html(get_site_url() .'/wp-admin/admin.php?page=Employee_List');
    ?>
    <meta http-equiv="refresh" content="0; url=<?=get_site_url()?>/wp-admin/admin.php?page=Employee_Listing" />
    <?php
}
   
?>