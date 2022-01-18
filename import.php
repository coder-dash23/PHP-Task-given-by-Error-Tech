<?php
// Connect to database 
$db = mysqli_connect('localhost', 'root', '', 'registration');
if (!empty($_FILES["file"]["name"])) {
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {
        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
        // Skip the first line
        fgetcsv($csvFile);
        // Parse data from CSV file line by line
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
            // Get row data
            $name = $getData[0];
            $email = $getData[1];
            $status = $getData[2];
            // If user already exists in the database with the same email
            $query = "SELECT id FROM csv WHERE email = '" . $getData[1] . "'";
            $check = mysqli_query($db, $query);
            if ($check->num_rows > 0) {
                mysqli_query($db, "UPDATE `csv` SET `name` = '$name', ` email` = '$email', `created_at` = current_timestamp() WHERE `email` = '$email'");
            } else {
                mysqli_query($db, "INSERT INTO `csv` (`name`, `email`, `created_at`, `updated_at`) VALUES ('$name', '$email', current_timestamp(), current_timestamp());");
            }
        }
        // Close opened CSV file
        fclose($csvFile);
        echo "Success";
    }
     else {
        echo "Error1";
    }
}
