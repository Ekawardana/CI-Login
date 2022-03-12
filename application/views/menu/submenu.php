<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h2 class="h3 mb-4 text-gray-800"><?= $title; ?></h2>


    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                </div>
                <?= validation_errors(); ?>
            <?php endif; ?>

            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

            <a href="<?= base_url('menu/addSubmenu') ?>" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubmenu">Add New Submenu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['menu']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <td><?= $sm['is_active']; ?></td>
                            <td>
                                <a href="<?= base_url('menu/updateSubMenu/') . $sm['id']; ?>" class="badge badge-success">
                                    <i class="fas fa-edit mr-1"></i>Edit</a>

                                <a href="<?= base_url('menu/deletesubMenu/') . $sm['id']; ?>" class="badge badge-danger tombol-hapus">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Menu -->
<div class="modal fade" id="newSubmenu" tabindex="-1" role="dialog" aria-labelledby="newSubmenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubmenuLabel">Add New Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Form -->
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title...">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>">
                                    <?= $m['menu']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu Url...">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu Icon...">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
</div>
<!-- End Modal Menu -->