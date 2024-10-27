<?php
include($_SERVER['DOCUMENT_ROOT'].'/Home/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $studentNumber = $_POST['Student_Number'] ?? '';
    $lastName = $_POST['Last_Name'] ?? '';
    $firstName = $_POST['First_Name'] ?? '';
    $middleName = $_POST['Middle_Name'] ?? '';
    $college = $_POST['College'] ?? '';
    $department = $_POST['Department'] ?? '';
    $section = $_POST['Section'] ?? '';
    $yearGraduated = $_POST['Year_Graduated'] ?? '';
    $contactNumber = $_POST['Contact_Number'] ?? '';
    $personalEmail = $_POST['Personal_Email'] ?? '';
    $employment = $_POST['Employment'] ?? '';
    $employmentStatus = $_POST['Employment_Status'] ?? '';
    $presentOccupation = $_POST['Present_Occupation'] ?? '';
    $employerName = $_POST['Name_of_Employer'] ?? '';
    $employerAddress = $_POST['Address_of_Employer'] ?? '';
    $yearsInEmployer = $_POST['Number_of_Years_in_Present_Employer'] ?? '';
    $typeOfEmployer = $_POST['Type_of_Employer'] ?? '';
    $majorLineOfBusiness = $_POST['Major_Line_of_Business'] ?? '';

    // SQL query to insert the alumni information into the 2024-2025 table
    $sql = "INSERT INTO `2024-2025` 
            (Student_Number, Last_Name, First_Name, Middle_Name, College, Department, Section, Year_Graduated, 
             Contact_Number, Personal_Email) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement for the first table
    $stmt = $con->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . implode(", ", $con->errorInfo())); // Correct error handling
    }
    
    $stmt->execute([$studentNumber, $lastName, $firstName, $middleName, $college, 
                     $department, $section, $yearGraduated, $contactNumber, $personalEmail]);

    // Get the last inserted ID
    $lastId = $con->lastInsertId();

    // Now insert into the 2024-2025_ed table
    $sqlEd = "INSERT INTO `2024-2025_ed` 
              (Alumni_ID, Employment, Employment_Status, Present_Occupation, 
               Name_of_Employer, Address_of_Employer, Number_of_Years_in_Present_Employer, 
               Type_of_Employer, Major_Line_of_Business) 
              VALUES 
              (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement for the second table
    $stmtEd = $con->prepare($sqlEd);
    if ($stmtEd === false) {
        die("Prepare failed: " . implode(", ", $con->errorInfo())); // Correct error handling
    }

    $stmtEd->execute([$lastId, $employment, $employmentStatus, $presentOccupation, 
                      $employerName, $employerAddress, $yearsInEmployer, 
                      $typeOfEmployer, $majorLineOfBusiness]);

    if ($stmtEd->rowCount() > 0) {
        echo "Alumni information added successfully!";
    } else {
        echo "Error: No rows affected in the second table.";
    }

    // Close the connection
    $con = null;
} else {
    echo "Invalid request method.";
}
