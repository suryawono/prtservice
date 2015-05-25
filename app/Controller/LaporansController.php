<?php

class LaporansController extends AppController {

    var $disabledAction = array();

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Laporan");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function beforeRender() {
        parent::beforeRender();
    }

    public function index() {
        $transaksiModel = ClassRegistry::init("Transaksi");
        $params = $this->params->query;
        if (!isset($params['jenis'])) {
            $code = 405;
        } else {
            switch ($params['jenis']) {
                case "bulanan":
                    $tahun = isset($params['tahun']) ? $params['tahun'] : false;
                    $anggota_id = isset($params['anggota_id']) ? $params['anggota_id'] : false;
                    if ($tahun === false || $anggota_id === false) {
                        $code = 405;
                    } else {
                        $transaksi = $transaksiModel->find("all", array(
                            "conditions" => array(
                                "Transaksi.anggota_id" => $anggota_id,
                            ),
                            "fields" => array(
                                "sum(CASE WHEN Kategori.jenis_kategori_id = 1 THEN Transaksi.besaran ELSE 0 END) as pemasukan",
                                "sum(CASE WHEN Kategori.jenis_kategori_id = 2 THEN Transaksi.besaran ELSE 0 END) as pengeluaran",
                                "Year(Transaksi.waktu) as tahun",
                                "Month(Transaksi.waktu) as bulan"
                            ),
                            "group" => array(
                                "Year(Transaksi.waktu)",
                                "Month(Transaksi.waktu)"
                            ),
                            "recursive" => 1,
                        ));
                        $data = [];
                        $data['anggota_id'] = $anggota_id;
                        $data['transaksi'] = $transaksi;
                        $data['query']=$this->params->query;
                        $code = 400;
                    }
                    break;
                default :
                    $code = 405;
                    break;
            }
        }

        $response = $this->_generateStatusCode($code, null, $data);
        $this->set(array(
            'response' => $response,
            '_serialize' => array('response')
        ));
    }

}
