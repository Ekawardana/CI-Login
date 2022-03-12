<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="h3 mb-4 text-gray-800"><?= $title; ?></h2>

    <div class="row">
        <div class="col-lg-6">
            <form action="" method="post">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $menuId['id']; ?>">
                    <input type="text" class="form-control" id="menu" name="menu" value="<?= $menuId['menu']; ?>">
                </div>
                <a href="<?= base_url('menu'); ?>" class="btn btn-danger">
                    <i class="fas fa-ban mr-1"></i>Back
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-edit mr-1"></i>Edit
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->