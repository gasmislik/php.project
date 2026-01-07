<!-- documents.php -->
<?php
require 'sql_queries.php';
require '../backend/fetchNotifications.php';

function createDocumentCard($title, $description, $value, $isChecked, $pic) {
    $checkedAttribute = $isChecked ? 'checked' : '';
    $value = htmlspecialchars($value);
    return "
    <div class='col-sm-6 mb-3 mb-sm-0'>
        <div class='card text-dark d-flex flex-row align-items-center' style='background:linear-gradient(to right,#e2e2e2,#c9d6ff);'>
            <div class='card-body w-75'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text'>$description</p>
                <input class='pb-3' type='checkbox' name='documents[]' value='$value' $checkedAttribute>
            </div>
            <div class='w-25 text-end'>
                <img src='$pic' alt='Document Image' class='img-fluid rounded' style='max-width: 170px; height: 150px;'>
            </div>
        </div>
    </div>
    ";
}

// Document details (translated to English)
$documents = [
    ['title' => 'Enrollment Certificate', 
     'description' => 'Certifies that the student is currently enrolled in the institution for the academic year.', 
     'value' => 'Enrollment Certificate', 'pic' => '../img/1.jpg'],
    ['title' => 'Transcript', 
     'description' => 'A document summarizing grades obtained during examinations.', 
     'value' => 'Transcript', 'pic' => '../img/8.jpg'],
    ['title' => 'Certificate of Achievement or Diploma', 
     'description' => 'Certifies that the student has successfully completed a study cycle or specific degree program.', 
     'value' => 'Certificate of Achievement or Diploma', 'pic' => '../img/10.jpg'],
    ['title' => 'Internship Agreement', 
     'description' => 'Official document outlining the terms of an internship with a company.', 
     'value' => 'Internship Agreement', 'pic' => '../img/9.jpg'],
    ['title' => 'Non-Enrollment Certificate', 
     'description' => 'Attests that a student is not enrolled in the institution for a given year.', 
     'value' => 'Non-Enrollment Certificate', 'pic' => '../img/6.jpg'],
    ['title' => 'Transfer Certificate', 
     'description' => 'Required when transferring to another institution while moving academic records.', 
     'value' => 'Transfer Certificate', 'pic' => '../img/11.avif']
];

// Handle form submission
if (isset($_POST['finish'])) {
    $selectedDocuments = $_POST['documents'] ?? []; 
    handleDocumentSubmission($conn, $matricule, $selectedDocuments);
    header("Location: documents.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request</title>
    <link rel="stylesheet" href="../style/main.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../img/3.png" />
</head>
<body id="main1" class="img text-white background-slider">

<?php include '../partials/header.php'; ?>

<div class="p-5 mt-5 text-white border border1 border-white fade-in" style="background: rgba(0, 0, 0, 0); backdrop-filter: blur(5px);">
    <?php 
    if (isset($_SESSION['status'])) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Notice:</strong> {$_SESSION['status']}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        unset($_SESSION['status']);
    }
    ?>

    <div class="card-header">
        <h4>Select Documents</h4>
    </div>
    <br>
    <div class="card-body">
        <form action="documents.php" method="POST" onsubmit="return confirm('Are you sure you want to submit your document selection?');">
            <div class="form-group mb-3 switch">
                <div class="row">
                    <?php
                        foreach ($documents as $doc) {
                            $isChecked = isset($_SESSION['checked_documents']) && in_array($doc['value'], $_SESSION['checked_documents']);
                            echo createDocumentCard($doc['title'], $doc['description'], $doc['value'], $isChecked, $doc['pic']);
                        }
                        unset($_SESSION['checked_documents']);
                    ?>
                </div>
            </div>
            <div class="d-inline-flex gap-1 d-md-flex justify-content-md-end">
                <button class="btn btn-outline-light me-md-2" type="submit" name="finish" style="background-color: rgb(133, 162, 255);">Submit Request</button>
            </div>
        </form>
    </div>
</div>

<?php include '../partials/sidebar.php'; ?>
<?php include '../partials/footer.php'; ?>