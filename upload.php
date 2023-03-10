<?php require_once('includes/session.php'); ?>
<?php require_once('includes/functions.php'); ?>
<?php

if (isset($_POST['submit'])) {
  if (!empty($_POST['level']) && !empty($_POST['course']) && !empty($_POST['semester']) && !empty($_FILES['upload'])) {
    // die("ddd");
    $semester = $_POST['semester'];
    $level = $_POST['level'];
    $course = $_POST['course'];
    $file = $_FILES['upload'];
    $fileSize = $_FILES['upload']['size'];
    $fileName = $_FILES['upload']['name'];
    $fileTmpName = $_FILES['upload']['tmp_name'];
    $fileError = $_FILES['upload']['error'];
    $fileType = $_FILES['upload']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('pdf', 'jpg', 'jpeg', 'png', 'pptx', 'ppt', 'doc', 'docx', 'xlsx', 'xls');

    if (in_array($fileActualExt, $allowed)) {
      if ($fileError == 0) {
        if ($fileSize < 900000000) {
          $fileNameNew = $course . "_" . uniqid('', true) . "." . $fileActualExt;
          $fileDestination = 'uploads/' . $level . "/" . $semester . "/" . $fileNameNew;

          if(move_uploaded_file($fileTmpName, $fileDestination)) {
            $_SESSION["success-message"] = "File has been uploaded successfully";
          }else {
            $_SESSION["error-message"] = "Something went wrong. Please try again.";
          }          
          redirect("upload.php");
        } else {
          $_SESSION["error-message"] = "File is too big";
          redirect('upload.php');
        }
      } else {
        $_SESSION["error-message"] = "There was an error uploading your file";
        redirect('upload.php');
      }
    } else {
      $_SESSION["error-message"] = "You can only upload a pdf or an image file";
      redirect('upload.php');
    }
  } else {
    $_SESSION["error-message"] = "All fields are required";
    redirect('upload.php');
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <title>ECOSA PDF WEBSITE</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary bd-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"><img src="brand-logo.png" height="104px" /> </a>
      <div class="brand-title">ECOSA PDF WEBSITE</div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <div class="nav-buttons">
          <a href="upload.php" class="btn btn-primary">UPLOAD</a>
          <a href="download.php" class="btn btn-success">DOWNLOAD</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="container-fluid main-body">
    <div class="row">
      <div class="col-md-6 offset-3">
        <div class="form">
          <?php
          echo error_message();
          echo success_message();
          ?>
          <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-title text-center">
              <h3>Upload PDF File</h3>
            </div>
            <div class="mb-3">
              <label for="level" class="form-label">Level:</label>
              <select name="level" class="form-select form-select-lg mb-3">
                <option selected>Select Level</option>
                <option value="100">Level 100</option>
                <option value="200">Level 200</option>
                <option value="300">Level 300</option>
                <option value="400">Level 400</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="semester" class="form-label">Semester:</label>
              <select name="semester" class="form-select form-select-lg mb-3">
                <option selected>Select Semester</option>
                <option value="sem1">Semester 1</option>
                <option value="sem2">Semester 2</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="course" class="form-label">Course:</label>
              <input type="text" class="form-control" id="course" name="course" placeholder="Enter course name">
            </div>
            <div class="mb-3">
              <label for="file" class="form-label">File:</label>
              <input type="file" class="form-control" id="upload" name="upload">
            </div>
            <div class="mb-3 text-center">
              <button class="btn btn-success btn-block" type="submit" name="submit">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</html>