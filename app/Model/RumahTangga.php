<?php

class RumahTangga extends AppModel {

    public $validate = array(
    );
    public $belongsTo = array(
        "RumahTanggaStatus"
    );
    public $hasMany = array(
        'Anggota'
    );
    public $hasOne = array(
    );
    
    public $virtualFields=array(
        "nama_kepala_rumah_tangga"=>"select Ang.nama from anggotas as Ang where Ang.rumah_tangga_id=RumahTangga.id and Ang.jenis_anggota_id=1",
    );

    function _add() {
        $this->save();
        return $this->getLastInsertID();
    }

}
