<?php

global $wpdb;

$employees_list = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ems_form_data", ARRAY_A);

// echo "<pre>";
// print_r($employees_list);
// echo "</pre>";

?>


<div class="container">
    <div class="row">
        <div class="col-sm-11">
            <h2>List Emolyee</h2>
            <div class="panel panel-primary">
                <div class="panel-heading">List Employee</div>
                <div class="panel-body">

                    <table class="table" id="tbl-employee">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>#Name</th>
                                <th>#Email</th>
                                <th>#Gender</th>
                                <th>#Designation</th>
                                <th>#Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            if (count($employees_list) > 0) {

                                foreach ($employees_list as $employee_list) {

                                    ?>

                                    <tr>
                                        <td><?php echo $employee_list['Id']; ?></td>
                                        <td><?php echo $employee_list['name'];?></td>
                                        <td><?php echo $employee_list['email'];?></td>
                                        <td><?php echo ucfirst($employee_list['gender']); ?></td>
                                        <td><?php echo $employee_list['designation'];?></td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-warning">Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-danger">Delete</a>
                                            <a href="javascript:void(0)" class="btn btn-info">View</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            } else {
                                echo "No employee found";
                            }

                            ?>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>