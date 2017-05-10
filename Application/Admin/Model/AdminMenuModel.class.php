<?php

namespace Admin\Model;
use Common\extend\Model;
use Home\Model\AdminUserModel;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/9
 * Time: 14:11
 */
Class AdminMenuModel extends Model{

    const LEVEL_ONE = 1;
    const LEVEL_TWO = 2;

    const IS_SHOW = 1;
    const UN_SHOW = 0;

    public static function getUserMenu($privilege){
        if (empty($privilege)){
            return array();
        }
        $model_admin_menu = new AdminMenuModel();
        //超级管理员,带有所有的菜单
        if ($privilege[0] == AdminUserModel::IS_FOUNDER){
            
        }
    }





}