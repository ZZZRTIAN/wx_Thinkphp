<?php
namespace Home\Model;
use Common\extend\Model;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/8
 * Time: 15:17
 */
class UserModel extends Model{
    //关注
    const IS_SUBSCRIBE = 1;
    //未关注
    const IS_NOT_SUBSCRIBE = 0;

    const STATUS_NORMAL = 0;
    const STATUS_FORBIDDEN = 1;

    const SEX_MAN = 1;
    const SEX_WOMAN = 2;
    const SEX_UNKNOWN = 0;
}