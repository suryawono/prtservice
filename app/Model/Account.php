<?php

class Account extends AppModel {

    public $belongsTo = array(
        'User' => array(
            'dependent' => true
        ),
    );

}
