<?php
    include 'settings.php'; 

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: apply.php"); 
        exit();
    }

    $errMsg = ""; 
    $data = array(); 

// FUNCTIONS FOR SANIIZATION

    function sanitize_input($data) {
        $data = trim($data); 
        $data = stripslashes($data); 
        $data = htmlspecialchars($data);
        return $data;
    }

// TAKE IN AND SANITIZE DATE FROM APPLY.PHP

    $data['job_ref'] = sanitize_input($_POST['job-reference'] ?? '');
    $data['first_name'] = sanitize_input($_POST['fname'] ?? '');
    $data['last_name'] = sanitize_input($_POST['lname'] ?? '');
    $data['dob'] = sanitize_input($_POST['dob'] ?? '');
    $data['gender'] = sanitize_input($_POST['gender'] ?? '');
    $data['street_address'] = sanitize_input($_POST['street_add'] ?? '');
    $data['suburb_town'] = sanitize_input($_POST['suburb_town'] ?? '');
    $data['state'] = sanitize_input($_POST['state'] ?? '');
    $data['postcode'] = sanitize_input($_POST['postcode'] ?? '');
    $data['email'] = sanitize_input($_POST['email'] ?? '');
    $data['phone_number'] = sanitize_input($_POST['phone_number'] ?? '');
    $data['other_skills_text'] = sanitize_input($_POST['otherskills'] ?? '');
    $data['declaration'] = isset($_POST['declaration']); 

    $selected_skills = isset($_POST['skills']) ? $_POST['skills'] : array();


    



// DATA VALIDATION
    
// THE FIELD BELOW IS REQUIRED not OPTIONAL

    if (empty($data['job_ref'])) $errMsg .= "<li>Job reference number is required.</li>";
    if (empty($data['first_name'])) $errMsg .= "<li>First name is required.</li>";
    if (empty($data['last_name'])) $errMsg .= "<li>Last name is required.</li>";
    if (empty($data['dob'])) $errMsg .= "<li>Date of Birth is required.</li>";
    if (empty($data['gender'])) $errMsg .= "<li>Gender is required.</li>";
    if (empty($data['street_address'])) $errMsg .= "<li>Street Address is required.</li>";
    if (empty($data['suburb_town'])) $errMsg .= "<li>Suburb/town is required.</li>";
    if (empty($data['state'])) $errMsg .= "<li>State is required.</li>";
    if (empty($data['postcode'])) $errMsg .= "<li>Postcode is required.</li>";
    if (empty($data['email'])) $errMsg .= "<li>Email address is required.</li>";
    if (empty($data['phone_number'])) $errMsg .= "<li>Phone number is required.</li>";

    
// NAME CHECK
    $name_regex = "/^[a-zA-Z]{1,20}$/";
    if (!preg_match($name_regex, $data['first_name']) && !empty($data['first_name'])) {
        $errMsg .= "<li>First name must be 1 to 20 alpha characters.</li>";
    }
    if (!preg_match($name_regex, $data['last_name']) && !empty($data['last_name'])) {
        $errMsg .= "<li>Last name must be 1 to 20 alpha characters.</li>";
    }

// STREET ADDRESS CHECK (MAX 40 CHARACTERS)

    if (strlen($data['street_address']) > 40) {
        $errMsg .= "<li>Street Address must be at most 40 characters.</li>";
    }
    if (strlen($data['suburb_town']) > 40) {
        $errMsg .= "<li>Suburb/town must be at most 40 characters.</li>";
    }

// EMAIL CHECK 
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) && !empty($data['email'])) {
        $errMsg .= "<li>Invalid email format.</li>";
    }

// PHONE NUMBER CHECK (8-12 digits)

    $phone_digits = preg_replace('/\s+/', '', $data['phone_number']);
    if (!preg_match("/^[\d\s]{8,12}$/", $data['phone_number']) && !empty($data['phone_number'])) {
        $errMsg .= "<li>Phone number must be 8 to 12 digits (can contain spaces).</li>";
    }
    
// POSTCODE CHECK (EXACTLY 4 DIGITS)

    if (!preg_match("/^\d{4}$/", $data['postcode']) && !empty($data['postcode'])) {
        $errMsg .= "<li>Postcode must be exactly 4 digits.</li>";
    }

