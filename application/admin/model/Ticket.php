<?php

namespace app\admin\model;

use think\Model;


class Ticket extends Model
{

    

    

    // 表名
    protected $name = 'booth_ticket';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $created = false;
    protected $modified = false;
    protected $deleted = false;

    // 追加属性
    protected $append = [
        'status_text',
        'apply_time_text',
        'enable_time_text'
    ];
    

    
    public function getStatusList()
    {
        return ['11' => __('Status 11')];
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getApplyTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['apply_time']) ? $data['apply_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getEnableTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['enable_time']) ? $data['enable_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setApplyTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setEnableTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
