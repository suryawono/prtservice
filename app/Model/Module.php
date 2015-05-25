<?php

class Module extends AppModel {

    var $name = 'Module';
    var $actsAs = array('Containable');
    var $belongsTo = array(
    );
    var $hasOne = array(
    );
    var $hasMany = array(
        'ModuleContent'=>array(
            "dependent"=>true
        )
    );
    var $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus diisi'
        ),
        'position' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus dipilih'
        ),
        'class_icon' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus diisi'
        ),
        'ordering_number' => array(
            'rule' => 'notEmpty',
            'message' => 'Harus diisi'
        ),
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
