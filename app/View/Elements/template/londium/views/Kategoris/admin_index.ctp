<?php
echo $this->element("template/{$template}/filter/kategori");
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="icon-table"></i><?= __("") ?></h6>
    </div>
    <div class="datatable-pagination">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= __("Nama Kategori") ?></th>
                    <th><?= __("Jenis Kategori") ?></th>
                    <th><?= __("Aksi") ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $limit = intval(isset($this->params['named']['limit']) ? $this->params['named']['limit'] : 10);
                $page = intval(isset($this->params['named']['page']) ? $this->params['named']['page'] : 1);
                $i = ($limit * $page) - ($limit - 1);
                foreach ($data['rows'] as $item) {
                    ?>
                    <tr id="row-<?= $i ?>">
                        <td><?= $i ?></td>
                        <td><?= $item['Kategori']['nama'] ?></td>
                        <td><?= $item['JenisKategori']['nama'] ?></td>
                        <td><a href="<?= Router::url("/{$url}-edit/{$item[Inflector::classify($this->params['controller'])]['id']}",true)?>"><span class="btn btn-info"><?= __("Ubah") ?></span></a>&nbsp;<span class="btn btn-danger" onclick="hapusData(<?= $item[Inflector::classify($this->params['controller'])]['id']; ?>,'#row-<?= $i ?>')"><?= __("Hapus") ?></span></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php echo $this->element("template/{$template}/pagination") ?>
