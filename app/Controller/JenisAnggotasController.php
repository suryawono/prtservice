<?php

class JenisAnggotasController extends AppController {

    var $disabledAction = array();

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Kategori");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    public function index() {
        $data = $this->{ Inflector::classify($this->name) }->find('all', array("conditions" => array("NOT" => array("JenisAnggota.id" => 1))));
        $response = $this->_generateStatusCode(400, null, $data);
        $this->set(array(
            'response' => $response,
            '_serialize' => array('response')
        ));
    }

}
