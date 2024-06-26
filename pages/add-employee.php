<?php

$message = "";
$status = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_submit'])) {

    // FORM SUBMITTED
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    global $wpdb;

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_text_field($_POST['email']);
    $phonenumber = sanitize_text_field($_POST['phonenumber']);
    $gender = sanitize_text_field($_POST['gender']);
    $designation = sanitize_text_field($_POST['designation']);

    //Insert Command
    $wpdb->insert(
        "{$wpdb->prefix}ems_form_data",
        array(
            "name" => $name,
            "email" => $email,
            "phonenumber" => $phonenumber,
            "gender" => $gender,
            "designation" => $designation
        )
    );

    $last_inserted_id = $wpdb->insert_id;
    if ($last_inserted_id > 0) {
        $message = 'Employee saved successfully!';
        $status = 1;
    } else {
        $message = 'Failed to save an Employee!';
        $status = 0;
    }

}


?>


<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2>Add Employee Form</h2>
            <img src="<?php echo EMS_PlUGIN_URL . 'img/nabin-logo.png'; ?>" alt="" width="100px">
            <div class="panel panel-primary">
                <div class="panel-heading">Add Employee</div>
                <div class="panel-body">

                    <?php
                    if (!empty($message)) {

                        if ($status == 1) {

                            ?>
                            <div class="alert alert-success">
                                <?php echo $message; ?>
                            </div>
                            <?php

                        } else {

                            ?>
                            <div class="alert alert-danger">
                                <?php echo $message; ?>
                            </div>
                            <?php

                        }

                    }
                    ?>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=employee-system" method="post"
                        id="ems-frm-add-employee">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" required class="form-control" id="name" placeholder="Enter name"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" required class="form-control" id="email" placeholder="Enter email"
                                name="email">
                        </div>
                        <div class="form-group">
                            <label for="phonenumber">Phone Number:</label>
                            <input type="text" class="form-control" id="phonenumber" placeholder="Enter Phone Number"
                                name="phonenumber">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation:</label>
                            <input type="designation" required class="form-control" id="designation"
                                placeholder="Enter Designation" name="designation">
                        </div>
                        <button type="submit" class="btn btn-success" name="btn_submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>