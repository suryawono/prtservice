<?php

App::uses('AppController', 'Controller');

class RumahTanggasController extends AppController {

    var $name = "RumahTanggas";

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Rumah Tangga");
    }

    function admin_change_status() {
        $this->autoRender = false;
        if ($this->request->is("PUT")) {
            $this->RumahTangga->id = $this->request->data['id'];
            $this->RumahTangga->save(array("RumahTangga" => array("rumah_tangga_status_id" => $this->request->data['status'])));
            echo json_encode($this->_generateStatusCode(205));
        } else {
            echo json_encode($this->_generateStatusCode(403));
        }
    }

    public function view($id) {
        $data = $this->{ Inflector::classify($this->name) }->find("first", array("conditions" => array("RumahTangga.id" => $id),"recursive"=>3));
        if (empty($data)) {
            $response = $this->_generateStatusCode(401, null, $data);
        } else {
            $response = $this->_generateStatusCode(400, null, $data);
        }
        $this->set(array(
            'response' => $response,
            '_serialize' => array('response')
        ));
    }

}
