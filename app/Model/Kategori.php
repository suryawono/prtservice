<?php

class Kategori extends AppModel {

    var $name = 'Kategori';
    var $actsAs = array('Containable');
    var $belongsTo = array(
        'JenisKategori',
    );
    var $hasOne = array(
    );
    var $validate = array(
    );
    var $virtualFields = array(
    );

    function beforeValidate($options = array()) {
        
    }

    function deleteData($id = null) {
        return $this->delete($id);
    }

}

?>
