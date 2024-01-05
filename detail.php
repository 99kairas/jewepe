<?php

include("templates/header.php");
include("admin/config.php");

$db = new database();
$articleID = $_GET['id'];

if (!is_null($articleID)) {
    $data = $db->getByID($articleID);
    $updateView = $db->updateViewArticle($articleID);
    if (empty($data)) {
        echo "<script>alert('Article ID is not found');document.location.href = 'index.php';</script>";
    } elseif ($data["status"] != "published") {
        echo "<script>alert('Article is not published');document.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('You need to chooss article first!');document.location.href = 'index.php';</script>";
}

?>

<div class="site-cover site-cover-sm same-height overlay single-page"
    style="background-image: url('files/<?= $data['image']; ?>');">
    <div class="container">
        <div class="row same-height justify-content-center">
            <div class="col-md-6">
                <div class="post-entry text-center">
                    <h1 class="mb-4">
                        <?= $data['title']; ?>
                    </h1>
                    <div class="post-meta align-items-center text-center">
                        <figure class="author-figure mb-0 me-3 d-inline-block"><img
                                src="assets/landing/images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                        <span class="d-inline-block mt-1">By
                            <?= $data['name']; ?>
                        </span>
                        <span>&nbsp;-&nbsp;
                            <?php
                            if ($data['updated_at'] == '') {
                                echo date('d M Y', strtotime($data['created_at']));
                            } else {
                                echo date('d M Y', strtotime($data['updated_at']));
                            } ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">

        <div class="row blog-entries element-animate">

            <div class="col-md-12 col-lg-12 main-content">

                <div class="post-content-body">
                    <?= $data['content']; ?>
                </div>


            </div>

            <!-- END main-content -->

        </div>
    </div>
</section>

<?php

include("templates/footer.php");

?>