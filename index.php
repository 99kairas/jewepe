<?php
include 'templates/header.php';
include 'admin/config.php';

$db = new database();
$articleData = $db->showDataLanding();
?>

<section class="section">
    <div class="container">

        <div class="row mb-4">
            <div class="col-sm-6">
                <h2 class="posts-entry-title">Mading JeWePe</h2>
            </div>
        </div>

        <div class="row">
            <?php
            foreach ($articleData as $row) {
                ?>
                <div class="col-lg-4 mb-4">
                    <div class="post-entry-alt">
                        <a href="detail.php?id=<?= $row['id'] ?>" class="img-link"><img src="files/<?= $row['image']; ?>"
                                alt="Image" class="img-fluid"></a>
                        <div class="excerpt">


                            <h2><a href="detail.php?id=<?= $row['id'] ?>">
                                    <?= $row['title']; ?>
                                </a></h2>
                            <div class="post-meta align-items-center text-left clearfix">
                                <figure class="author-figure mb-0 me-3 float-start"><img
                                        src="assets/landing/images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                                <span class="d-inline-block mt-1">By <a href="#">
                                        <?= $row['name']; ?>
                                    </a></span>
                                <span>&nbsp;-&nbsp;
                                    <?php
                                    if ($row['updated_at'] == '') {
                                        echo date('d M Y', strtotime($row['created_at']));
                                    } else {
                                        echo date('d M Y', strtotime($row['updated_at']));
                                    } ?>
                                </span>
                            </div>
                            <?= $row['content']; ?>
                            <p>
                                <a href="detail.php?id=<?= $row['id'] ?>" class="read-more">Continue Reading</a>
                            </p>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>

        </div>

    </div>
</section>

<?php

include 'templates/footer.php';

?>