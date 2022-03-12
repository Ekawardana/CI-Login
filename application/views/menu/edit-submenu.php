<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form action="" method="post">
                <div class="form-group">
                    <input type="hidden" id='id' name="id" value="<?= $subMenu['id']; ?>">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?= $subMenu['title']; ?>">
                    <small class="form-text text-danger"><?= form_error('title'); ?></small>
                </div>

                <div class="form-group">
                    <label for="menu">Menu</label>
                    <select name="menu_id" id="menu_id" class="form-control">
                        <option value="">-- Select Menu --</option>
                        <?php foreach ($menu as $m) : ?>
                            <?php if ($m['id'] == $subMenu['menu_id']) : ?>
                                <option value="<?= $m['id']; ?>" selected>
                                    <?= $m['menu']; ?>
                                </option>
                            <?php else : ?>
                                <option value="<?= $m['id']; ?>">
                                    <?= $m['menu']; ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control" name="url" id="url" value="<?= $subMenu['url']; ?>">
                </div>

                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input type="text" class="form-control" name="icon" id="icon" value="<?= $subMenu['icon']; ?>">
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Is Active?
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="<?= base_url('menu/submenu') ?>" class="btn btn-secondary">Close</a>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->