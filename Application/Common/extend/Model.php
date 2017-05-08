<?php
namespace Common\extend;
use Common\kit\Kit;
use Think\Exception;
/**
 * author: speechx-rtzhang
 * Date: 2017/5/8
 * Time: 15:20
 */

class  Model extends  \Think\Model{

    const DB_STATUS_NORMAL = 0;
    const DB_STATUS_DELETED = 4;

    public function locate_by_id($id, $ifLock = false)
    {
        $result = false;

        if (true == $ifLock) {
            // 如果要求锁定记录，那么认为是强制从数据库读取，后继会进行更新操作。
            // 这种情况忽略缓存，直接进行数据库操作。
            // 而由于要求锁定，那么其他进程就应该不能再读取，所以这里先要删除缓存，避免幻读。
            // 如果是多台机器又想实现这个逻辑，就必须使用统一的缓存。
            // 如果使用的是本地缓存，例如文件，那么每台机器都会有自己的缓存副本，那么这个逻辑失效，存在幻读了。
            $this->_remove_data_cache_by_id($id);
            $result = $this->lock(true)->where(['id' => $id])->find();
        } else {
            // 如果未要求锁定记录，那么认为是仅需要获得相关数据。
            // 这种情况若有缓存读缓存，没有缓存则查询并生成缓存。
            $result = $this->lock(false)->cache($this->_get_data_object_cache_key_by_id($id))->where(['id' => $id])->find();
        }

        if (false === $result) {
            throw new Exception('_SELECT_ERROR_' . strtoupper($this->tableName) . '_', -999, ['id' => $id], null);
        }

        return $result;
    }

    protected function _before_insert(&$data, $options = [])
    {
        $data['d_insertms'] = Kit::get_current_time_millis();
        $data['d_insert'] = Kit::get_current_datetime();
        parent::_before_insert($data, $options);
    }

    protected function _before_update(&$data, $options = [])
    {
        $data['d_updatems'] = Kit::get_current_time_millis();
        $data['d_update'] = Kit::get_current_datetime();
        parent::_before_update($data, $options);
    }

    public function cache($key = true, $expire = null, $type = '')
    {
        if (true == $this->_if_cache) {
            return parent::cache($key, $expire, $type);
        }

        return $this;
    }

    private function _get_data_object_cache_key_by_id($id)
    {
        return 'model_' . strtolower($this->name) . '_o_' . $id;
    }

    /**
     * 删除数据对象缓存
     *
     * @param $data
     */
    private function _remove_data_cache_by_id($id)
    {
        return S($this->_get_data_object_cache_key_by_id($id), null);
    }

    /**
     * 更新成功后的回调方法
     *
     * @param $data
     * @param array $options
     */
    protected function _after_update($data, $options = [])
    {
        $this->_remove_data_cache_by_id($options['bind']['id'][0]);
        parent::_after_update($data, $options);
    }

    /**
     * 删除成功后的回调方法
     *
     * @param $data
     * @param array $options
     */
    protected function _after_delete($data, $options = [])
    {
        $this->_remove_data_cache_by_id($options['bind']['id'][0]);
        parent::_after_delete($data, $options);
    }

}