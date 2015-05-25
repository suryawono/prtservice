<?php

App::uses('AppController', 'Controller');

class AnggotasController extends AppController {

    var $name = "Anggotas";

    function beforeFilter() {
        parent::beforeFilter();
    }

    public function view($id) {
        $data = $this->{ Inflector::classify($this->name) }->find("first", array("conditions" => array("Anggota.id" => $id), "recursive" => 2));
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

    public function add() {
        $this->data = $this->request->data;
        $this->{ Inflector::classify($this->name) }->set($this->data);
        if ($this->{ Inflector::classify($this->name) }->validates()) {
            if (isset($this->{ Inflector::classify($this->name) }->data['Anggota']['jenis_anggota_id'])) {
                
            } else {
                $this->{ Inflector::classify($this->name) }->data['Anggota']['jenis_anggota_id'] = 1;
            }
            if ($this->{ Inflector::classify($this->name) }->data['Anggota']['jenis_anggota_id'] == 1) {
                $rumahTanggaId = $this->Anggota->RumahTangga->_add();
                $this->{ Inflector::classify($this->name) }->data['Anggota']['rumah_tangga_id'] = $rumahTanggaId;
            }
            $this->{ Inflector::classify($this->name) }->save();
            $response = $this->_generateStatusCode(200, null, $this->data);
        } else {
            $response = $this->_generateStatusCode(101, null, array("errors" => $this->{ Inflector::classify($this->name) }->validationErrors));
        }
        $this->set(array(
            'response' => $response,
            '_serialize' => array('response')
        ));
    }

    function login() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->register()) {
                if ($this->Anggota->hasAny(array("Anggota.email" => $this->data['email'])) && !$this->{ Inflector::classify($this->name) }->isActive()) {
                    $response = $this->_generateStatusCode(404);
                } else {
                    $data = $this->Anggota->find("first", array("conditions" => array("Anggota.email" => $this->data['email'])));
                    $response = $this->_generateStatusCode(202, null, array("anggota" => $data['Anggota'], 'rumah_tangga' => $data['RumahTangga']));
                }
            } else {
                $response = $this->_generateStatusCode(402);
            }
        } else {
            $response = $this->_generateStatusCode(403);
        }
        $this->set(array(
            'response' => $response,
            '_serialize' => array('response')
        ));
    }
}
