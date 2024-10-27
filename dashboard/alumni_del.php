<?php
include '../connection.php';

if (isset($_GET['Id'])) {
    $id = $_GET['Id'];
    $stmt = $con->prepare("DELETE FROM `2024-2025` WHERE Alumni_ID_Number = ?");
    $stmt->execute([$id]);
    
    $stmt2 = $con->prepare("DELETE FROM `2024-2025_ED` WHERE Alumni_ID_Number = ?");
    $stmt2->execute([$id]);
    
    header('Location: alumni_list.php');
    exit;
} else {
    header('Location: alumni_list.php');
    exit;
}
?>
