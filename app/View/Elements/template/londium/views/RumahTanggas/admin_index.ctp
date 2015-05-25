<?php
//echo $this->element("template/{$template}/filter/rumah-tangga");
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
                    <th><?= __("Nama Rumah Tangga") ?></th>
                    <th><?= __("Nama Kepala Rumah Tangga") ?></th>
                    <th><?= __("Alamat") ?></th>
                    <th><?= __("Deskripsi") ?></th>
                    <th><?= __("Status") ?></th>
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
                        <td><?= $item['RumahTangga']['nama'] ?></td>
                        <td><?= $item['RumahTangga']['nama_kepala_rumah_tangga'] ?></td>
                        <td><?= $item['RumahTangga']['alamat'] ?></td>
                        <td><?= $item['RumahTangga']['deskripsi'] ?></td>
                        <td>
                            <?php
                            if ($item['RumahTangga']['rumah_tangga_status_id'] == 1) {
                                echo $this->Html->changeStatusSelect($item['RumahTangga']['id'],array(1 => "Belum Diproses", 2 => "Diterima", 3 => "Ditolak"), $item['RumahTangga']['rumah_tangga_status_id'], Router::url("/admin/rumah_tanggas/change_status"));
                            } else {
                                echo $item['RumahTanggaStatus']['nama'];
                            }
                            ?>
                        </td>
                        <td><a href="<?= Router::url("/{$url}-edit/{$item[Inflector::classify($this->params['controller'])]['id']}", true) ?>"><span class="btn btn-info"><?= __("Ubah") ?></span></a>&nbsp;<span class="btn btn-danger" onclick="hapusData(<?= $item[Inflector::classify($this->params['controller'])]['id']; ?>, '#row-<?= $i ?>')"><?= __("Hapus") ?></span></td>
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
