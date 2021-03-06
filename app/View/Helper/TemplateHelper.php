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
class TemplateHelper extends HtmlHelper {

    var $src = array(
        "londium" => array(
            "js" => array(
                "jquery.min.js",
                "jquery-ui.min.js",
                "plugins/charts/sparkline.min.js",
                "plugins/forms/uniform.min.js",
                "plugins/forms/select2.min.js",
                "plugins/forms/inputmask.js",
                "plugins/forms/autosize.js",
                "plugins/forms/inputlimit.min.js",
                "plugins/forms/listbox.js",
                "plugins/forms/multiselect.js",
                "plugins/forms/validate.min.js",
                "plugins/forms/tags.min.js",
                "plugins/forms/switch.min.js",
                "plugins/forms/uploader/plupload.full.min.js",
                "plugins/forms/uploader/plupload.queue.min.js",
                "plugins/forms/wysihtml5/wysihtml5.min.js",
                "plugins/forms/wysihtml5/toolbar.js",
                "plugins/interface/daterangepicker.js",
                "plugins/interface/fancybox.min.js",
                "plugins/interface/moment.js",
                "plugins/interface/jgrowl.min.js",
                "plugins/interface/datatables.min.js",
                "plugins/interface/colorpicker.js",
                "plugins/interface/fullcalendar.min.js",
                "plugins/interface/timepicker.min.js",
                "plugins/interface/collapsible.min.js",
                "bootstrap.min.js",
                "application.js",
                "custom-functions.js",
            ),
            "css" => array(
                "bootstrap.min.css",
                "londinium-theme.css",
                "styles.css",
                "icons.css",
                "app.css",
            ),
            "custom" => array(
//				array(
//					"url"=>"http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js",
//					"type"=>"js",
//				),
                array(
                    "url" => "https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext",
                    "type" => "css",
                ),
            ),
            "content" => ".page-content",
        ),
    );
    var $jsDefault = array(
        "app.js",
        "plugin/mustache.js",
        "plugin/jquery.number.min",
        "plugin/jquery.datetimepicker.js",//http://xdsoft.net/jqplugins/datetimepicker/
    );
    var $cssDefault = array(
        "jquery.datetimepicker.css",
    );

    function import($exception = array()) {
        global $URL, $ACTION_URL;
        $name = Configure::read("template");
        if (!is_null($name) || isset($this->src[$name])) {
            foreach ($this->src[$name]['custom'] as $item) {
                switch ($item['type']) {
                    case "js":
                        if (!in_array($item['url'], $exception)) {
                            echo $this->script($item['url']);
                        }
                        break;
                    case "css":
                        if (!in_array($item['url'], $exception)) {
                            echo $this->css($item['url']);
                        }
                        break;
                }
            }
            foreach ($this->src[$name]['css'] as $css) {
                if (!in_array($css, $exception)) {
                    echo $this->css("/" . _TEMPLATE_DIR . "/{$name}/css/{$css}");
                }
            }
            foreach ($this->src[$name]['js'] as $js) {
                if (!in_array($js, $exception)) {
                    echo $this->script("/" . _TEMPLATE_DIR . "/{$name}/js/{$js}");
                }
            }
            foreach ($this->jsDefault as $js) {
                if (!in_array($js, $exception)) {
                    echo $this->script("/js/{$js}");
                }
            }
            foreach ($this->cssDefault as $css) {
                if (!in_array($css, $exception)) {
                    echo $this->css("/css/{$css}");
                }
            }
            echo "<script> var BASE_URL='" . Router::url("/", true) . "'; var CONTENT_SELECTOR = '{$this->src[$name]['content']}';var URL='{$URL}';var ACTION_URL='{$ACTION_URL}';var PREFIX='{$this->params['prefix']}';var CONTROLLER='{$this->params['controller']}';var TEMPLATE='{$name}'</script>";
        } else {
            die("Invalid template");
        }
    }

    function img($url = null, array $options = array()) {
        $name = Configure::read("template");
        echo $this->image(Router::url("/", true) . _TEMPLATE_DIR . "/$name/$url", $options);
    }

}
