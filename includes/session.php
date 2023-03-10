<?php 
session_start();
function error_message() {
	if(isset($_SESSION['error-message'])) {
        $output = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
        $output .= $_SESSION['error-message'];
        $output .= " <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        $output .= "</div>";
        $_SESSION['error-message'] = null;
        return $output;
	}
}
function success_message() {
	if(isset($_SESSION['success-message'])) {
		$output = "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
		$output.= $_SESSION['success-message'];
        $output.= " <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
		$output.= "</div>";
		$_SESSION['success-message'] = null;
		return $output;
	}
}
