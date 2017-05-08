<?php
namespace Admin\Controller;
use Common\kit\Kit;
use Common\kit\Captcha;
use Think\Controller;

/**
 * author: speechx-rtzhang
 * Date: 2017/5/8
 * Time: 16:31
 */
class AuthController extends Controller{

    //初始化函数
    public function _initialize(){

    }

    public function login(){
       if (empty($_POST)){
           return $this->display();
       }
        else{
            $account = I('post.account/s','');
            $password = I('post.password/s','');
            $captcha = I('post.captcha/s','');

            //校验验证码
            if (false === (new Captcha())->check($captcha)){
                $this->assign('account', $account);
                $this->assign('password', $password);
                $this->assign('captcha', '');
                $this->assign('errmsg', '验证码错误');

                return $this->display();
            }
        }
    }
    //定义验证码
    public function captcha(){
        $captcha = new Captcha();
        $captcha->length = 4;
        $captcha->entry();
    }

    public function index(){
        return $this->display();
    }

    public function home(){

    }

    //退出登录
    public function loginout(){
        session('account',null);
        session('authcode',null);
        $this->redirect('login');
    }

    //没有权限
    public function noprivilege() {
        return $this->display();
    }
}