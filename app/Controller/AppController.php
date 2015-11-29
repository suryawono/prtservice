<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    var $statusCode = array(
        101 => "Validasi error",
        200 => "Berhasil disimpan",
        201 => "Berhasil dihapus",
        202 => "Login berhasil",
        204 => "Data berhasil dihapus",
        205 => "Status berubah",
        400 => "Data found",
        401 => "Data not found",
        402 => "Login gagal",
        403 => "Invalid request",
        404 => "Akun belum aktif",
        405 => "Invalid parameter",
    );
    var $template = "londium";
    var $pageInfo = array();
    var $disabledAction = array();
    var $paginate = array(
        "limit" => 10,
        "maxLimit" => 5000,
    );
    var $components = array(
        'Session',
        'RequestHandler',
        'Email',
        'Paginator',
        'DebugKit.Toolbar',
    );
    var $helpers = array(
        'Html',
        'Form',
        'Text',
        'Js',
        'Session',
        'Number',
        'JqueryEngine',
    );

    function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        $this->pageInfo = array(
            "index" => array(
                'titlePage' => __("Index"),
                'descriptionPage' => __(""),
            ),
            "add" => array(
                'titlePage' => __("Tambah"),
                'descriptionPage' => __(""),
            ),
            "edit" => array(
                'titlePage' => __("Ubah"),
                'descriptionPage' => __(""),
            ),
            "admin_index" => array(
                'titlePage' => __("Index"),
                'descriptionPage' => __(""),
            ),
            "admin_add" => array(
                'titlePage' => __("Tambah"),
                'descriptionPage' => __(""),
            ),
            "admin_edit" => array(
                'titlePage' => __("Ubah"),
                'descriptionPage' => __(""),
            ),
            "default" => array(
                'titlePage' => __("Selamat Datang"),
                'descriptionPage' => __(""),
            ),
        );
    }

    function _generateStatusCode($id, $message = null, $data = array()) {
        if (is_null($message)) {
            return array("status" => $id, "message" => $this->statusCode[$id], 'data' => $data);
        } else {
            return array("status" => $id, "message" => $message, 'data' => $data);
        }
    }

    function beforeFilter() {
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->__checkPremission();
        if (!$this->request->is('ajax')) {
            $this->set('leftSideMenuData', $this->_createLeftMenu());
        }
        if (in_array($this->params['action'], $this->disabledAction)) {
            $this->_404();
        }
    }

    function beforeRender() {
        Configure::write("template", $this->template);
        Configure::write("frontTemplate", $this->frontTemplate);
        if (isset($this->jump) && $this->jump) {
            
        } else {
            global $URL, $ACTION_URL;

            if (isset($this->cetak)) {
                $this->layout = "cetak/" . $this->cetak;
            } else if ($this->params['admin']) {
                $this->layout = _TEMPLATE_DIR . "/{$this->template}/default";
            } else if ($this->params['front'] || $this->params['member']) {
                $this->layout = _FRONT_TEMPLATE_DIR . "/{$this->frontTemplate}/default";
            }
            if ($this->request->is('ajax')) {
                $this->layout = 'ajax';
            }
            //For breadcrumb system
            $bcSuggestion = array();
            $breadcrumb = ClassRegistry::init("ModuleContent")->find("first", array("conditions" => array("ModuleContent.alias" => $this->request->url)));
            if (!empty($breadcrumb)) {
                $bcSuggestion[] = array(
                    "label" => $breadcrumb['ModuleContent']['name'],
                    "alias" => $breadcrumb['ModuleContent']['alias'],
                );
                while (!is_null($breadcrumb['Parent']['id'])) {
                    $breadcrumb = ClassRegistry::init("ModuleContent")->find("first", array("conditions" => array("ModuleContent.id" => $breadcrumb['Parent']['id'])));
                    $bcSuggestion[] = array(
                        "label" => $breadcrumb['ModuleContent']['name'],
                        "alias" => $breadcrumb['ModuleContent']['alias'],
                    );
                }
                $bcSuggestion[] = array(
                    "label" => $breadcrumb['Module']['name'],
                    "alias" => $breadcrumb['Module']['alias'],
                    "icon" => $breadcrumb['Module']['class_icon'],
                );
            } else {
                $breadcrumb = ClassRegistry::init("Module")->find("first", array("conditions" => array("Module.alias" => $this->request->url)));
                if (!empty($breadcrumb)) {
                    $bcSuggestion[] = array(
                        "label" => $breadcrumb['Module']['name'],
                        "alias" => $breadcrumb['Module']['alias'],
                        "icon" => $breadcrumb['Module']['class_icon'],
                    );
                }
            }
            //end of breadcrumb system
            //For pageInfo system
            $pageInfo = isset($this->pageInfo[$this->params['action']]) ? $this->pageInfo[$this->params['action']] : $this->pageInfo["default"];
            //end of pageInfo system

            $template = $this->template;
            $frontTemplate = $this->frontTemplate;
            $controller = Inflector::camelize($this->params['controller']);
            $action = $this->params['action'];
            $URL = $url = trim(preg_replace('/limit:[0-9]*/', '', preg_replace('/page:[0-9]*/', '', $this->request->url, 1), 1), "/");
            $ACTION_URL = "{$this->params['prefix']}/{$controller}/{$this->_pureAction()}";
            $this->set(compact('bcSuggestion', 'template', 'frontTemplate', 'controller', 'action', 'url', 'pageInfo'));
        }
    }

    function __checkPremission() {
        $credential = $this->Session->read("credential.{$this->params['prefix']}");
        if ($this->params['prefix'] == "front") {
            
        } else if (!empty($this->params['prefix']) && empty($credential)) {
            if ($this->params['prefix'] == "member") {
                $this->redirect('/', 401);
            } else {
                $this->redirect('/' . $this->params['prefix'], 401);
            }
        }
        //for different role (admin)
        if ($this->params['prefix'] == "admin") {
            $mc = ClassRegistry::init("ModuleContent")->find("first", array("conditions" => array("ModuleContent.alias" => $this->request->url)));
            if (!empty($mc)) {
                $is_in_role = ClassRegistry::init("Role")->hasAny(array("Role.user_group_id" => $this->Session->read("credential.admin.User.user_group_id"), "Role.module_id" => $mc['Module']['id']));
                if (!$is_in_role) {
                    $this->_404();
                }
            } else {
                $c = ClassRegistry::init("Module")->find("first", array("conditions" => array("Module.alias" => $this->request->url)));
                if (!empty($c)) {
                    $is_in_role = ClassRegistry::init("Role")->hasAny(array("Role.user_group_id" => $this->Session->read("credential.admin.User.user_group_id"), "Role.module_id" => $c['Module']['id']));
                    if (!$is_in_role) {
                        $this->_404();
                    }
                }
            }
        }
    }

    function _createLeftMenu() {
        $cond = array(
            'Role.user_group_id' => $this->Session->read("credential.admin.User.user_group_id"),
            'Role.modulePosition' => 'Left',
            'Module.name != ' => 'Setting'
        );
        $getRoleData = ClassRegistry::init('Role')->find('all', array(
            'recursive' => 2,
            'conditions' => $cond,
            'order' => array('Role.moduleOrder' => 'ASC'),
            'group' => array('Role.module_id')
        ));
        $roleData = array();

        foreach ($getRoleData as $role) {
            $box = array(
                "label" => $role['Module']['name'],
                "icon" => $role['Module']['class_icon'],
                "alias" => $role['Module']['alias'],
                "content" => array(),
            );
            $submenu = ClassRegistry::init('ModuleContent')->find("all", array("conditions" => array("ModuleContent.module_id" => $role['Module']['id'], "OR" => array("ModuleContent.parent_id is null", "ModuleContent.parent_id" => 0))));
            foreach ($submenu as $mc) {
                $box['content'][] = array(
                    "label" => $mc['ModuleContent']['name'],
                    "alias" => $mc['ModuleContent']['alias'],
                    "content" => $this->_subMenu($mc),
                );
            }
            $roleData[] = $box;
        }
        return $roleData;
    }

    function _subMenu($parent) {
        $result = array();
        $menu = ClassRegistry::init('ModuleContent')->find("all", array("conditions" => array("ModuleContent.parent_id" => $parent['ModuleContent']['id'])));
        if (!empty($menu)) {
            foreach ($menu as $subMenu) {
                $result[] = array(
                    'label' => $subMenu['ModuleContent']['name'],
                    'alias' => $subMenu['ModuleContent']['alias'],
                    'content' => $this->_subMenu($subMenu),
                );
            }
        }
        return $result;
    }

    function _filter($get) {
        $paramCond = 'or';
        $cond = array();
        foreach ($get as $k => $v) {
            $key = preg_replace('/_/', '.', $k, 1);
            if (substr_count($key, 'select') == 1) {
                $key = preg_replace('/select./', '', $key, 1);
                $key = preg_replace('/_/', '.', $key, 1);
                if (!empty($v)) {
                    $cond[$paramCond][$key] = $v;
                }
            } elseif (substr_count($key, 'awal') == 1) {
                $key = preg_replace('/awal\./', '', $key, 1);
                $key = preg_replace('/_/', '.', $key, 1);
                if (!empty($v)) {
                    $cond[$paramCond]['DATE(' . $key . ') >= '] = $v;
                }
            } else if (substr_count($key, 'akhir') == 1) {
                $key = preg_replace('/akhir\./', '', $key, 1);
                $key = preg_replace('/_/', '.', $key, 1);
                if (!empty($v)) {
                    $cond[$paramCond]['DATE(' . $key . ') <= '] = $v;
                }
            } else {
                if (!empty($v)) {
                    $cond[$paramCond][$key . ' LIKE '] = '%' . $v . '%';
                }
            }
        }
        return $cond;
    }

    function _pureAction() {
        return ltrim(ltrim($this->params['action'], "/{$this->params['prefix']}/"), "_");
    }

    public function index() {
        $data = $this->{ Inflector::classify($this->name) }->find('all');
        $response = $this->_generateStatusCode(400, null, $data);
        $this->set(array(
            'response' => $response,
            '_serialize' => array('response')
        ));
    }

    public function view($id) {
        $data = $this->{ Inflector::classify($this->name) }->findById($id);
        if (empty($data)) {
            $response = $this->_generateStatusCode(401, null, $data);
        } else {
            $response = $this->_generateStatusCode(400, null, $data);
        }
        $this->set(array(
            'response' => $response,
            '_serialize' => array('response')
        ));
    }

    public function add() {
        $this->data = $this->request->data;
        $this->{ Inflector::classify($this->name) }->set($this->data);
        if ($this->{ Inflector::classify($this->name) }->validates()) {
            $this->{ Inflector::classify($this->name) }->save();
            $response = $this->_generateStatusCode(200, null, $this->data);
        } else {
            $response = $this->_generateStatusCode(101, null, array("errors" => $this->{ Inflector::classify($this->name) }->validationErrors));
        }
        $this->set(array(
            'response' => $response,
            '_serialize' => array('response')
        ));
    }

    public function edit($id) {
        $this->{ Inflector::classify($this->name) }->id = $id;
        $this->{ Inflector::classify($this->name) }->set($this->request->data);
        if ($this->{ Inflector::classify($this->name) }->save()) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function delete($id) {
        if ($this->Recipe->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    //Start Main Basic CRUD Engine
    function _setPageInfo($action = null, $titlePage = "", $descriptionPage = "") {
        $this->pageInfo[$action] = array(
            'titlePage' => __($titlePage),
            'descriptionPage' => __($descriptionPage),
        );
    }

    function admin_index() {
        $conds = $this->_filter($_GET);
        $conds['AND'] = am($conds, array(
        ));
        $this->Paginator->settings = array(
            Inflector::classify($this->name) => array(
                'conditions' => $conds,
                'limit' => $this->paginate['limit'],
                'maxLimit' => $this->paginate['maxLimit'],
                'order' => Inflector::classify($this->name) . '.created desc',
            )
        );
        $rows = $this->Paginator->paginate($this->{ Inflector::classify($this->name) });
        $data = array(
            'rows' => $rows,
        );
        $this->set(compact('data'));
        $args = func_get_args();
        if (isset($args[0])) {
            $jenis = $args[0];
            $this->cetak = $jenis;
            $this->render($jenis);
        }
    }

    function admin_add() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->validates()) {
                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('deep' => true));
                $this->Session->setFlash(__("Data berhasil disimpan"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
            }
        }
    }

    function admin_edit($id = null) {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            if ($this->{ Inflector::classify($this->name) }->validates()) {
                if (!is_null($id)) {
                    $this->{ Inflector::classify($this->name) }->id = $id;
                    $this->{ Inflector::classify($this->name) }->save();
                    $this->Session->setFlash(__("Data berhasil diubah"), 'default', array(), 'success');
                    $this->redirect(array('action' => 'admin_index'));
                } else {
                    
                }
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
            }
        } else {
            $rows = $this->{ Inflector::classify($this->name) }->find("first", array('conditions' => array(Inflector::classify($this->name) . ".id" => $id)));
            $this->data = $rows;
        }
    }

    function admin_multiple_delete() {
        $this->{ Inflector::classify($this->name) }->set($this->data);
        if (empty($this->data)) {
            $code = 203;
        } else {
            $allData = $this->data[Inflector::classify($this->name)]['checkbox'];
            foreach ($allData as $data) {
                if ($data != '' || $data != 0) {
                    $this->{ Inflector::classify($this->name) }->delete($data, true);
                }
            }
            $code = 204;
        }
        echo json_encode($this->_generateStatusCode($code));
        die();
    }

    function admin_delete($id = null) {
        if ($this->request->is("delete")) {
            if ($this->{ Inflector::classify($this->name) }->delete($id)) {
                $code = 204;
            } else {
                $code = 401;
            }
        } else {
            $code = 400;
        }
        echo json_encode($this->_generateStatusCode($code));
        die();
    }

    //End Main Basic CRUD Engine
    function _404() {
        die();
    }

}
