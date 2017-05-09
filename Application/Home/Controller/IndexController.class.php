<?php
namespace Home\Controller;
use Think\Controller;
use Common\kit\Wechat;
class IndexController extends Controller {
    public function index(){

        $signature = I('get.signature/s', '');//获得小写的 $_GET['']
        $timestamp = I('get.timestamp/s', '');
        $nonce = I('get.nonce/s', '');
        $echostr = I('get.echostr/s', '');

        $options = C('WX_OPTIONS');
        $wc = new Wechat($options);

        $res = $wc->valid();

        if (!$res) {
            return false;
        }

        if (!empty($echostr)) {//验证
            echo $echostr;
        }

        else {//回复

            $result = '';
            $post_str = file_get_contents('php://input');//$GLOBALS["HTTP_RAW_POST_DATA"];

            file_put_contents('debug.log', json_encode($post_str));

            if (empty($post_str)) {
                return false;
            }

            file_put_contents('debug.log', json_encode($post_str));

            $msg = $wc->getRev();
            $msg_type = $msg->getRevType();

            switch ($msg_type) {
                case "text":
                    $result = $wc->text('你好哇~')->reply();
                    break;
                case "image":
                    $result = $wc->image();
                    break;
                case "voice":
                    $result = $wc->voice();
                    break;
                case "video":
                    $result = $wc->video('','','');
                    break;
                case "shortvideo":
                    $result = $wc->video('','','');
                    break;
                case "event":
                    $event = $wc->getRevEvent();
                    if ($event['event'] == 'subscribe') {//Wechat::MSGTYPE_EVENT_SUBSCRIBE) {
                        $result = $wc->text('感谢你的订阅')->reply();
                    }
                    elseif ($event['event'] == 'unsubscribe') {// == Wechat::MSGTYPE_EVENT_UNSUBSCRIBE) {
                        $result = $wc->text('再见亦是朋友')->reply();
                    }
                    elseif ($event['event'] == 'CLICK') {
                        $result = $wc->text('您点击' . $wc->getEventKey())->reply();
                    }
                    else {
                        $result = $wc->text('可能您点击了什么，我们没反馈给您')->reply();
                    }
                    break;
                default:
                    $result = "";
                    break;
            }

            echo $result;
        }

    }

    /**
     * 注册关注用户
     */
    private function register_wx_user ($openid) {

        if (empty($openid)) {
            return false;
        }

        $options = C('WX_OPTIONS');
        $wc = new Wechat($options);
        $user_obj = $wc->getUserInfo($openid);

        if (empty($user_obj)) {
            return false;
        }

        if ($user_obj['subscribe'] == UserModel::IS_NOT_SUBSCRIBE) { //没有订阅
            return false;
        }
        else { //查看是否已经有订阅记录

            $model_user = new UserModel();
            $row_user = $model_user->where(['openid' => $user_obj['openid'], 'd_status' => UserModel::DB_STATUS_NORMAL])->find();

            if (!empty($row_user)) { //如果已经关注了就更新信息

                $data = array();
                $data['subscribe'] = UserModel::IS_SUBSCRIBE;
                $data['openid'] = $user_obj['openid'];
                $data['nickname'] = $user_obj['nickname'];

                $data['sex'] = $user_obj['sex'];
                $data['language'] = $user_obj['language'];
                $data['city'] = $user_obj['city'];
                $data['province'] = $user_obj['province'];

                $data['country'] = $user_obj['country'];
                $data['headimgurl'] = isset($user_obj['headimgurl']) ?  $user_obj['headimgurl'] : '';
                $data['subscribe_time'] = $user_obj['subscribe_time'];
                $data['unionid'] = isset($user_obj['unionid']) ? $user_obj['unionid'] : '';

                $data['remark'] = $user_obj['remark'];
                $data['groupid'] = $user_obj['groupid'];
                $res_update = $model_user->where(['id' => $row_user['id']])->save($data);

                if ($res_update === false || $res_update === 0) {
                    return false;
                }

            }
            else {
                $data = array();
                $data['id'] = Kit::generate_id();
                $data['gid'] = UserGroupModel::ARR_USER_GROUP['WX']['id'];
                $data['subscribe'] = UserModel::IS_SUBSCRIBE;

                $data['openid'] = $user_obj['openid'];
                $data['nickname'] = $user_obj['nickname'];
                $data['sex'] = $user_obj['sex'];
                $data['language'] = $user_obj['language'];

                $data['city'] = $user_obj['city'];
                $data['province'] = $user_obj['province'];
                $data['country'] = $user_obj['country'];
                $data['headimgurl'] = isset($user_obj['headimgurl']) ?  $user_obj['headimgurl'] : '';

                $data['subscribe_time'] = $user_obj['subscribe_time'];
                $data['unionid'] = isset($user_obj['unionid']) ? $user_obj['unionid'] : '';
                $data['remark'] = $user_obj['remark'];
                $data['groupid'] = $user_obj['groupid'];
                $data['add_time'] = Kit::get_current_datetime();

                if (is_array($user_obj['tagid_list'])) {
                    $data['tagid_list'] = implode(',', $user_obj['tagid_list']);
                }

                $data['subscribe_time'] = $user_obj['subscribe_time'];
                $res_add = $model_user->add($data);

                if ($res_add === false || $res_add === 0) {
                    return false;
                }
            }

            return true;
        }

    }

}