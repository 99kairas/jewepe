<?php

include 'template/header.php';
include 'config.php';

$db = new database();
$articleID = $_GET['id'];

if (!is_null($articleID)) {
    $data = $db->getByID($articleID);
    if (empty($data)) {
        echo "<script>alert('Article ID is not found');document.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('You need to chooss article first!');document.location.href = 'index.php';</script>";
}


?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management Article /</span> Edit
        Article</h4>

    <div class="row">
        <!-- Form controls -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Edit Article</h4>
                </div>
                <div class="card-body">
                    <form action="action_process.php?action=update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="articleID" value="<?= $data['id']; ?>">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Article Title *</label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Article Title" value="<?= $data['title']; ?>" required />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Description Title *</label>
                                    <input type="text" name="description" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Description Title"
                                        value="<?= $data['description']; ?>" required />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Content *</label>
                                    <textarea class="form-control summernote" name="content"
                                        id="exampleFormControlTextarea1" rows="3"
                                        required><?= $data['content']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="col-md mb-3">
                                    <small class="form-label d-block">Status *</small>
                                    <div class="form-check mt-3">
                                        <input name="status" class="form-check-input" type="radio" value="published"
                                            id="defaultRadio1" <?= $data['status'] == 'published' ? 'checked' : ''; ?>
                                            required>
                                        <label class="form-check-label" for="defaultRadio1"> Publish </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="status" class="form-check-input" type="radio" value="draft"
                                            id="defaultRadio2" <?= $data['status'] == 'draft' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="defaultRadio2"> Draft </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="uploadImage" class="form-label">Image *</label>
                                    <input type="file" name="image" class="form-control" id="exampleFormControlInput1"
                                        <?= $data['image'] == '' ? 'required' : ''; ?> />
                                    <small class="text-danger">Max Size 5MB, ext. png, jpg, jpeg</small>
                                </div>
                                <div class="mb-3">
                                    <label for="previewImage" class="form-label">Preview Image</label>
                                    <?php

                                    if ($data['image'] != "") { ?>
                                        <a href="../files/<?= $data['image']; ?>" target="_blank">
                                            <img src="../files/<?= $data['image']; ?>" class="img-thumbnail rounded"
                                                style="max-width:160px" alt="">
                                        </a>
                                        <?php
                                    } else {
                                        echo '<i class="text-danger">File Not Set!</i>';
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 float-end">
                            <a href="index.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php
include 'template/footer.php';
?>