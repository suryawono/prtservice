<?php

class Anggota extends AppModel {

    public $validate = array(
        'email' => array(
            'Bukan format email' => array(
                'rule' => 'email',
            ),
            'Email harus diisi' => array(
                'rule' => 'notEmpty',
            ),
            'Email sudah terdaftar' => array(
                'rule' => 'isUnique',
            ),
        ),
        'alamat' => array(
            'rule' => 'notEmpty',
            'message' => 'Alamat harus diisi',
        ),
        'nama_depan' => array(
            'rule' => 'notEmpty',
            'message' => 'Nama depan harus diisi',
        ),
        'password' => array(
            'Password harus alphanumeric' => array(
                'rule' => 'alphaNumeric',
            ),
            'Password harus diisi' => array(
                'rule' => 'notEmpty',
            ),
        ),
        'repeat_password' => array(
            'Password harus alphanumeric' => array(
                'rule' => 'alphaNumeric',
            ),
            'Harus diisi' => array(
                'rule' => 'notEmpty',
            ),
            'Password tidak sama' => array(
                'rule' => 'checkPassword'
            ),
        ),
    );
    public $belongsTo = array(
        "RumahTangga",
        "JenisAnggota",
        "HubunganAnggota",
    );
    public $hasMany = array(
        "Transaksi"
    );
    public $hasOne = array();

    function checkPassword() {
        if ($this->data['Anggota']['password'] != $this->data['Anggota']['repeat_password']) {
            return false;
        }
        return true;
    }

    function register() {
        if ($this->hasAny(array("AND" => array("Anggota.email" => $this->data['Anggota']['email'], "Anggota.password" => $this->data['Anggota']['password'])))) {
            return true;
        }
        return false;
    }

    function isActive() {
        $data = $this->find("first", array("conditions" => array("Anggota.email" => $this->data['Anggota']['email']), "recursive" => 1));
        if ($data['RumahTangga']['rumah_tangga_status_id'] == 2) {
            return true;
        }
        return false;
    }

}
