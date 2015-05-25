<?php

class User extends AppModel {

    public $validate = array(
        'username' => array(
            'Hasur diisi'=>array("rule"=>"notEmpty"),
            'Sudah terdaftar' => array("rule" => 'isUnique'),
            'Hanya alphanumeric' => array("rule" => 'alphaNumeric'),
        ),
        'password' => array(
            'rule' => 'notEmpty',
            'message' => 'Hasur diisi'
        ),
        'repeat_password' => array(
            'rule1' => array(
                'rule' => 'checkPassword',
                'message' => 'Kata sandi tidak sama'
            ),
            'rule2' => array(
                'rule' => 'notEmpty',
                'message' => 'Hasur diisi'
            )
        ),
        'email' => array(
            'Harus diisi' => array("rule" => 'notEmpty'),
            'Sudah terdaftar' => array("rule" => 'isUnique'),
        )
    );
    public $belongsTo = array(
        'UserGroup'
    );
    public $hasMany = array(
        'ShippingAddress'
    );
    public $hasOne = array(
        "Account",
    );

    function checkPassword() {
        if ($this->data['User']['password'] != $this->data['User']['repeat_password']) {
            return false;
        }
        return true;
    }

}
