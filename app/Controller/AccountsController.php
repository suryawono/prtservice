<?php

class AccountsController extends AppController {

    var $disabledAction = array();

    function beforeFilter() {
        parent::beforeFilter();
        $this->_setPageInfo("admin_index", "");
        $this->_setPageInfo("admin_add", "");
        $this->_setPageInfo("admin_edit", "");
    }

    function admin_add() {
        if ($this->request->is("post")) {
            $this->{ Inflector::classify($this->name) }->set($this->data);
            $password = $this->{ Inflector::classify($this->name) }->data["User"]["password"];
            $salt = hash("sha224", uniqid(mt_rand(), true), false);
            $encrypt = hash("sha512", $password . $salt, false);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only'))) {
                $this->{ Inflector::classify($this->name) }->data["User"]["password"] = $encrypt;
                $this->{ Inflector::classify($this->name) }->data["User"]["salt"] = $salt;
                unset($this->{ Inflector::classify($this->name) }->data["User"]["repeatPassword"]);
                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data);
                $this->Session->setFlash(__("Data berhasil disimpan"), 'default', array(), 'success');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
            }
        }
        $this->set("accountStatuses", $this->{ Inflector::classify($this->name) }->AccountStatus->find("list", array("fields" => array("AccountStatus.id", "AccountStatus.name"))));
        $this->set("identityTypes", $this->{ Inflector::classify($this->name) }->Biodata->IdentityType->find("list", array("fields" => array("IdentityType.id", "IdentityType.name"))));
        $this->set("genders", $this->{ Inflector::classify($this->name) }->Biodata->Gender->find("list", array("fields" => array("Gender.id", "Gender.name"))));
        $this->set("countries", $this->{ Inflector::classify($this->name) }->Biodata->Country->find("list", array("fields" => array("Country.id", "Country.name"))));
        $this->set("states", $this->{ Inflector::classify($this->name) }->Biodata->State->find("list", array("fields" => array("State.id", "State.name"))));
    }

    function register() {
        if ($this->request->is("post")) {
            $this->Session->delete('redirect.register');
            $this->{ Inflector::classify($this->name) }->set($this->data);
            $password = $this->{ Inflector::classify($this->name) }->data["User"]["password"];
            $salt = hash("sha224", uniqid(mt_rand(), true), false);
            $encrypt = hash("sha512", $password . $salt, false);
            if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only'))) {
                $this->{ Inflector::classify($this->name) }->data["User"]["password"] = $encrypt;
                $this->{ Inflector::classify($this->name) }->data["User"]["salt"] = $salt;
                $this->{ Inflector::classify($this->name) }->data["Account"]["account_status_id"] = 2;
                $this->{ Inflector::classify($this->name) }->data["User"]["user_group_id"] = 2;
                unset($this->{ Inflector::classify($this->name) }->data["User"]["repeat_password"]);
                $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data);
                $lastId = $this->{ Inflector::classify($this->name) }->getLastInsertID();
                $this->_add_shipping_address($lastId);
                $this->Session->setFlash(__("Pendaftaran berhasil"), 'default', array(), 'success');
                $this->redirect('/register');
            } else {
                $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                $this->Session->write("redirect.register", array("validationErrors" => $this->validationErrors, "data" => $this->data));
                $this->Session->setFlash(__("Mohon mengecek kembali data dibawah"), 'default', array(), 'danger');
                $this->redirect('/register');
            }
        } else {
            echo json_encode($this->_generateStatusCode(400));
        }
    }

    function login_admin() {
        if (!empty($this->Session->read("credential.admin"))) {
            $this->redirect("/admin/dashboard");
        }
        if ($this->request->is("post")) {
            $data = $this->{ Inflector::classify($this->name) }->find("first", array("conditions" => array("OR" => array("User.email" => $this->data['Account']['username'], "User.username" => $this->data['Account']['username']), "User.user_group_id" => 1)));
            if (!empty($data)) {
                if ($this->_testPassword($this->data['Account']['password'], $data['User']['salt'], $data['User']['password'])) {
                    $this->Session->write("credential.admin", $data);
                    $this->redirect("/admin/dashboard");
                } else {
                    $this->Session->setFlash(__("Username/password invalid"), 'default', array(), 'danger');
                }
            } else {
                $this->Session->setFlash(__("Username/password invalid"), 'default', array(), 'danger');
            }
        }
        $this->layout = _TEMPLATE_DIR . "/{$this->template}/login";
    }

    function logout_admin() {
        $this->Session->delete("credential.admin");
        $this->redirect("/admin");
    }

    function _hashPassword($plain) {
        $hashed = hash("sha512", $plain, false);
        return $hashed;
    }

    function _testPassword($password, $salt, $hashedPassword) {
        return $hashedPassword == $this->_hashPassword($password . $salt);
    }

    function admin_change_password() {
        if ($this->request->is("post")) {
            if ($this->_testPassword($this->data['Account']['password_lama'], $this->Session->read("credential.admin.User.salt"), $this->Session->read("credential.admin.User.password"))) {
                $this->{ Inflector::classify($this->name) }->data = $this->data;
                unset($this->{ Inflector::classify($this->name) }->data['Account']['password_lama']);
                $password = $this->{ Inflector::classify($this->name) }->data["User"]["password"];
                $salt = hash("sha224", uniqid(mt_rand(), true), false);
                $encrypt = $this->_hashPassword($password . $salt);
                if ($this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data, array('validate' => 'only'))) {
                    $this->{ Inflector::classify($this->name) }->data["User"]["password"] = $encrypt;
                    $this->{ Inflector::classify($this->name) }->data["User"]["salt"] = $salt;
                    unset($this->{ Inflector::classify($this->name) }->data["User"]["repeat_password"]);
                    $this->{ Inflector::classify($this->name) }->data["User"]["id"] = $this->Session->read("credential.admin.User.id");
                    $this->{ Inflector::classify($this->name) }->saveAll($this->{ Inflector::classify($this->name) }->data);
                    $this->_update_admin_session();
                    $this->Session->setFlash(__("Password berhasil diganti"), 'default', array(), 'success');
                } else {
                    $this->validationErrors = $this->{ Inflector::classify($this->name) }->validationErrors;
                    $this->Session->setFlash(__("Harap mengecek kembali kesalahan dibawah."), 'default', array(), 'danger');
                }
            } else {
                $this->Session->setFlash(__("Password lama salah"), 'default', array(), 'danger');
            }
        }
    }

    function _update_admin_session() {
        $data = $this->{ Inflector::classify($this->name) }->find("first", array("conditions" => array("Account.id" => $this->Session->read("credential.admin.Account.id"))));
        $this->Session->write("credential.admin", $data);
    }

    function send_activation() {
        $this->autoRender = false;
        $data = $this->{ Inflector::classify($this->name) }->find("all", array("conditions" => array("Account.account_status_id" => 2)));
        $info = array(
            "tujuan" => array("ini_tommy@live.com", "suryawono@yahoo.co.id", "tommylie885@gmail.com"),
            "acc" => "Activation",
            "item" => array("Account" => $data),
        );
        $this->_sentEmail("activation", $info);
    }

    function send_forgot_password() {
        $this->autoRender = false;
        $data = $this->{ Inflector::classify($this->name) }->find("all");
        $info = array(
            "tujuan" => array("ini_tommy@live.com", "suryawono@yahoo.co.id", "tommylie885@gmail.com"),
            "acc" => "Account",
            "item" => array("ForgotPassword" => $data),
        );
        $this->_sentEmail("forgot-password", $info);
    }

    function admin_dashboard(){
        
    }
}
