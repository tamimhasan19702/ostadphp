<?php
include 'includes/config.php';
include 'includes/header.php';

global $DB_con;


try {
    $sql = "SELECT id,title, description,filename, upload_date FROM images";
    $stmt = $DB_con->prepare($sql);
    $stmt->execute();

    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {

}


?>

<div class="container mt-5">
    <h1>Photo Gallery</h1>

    <div class="row">
        <?php

        if (!empty($images)):

            foreach ($images as $image):

                ?>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <img class="card-img-top" src="assets/images/<?php echo $image['filename']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $image['title']; ?></h5>
                            <p class="card-text"><?php echo $image['description']; ?>.</p>
                            <a href="#" class="btn btn-primary"><?php echo $image['upload_date']; ?></a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    No images found.
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

<?php

include 'includes/footer.php';