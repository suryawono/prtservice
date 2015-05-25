<?php

class Transaksi extends AppModel {

    public $actsAs = array('Containable');
    public $validate = array(
    );
    public $belongsTo = array(
        "Kategori",
    );
    public $hasMany = array(
    );
    public $hasOne = array();

}
