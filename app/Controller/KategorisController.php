<?php

class KategorisController extends AppController {

    var $disabledAction = array();

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Kategori");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function beforeRender() {
        parent::beforeRender();
        $this->set("jenisKategoris",$this->Kategori->JenisKategori->find("list",array("fields"=>array("JenisKategori.id","JenisKategori.nama"))));
    }
}
