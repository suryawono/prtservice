<?php

/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

    function Rp($Rp) {
        if ($Rp == "") {
            return "Rp. 0";
        }
        return "Rp. " . number_format($Rp, 0, "", ".") . ",-";
    }

    function cvtTanggal($date = null) {
        if (!empty($date)) {
            $tgl = date("d", strtotime($date));
            $bulan = $this->getNamaBulan(date("m", strtotime($date)));
            $tahun = date("Y", strtotime($date));
        } else {
            $tgl = date("d");
            $bulan = $this->getNamaBulan(date("m"));
            $tahun = date("Y");
        }
        return "$tgl $bulan $tahun";
    }

    function cvtHariTanggal($date = null) {
        if (!empty($date)) {
            $tgl = date("d", strtotime($date));
            $bulan = $this->getNamaBulan(date("m", strtotime($date)));
            $tahun = date("Y", strtotime($date));
            $hari = $this->hari[date("w", strtotime($date))];
        } else {
            $tgl = date("d");
            $bulan = $this->getNamaBulan(date("m"));
            $tahun = date("Y");
            $hari = $this->hari[date("w")];
        }
        return "$hari, $tgl $bulan $tahun";
    }

    function cvtWaktu($date = null) {
        if (!empty($date)) {
            $tgl = date("d", strtotime($date));
            $bulan = $this->getNamaBulan(date("m", strtotime($date)));
            $tahun = date("Y", strtotime($date));
            $jam = date("H", strtotime($date));
            $menit = date("i", strtotime($date));
        } else {
            $tgl = date("d");
            $bulan = $this->getNamaBulan(date("m"));
            $tahun = date("Y");
            $jam = date("H");
            $menit = date("i");
        }
        return "$tgl $bulan $tahun - $jam:$menit";
    }

    function getTanggal($date = null) {
        if (!empty($date)) {
            $tgl = date("d", strtotime($date));
        } else {
            $tgl = date("d");
        }
        return "$tgl";
    }

    function getBulan($date = null) {
        if (!empty($date)) {
            $bulan = $this->getNamaBulan(date("m", strtotime($date)));
        } else {
            $bulan = $this->getNamaBulan(date("m"));
        }
        return $bulan;
    }

    function getNamaBulan($i = null) {
        if ($i == 1) {
            $monthName = 'Januari';
        } elseif ($i == 2) {
            $monthName = 'Februari';
        } elseif ($i == 3) {
            $monthName = 'Maret';
        } elseif ($i == 4) {
            $monthName = 'April';
        } elseif ($i == 5) {
            $monthName = 'Mei';
        } elseif ($i == 6) {
            $monthName = 'Juni';
        } elseif ($i == 7) {
            $monthName = 'Juli';
        } elseif ($i == 8) {
            $monthName = 'Agustus';
        } elseif ($i == 9) {
            $monthName = 'September';
        } elseif ($i == 10) {
            $monthName = 'Oktober';
        } elseif ($i == 11) {
            $monthName = 'Nopember';
        } else {
            $monthName = 'Desember';
        }
        return $monthName;
    }

    function println($string = false) {
        if ($string === false) {
            return "<br/>";
        } else if (empty($string)) {
            return "";
        } else {
            return "$string<br/>";
        }
    }

    function changeStatusSelect($id,$options = array(), $default = null, $url = "", $empty = "") {
        $result = "<select onchange=changeStatus($id,$(this).val(),'$url')>";
        foreach ($options as $k => $v) {
            if ($k == $default) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $result.="<option value='$k' $selected>{$v}</option>";
        }
        return $result . "</select>";
    }

}
