<?php require_once('includes/session.php') ?>
<?php require_once('includes/functions.php') ?>
<?php
if (isset($_GET['location']) && isset($_GET['file'])) {
    // Initialize a file URL to the variable
    $location = $_GET['location'];
    $url = $location . $_GET['file'];

    //Check the file exists or not
    if (file_exists($url)) {

        //Define header information
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="' . basename($url) . '"');
        header('Content-Length: ' . filesize($url));
        header('Pragma: public');

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile($url);

        //Terminate from the script
        die();
    } else {
        $_SESSION['error-message'] = "File does not exist.";
        redirect("download.php");
    }
} else {
    $_SESSION['error-message'] = "Something went wrong. Please try again.";
    redirect("download.php");
}
