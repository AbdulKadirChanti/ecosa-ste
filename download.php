<?php require_once('includes/session.php') ?>
<?php
$files = [];
if (isset($_POST["submit"])) {
    if (!empty($_POST["level"]) && !empty($_POST["semester"])) {
        $level = $_POST["level"];
        $semester = $_POST["semester"];
        $location = "uploads/$level/$semester/";
        if ($files = scandir($location, SCANDIR_SORT_ASCENDING)) {
            unset($files[0]);
            unset($files[1]); 
        }
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
    <div class="form-bar container text-center">
        <form method="post" action="download.php" class="form-content row">
            <div class="col heading form-bar-element">
                Find a File:
            </div>
            <div class="col form-bar-element">
                <select name="level" class="form-select">
                    <option selected>Select Level</option>
                    <option value="100">Level 100</option>
                    <option value="200">Level 200</option>
                    <option value="300">Level 300</option>
                    <option value="400">Level 400</option>
                </select>
            </div>
            <div class="col form-bar-element">
                <select name="semester" class="form-select">
                    <option selected>Select Semester</option>
                    <option value="sem1">Semester 1</option>
                    <option value="sem2">Semester 2</option>
                </select>
            </div>
            <div class="col form-bar-element">
                <button class="btn btn-outline-light" name="submit" type="submit">Search</button>
            </div>
        </form>
    </div>
    <div class="container-fluid main-body">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="wrapper">
                    <?php
                    echo error_message();
                    echo success_message();
                    ?>
                    <div class="wrapper-title text-center">
                        <h3>Download File</h3>
                        <p>Please click a file to download</p>
                    </div>
                    <div class="file-wrapper">
                        <?php
                        if (count($files) == 0) {
                            echo "No files to display";
                        } else {
                        ?>
                            <ul>
                                <?php foreach ($files as $file) { ?>
                                    <li><a href="downloading.php?location=<?php echo $location ?>&file=<?php echo $file ?>"> <?php echo $file ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</html>