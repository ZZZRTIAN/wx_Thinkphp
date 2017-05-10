<?php
namespace Admin\Model;
use Admin\Model\AdminGroupModel;
use Common\extend\Model;
use Common\kit\Kit;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/8
 * Time: 16:11
 */
class AdminUserModel extends Model{

    const IS_FOUNDER = 1;
    const NOT_FOUNDER = 2;

    const STATUS_NORMAL = 0;
    const STATUS_WAITING = 1;
    const STATUS_FORBIDDEN = 2;

    const ENCODE_KEY = '123';
    const ENCODE_TIME_EXPIRE = 3600;

    //登录验证
    public static function auth_user(){
        $account = session('account');

        if (empty($account)){
            return false;
        }

        $auth_code = session('authcode');

        if (empty($auth_code)){
            return false;
        }
        return true;
    }
    //验证用户权限
    public static function getUserPrivilege($user){
        if (empty($user)){
            return array();
        }

        if ($user['is_founder'] == AdminUserModel::IS_FOUNDER){
            return array(AdminUserModel::IS_FOUNDER);
        }
        else{
            $model_admin_group = new AdminGroupModel();
            //先取用户组权限
            $row_admin_group = $model_admin_group->where(['id' => $user['gid']])->find();
            $arr_group_pids = explode(',',$row_admin_group['pids']);
            $arr_user_pids = explode(',',$user['ext_pids'] );
            //整合
            $arr_pids = array_merge($arr_user_pids,$arr_group_pids);
            return array_unique($arr_pids);
        }
    }


    /**
     * 生成盐
     * @return String
     */
    public function create_salt() {
        return Kit::generate_id();
    }



    public function check_password($passwd, $user){
        if ($this->generate_password_md($passwd, $user['salt']) == $user['password']) {
            return true;
        }
        return false;
    }

    public function generate_password_md($passwd, $salt){
        return md5(md5($passwd) . $salt);
    }


    /**
     * 加密
     * @param $username
     * @return string
     */
    static function encode_auth_code($username){
        $ip = Kit::ip();
        $auth_key = md5($ip.self::ENCODE_KEY);
        $agent = $_SERVER['HTTP_USER_AGENT'];

        $check = substr(md5($agent), 8, 8);

        return rawurlencode(Kit::discuzAuthcode("$username\t$check", 'ENCODE', $auth_key, self::ENCODE_TIME_EXPIRE));
    }

    /**
     * 解密
     * @param $username
     * @return string
     */
    static function decode_auth_code($auth_code){

        $ip = Kit::ip();
        $auth_key = md5($ip.self::ENCODE_KEY);
        $agent = $_SERVER['HTTP_USER_AGENT'];

        $s = Kit::discuzAuthcode(rawurldecode($auth_code), 'DECODE', $auth_key, self::ENCODE_TIME_EXPIRE);

        if(empty($s)) {
            return false;
        }

        @list($username, $check) = explode("\t", $s);

        if($check == substr(md5($agent), 8, 8)) {
            return $username;
        }
        else{
            return false;
        }
    }



}