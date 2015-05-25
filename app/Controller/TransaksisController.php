<?php

class TransaksisController extends AppController {

    var $disabledAction = array();

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "Transaksi");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

}