// DOB CHECK
    $dob_parts = explode('-', $data['dob']);
    if (count($dob_parts) === 3) {
        $year = (int)$dob_parts[0];
        $month = (int)$dob_parts[1];
        $day = (int)$dob_parts[2];
        
        if (!checkdate($month, $day, $year)) {
            $errMsg .= "<li>Date of Birth is invalid.</li>";
        } else {
            $today = new DateTime();
            $birthDate = new DateTime($data['dob']);
            $age = $today->diff($birthDate)->y;

            if ($age < 15 || $age > 80) { 
                $errMsg .= "<li>Applicant must be between 15 and 80 years old.</li>";
            }
        }
    }
    
// SKILL CHECK

    $has_other_skill_checkbox = false; 
    foreach ($selected_skills as $skill) {
        if ($skill === 'Other skills') { 
            $has_other_skill_checkbox = true;
            break;
        }
    }
    if (empty($selected_skills)) {
        $errMsg .= "<li>You must select at least one technical skill from the list.</li>";
    }

    if (!$data['declaration']) {
        $errMsg .= "<li>You must agree to the declaration (The skills I ticked are true representation of my abilities).</li>";
    }


    if ($has_other_skill_checkbox && empty($data['other_skills_text'])) {
        $errMsg .= "<li>Description for 'Other skills' is required if the checkbox is selected.</li>";
    }



// POSTCODE MATCH STATE CHECK    

    $state_postcode_map = [
        'VIC' => ['3', '8'], 'NSW' => ['2'], 'QLD' => ['4', '9'], 'NT' => ['0'], 
        'WA' => ['6'], 'SA' => ['5'], 'TAS' => ['7'], 'ACT' => ['0']
    ];
    $first_digit = substr($data['postcode'], 0, 1);
    $valid_starts = $state_postcode_map[$data['state']] ?? [];

    if (!empty($data['state']) && !empty($data['postcode']) && !in_array($first_digit, $valid_starts)) {
         $errMsg .= "<li>Postcode does not match the selected State ({$data['state']}).</li>";
    }

// DISPLAY THE RESULT
    
    echo '<main class="main_container">';
    echo '<div class="form_container">';

    if (!empty($errMsg)) {
        echo "<h2>Application Failed Validation!</h2>";
        echo "<p>Your Expression of Interest was NOT accepted due to the following errors:</p>";
        echo "<ul style='color:red;'>" . $errMsg . "</ul>";
        echo "<p>Please <a href='apply.php'>go back</a> and correct the errors.</p>";
        
    } else {
       
        $skill_fields = array_fill(1, 16, NULL);
        $skill_values = [];
        $skill_types = ''; 

        for ($i = 0; $i < count($selected_skills); $i++) {
            if ($i < 16) {
                $skill_fields[$i+1] = $selected_skills[$i]; 
            }
        }
        $skill_values = array_values($skill_fields); 
        
        $status = "New"; 
        
        $skill_columns = '';
        $skill_placeholders = '';
        for ($i = 1; $i <= 16; $i++) {
            $skill_columns .= ", skill{$i}";
            $skill_placeholders .= ", ?";
        }


        $sql = "INSERT INTO eoi (job_reference, first_name, last_name, date_of_birth, gender, street_address, suburb_town, state, postcode, email, phone_number, other_skills, status {$skill_columns}) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? {$skill_placeholders})";
        
        if ($stmt = $conn->prepare($sql)) {
        
            $bind_types = str_repeat('s', 29); 
            
            $bind_params = array_merge(
                [$bind_types],
                [
                    $data['job_ref'], $data['first_name'], $data['last_name'], $data['dob'], $data['gender'], 
                    $data['street_address'], $data['suburb_town'], $data['state'], $data['postcode'], $data['email'], 
                    $data['phone_number'], $data['other_skills_text'], $status
                ],
                $skill_values
            );
            
            call_user_func_array([$stmt, 'bind_param'], $bind_params);

            if ($stmt->execute()) {
                $eoi_number = $conn->insert_id; 
                
                echo "<h2>Application Submitted Successfully!</h2>";
                echo "<p>Thank you for your Expression of Interest. Your application has been successfully recorded.</p>";
                echo "<p>Your unique **EOINumber** is: <strong>" . $eoi_number . "</strong></p>";
                echo "<p>Please keep this number for future reference.</p>";
                
            } else {
                echo "<h2>Database Error!</h2>";
                echo "<p>A database error occurred during submission. Please try again later.</p>";
            }
            
            $stmt->close();

        } else {
             echo "<h2>System Error!</h2>";
             echo "<p>Could not prepare database statement. Contact the system administrator.</p>";
        }

        $conn->close();
    }
    
    echo '</div>';
    echo '</main>';
    
?>