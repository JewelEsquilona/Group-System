<?php
include '../connection.php';


if (isset($_GET['Alumni_ID_Number'])) {
    $id = $_GET['Alumni_ID_Number'];
    $stmt = $con->prepare("SELECT * FROM `2024-2025` a LEFT JOIN `2024-2025_ED` ed ON a.Alumni_ID_Number = ed.Alumni_ID_Number WHERE a.Alumni_ID_Number = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();


    $alumni = $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$alumni) {
        header('Location: alumni_list.php');
        exit;
    }
} else {
    header('Location: alumni_list.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alumni</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/reg.css">
    <?php include '../assets/js/editscript.js'; ?>
</head>


<body>
    <div class="container form-container mt-5">
        <header class="mb-4">Update Alumni</header>
        <form action="alumni_edit.php" method="POST" class="form">
            <input type="hidden" name="alumni_id" value="<?php echo htmlspecialchars($alumni['Alumni_ID_Number']); ?>">


            <div class="mb-3">
                <label for="student-number" class="form-label">Student Number</label>
                <input type="text" id="student-number" name="student_number" class="form-control" value="<?php echo htmlspecialchars($alumni['Student_Number']); ?>" required autocomplete="student-number">
            </div>


            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($alumni['Last_Name']); ?>" required autocomplete="family-name">
                </div>
                <div class="col-md-4">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($alumni['First_Name']); ?>" required autocomplete="given-name">
                </div>
                <div class="col-md-4">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($alumni['Middle_Name']); ?>" autocomplete="additional-name">
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="college" class="form-label">College</label>
                    <select class="form-control" id="college" name="college" value="<?php echo "" . htmlspecialchars($alumni['College']); ?>
                        <option value=">Select College</option>
                        <option value="CITCS" <?php echo ($alumni['College'] == 'CITCS') ? 'selected' : ''; ?>>CITCS</option>
                        <option value="CAS" <?php echo ($alumni['College'] == 'CAS') ? 'selected' : ''; ?>>CAS</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="department" class="form-label">Department</label>
                    <select class="form-control" id="department" name="department" required>
                        <option value="">Select Department</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="section" class="form-label">Section</label>
                    <select class="form-control" id="section" name="section" required>
                        <option value="">Select Section</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="year_graduated" class="form-label">Year Graduated</label>
                    <input type="text" class="form-control" id="year_graduated" name="year_graduated" value="<?php echo htmlspecialchars($alumni['Year_Graduated']); ?>" required autocomplete="bday-year">
                </div>
                <div class="col-md-4">
                    <label for="contact_number" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($alumni['Contact_Number']); ?>" required autocomplete="tel">
                </div>
                <div class="col-md-4">
                    <label for="personal_email" class="form-label">Personal Email</label>
                    <input type="email" class="form-control" id="personal_email" name="personal_email" value="<?php echo htmlspecialchars($alumni['Personal_Email']); ?>" required autocomplete="email">
                </div>
            </div>


            <div class="mb-3">
                <label for="employment-status" class="form-label">Employment Status</label>
                <select id="employment-status" name="employment_status" class="form-control" required>
                    <option value="">Select Employment Status</option>
                    <option value="employed" <?php echo ($alumni['Employment_Status'] == 'employed') ? 'selected' : ''; ?>>Employed</option>
                    <option value="unemployed" <?php echo ($alumni['Employment_Status'] == 'self-employed') ? 'selected' : ''; ?>>Self-employed</option>
                    <option value="actively looking for a job" <?php echo ($alumni['Employment_Status'] == 'actively looking for a job') ? 'selected' : ''; ?>>Actively Looking for a Job</option>
                    <option value="never been employed" <?php echo ($alumni['Employment_Status'] == 'never been employed') ? 'selected' : ''; ?>>Never Been Employed</option>
                </select>
            </div>


            <div id="employmentFields" style="display: none;">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="present_occupation" class="form-label">Present Occupation</label>
                        <input type="text" class="form-control" id="present_occupation" name="present_occupation" value="<?php echo htmlspecialchars($alumni['Present_Occupation']); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="name_of_employer" class="form-label">Name of Employer</label>
                        <input type="text" class="form-control" id="name_of_employer" name="name_of_employer" value="<?php echo htmlspecialchars($alumni['Name_of_Employer']); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="address_of_employer" class="form-label">Address of Employer</label>
                        <input type="text" class="form-control" id="address_of_employer" name="address_of_employer" value="<?php echo htmlspecialchars($alumni['Address_of_Employer']); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="number_of_years_in_present_employer" class="form-label">Years in Present Employer</label>
                        <input type="number" class="form-control" id="number_of_years_in_present_employer" name="number_of_years_in_present_employer" value="<?php echo htmlspecialchars($alumni['Number_of_Years_in_Present_Employer']); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="type_of_employer" class="form-label">Type of Employer</label>
                        <input type="text" class="form-control" id="type_of_employer" name="type_of_employer" value="<?php echo htmlspecialchars($alumni['Type_of_Employer']); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="major_line_of_business" class="form-label">Major Line of Business</label>
                        <input type="text" class="form-control" id="major_line_of_business" name="major_line_of_business" value="<?php echo htmlspecialchars($alumni['Major_Line_of_Business']); ?>">
                    </div>
                </div>
            </div>


            <div class="button-container">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" onclick="history.back()">Back</button>
            </div>
        </form>
    </div>
</body>


<script src="../assets/js/script.js"></script>
<script src="../assets/js/bootstrap.bundle.js"></script>


</html>

