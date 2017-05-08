<?php
namespace Admin\Controller;

use Think\Controller;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/8
 * Time: 16:10
 */
class AdminHomeController extends Controller{
    public function _initialize()
    {
//        if (!AdminUserModel::auth_user()) {
            $this->redirect(U('admin/auth/login'));
//        }
    }

    public function index() {
        echo  '这里是主页';
        return;
        //return $this->display();
    }
}