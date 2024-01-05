<?php

include '../admin/template/header.php';
include 'config.php';

$db = new database();
$data_article = $db->showUser();

?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> Article</h4>

  <!-- Responsive Table -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">
        <div class="row">
          <div class="col-lg-6">
            <h5>List Article</h5>
          </div>
          <div class="col-lg-6">
            <div class="float-end">
              <a href="add_article.php" class="btn btn-primary">
                <i class="bx bx-plus">Add Article</i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr class="text-nowrap">
              <th class="text-center bg-primary text-white">No</th>
              <th class="text-center bg-primary text-white">Image</th>
              <th class="text-center bg-primary text-white">Title</th>
              <th class="text-center bg-primary text-white">Status</th>
              <th class="text-center bg-primary text-white">Update Date</th>
              <th class="text-center bg-primary text-white">View</th>
              <th class="text-center bg-primary text-white">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($data_article == 'Data tidak tersedia') {
              echo "<tr><td class='text-center'>Data Tidak Tersedia</td></tr>";
            } else {

              $no = 1;
              foreach ($data_article as $row) {
                ?>
                <tr>
                  <th class="text-center">
                    <?= $no++; ?>
                  </th>
                  <td class="text-center">
                    <?= $row['image']; ?>
                  </td>
                  <td class="text-center">
                    <?= $row['title']; ?>
                  </td>
                  <td class="text-center">
                    <?= $row['status']; ?>
                  </td>
                  <td class="text-center">
                    <?= $row['updated_at']; ?>
                  </td>
                  <td class="text-center">
                    <?= $row['view']; ?>
                  </td>
                  <td class="text-center">
                    <a href="edit_article.php" class="btn btn-sm-warning">Update Article</a>
                    <a href="delete_article.php" class="btn btn-sm-danger">Delete Article</a>
                  </td>
                </tr>
              <?php }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>
<!-- / Content -->

<?php

include '../admin/template/footer.php';

?>