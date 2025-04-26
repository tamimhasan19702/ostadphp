<?php

include 'includes/header.php';
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $filename = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $fileTmp = $_FILES['image']['tmp_name'];
    $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

    // Validate file size and type
    if ($fileSize > 5242880) { // 5MB in bytes
        echo "Error: File size should not be more than 5MB.";
    } elseif (!in_array($fileExt, $allowedExt)) {
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
    } else {
        uploadImage($title, $description, $filename, $fileTmp);
    }
}

function uploadImage($title, $description, $filename, $fileTmp)
{
    global $DB_con;

    try {
        $sql = "INSERT INTO images (title, description, filename) VALUES (:title, :description, :filename)";
        $stmt = $DB_con->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':filename', $filename);
        $stmt->execute();

        $uploads_dir = __DIR__ . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';
        if (!file_exists($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }

        $destination = $uploads_dir . DIRECTORY_SEPARATOR . $filename;
        move_uploaded_file($fileTmp, $destination);



        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<div class="container mt-5">
    <h1>Upload photo</h1>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

<?php

include 'includes/footer.php';