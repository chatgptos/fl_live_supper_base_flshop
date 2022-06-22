<?php
namespace app\admin\model\wanlshop;

use think\Model;
use traits\model\SoftDelete;

class Find extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'wanlshop_find';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'type_text',
        'state_text'
    ];
    

    
    public function getTypeList()
    {
        return ['new' => __('Type new'), 'live' => __('Type live'), 'video' => __('Type video'), 'want' => __('Type want'), 'show' => __('Type show'), 'activity' => __('Type activity')];
    }

    public function getStateList()
    {
        return ['publish' => __('State publish'), 'examine' => __('State examine'), 'hazard' => __('State hazard'), 'transcoding' => __('State transcoding'), 'screenshot' => __('State screenshot'), 'normal' => __('State normal')];
    }


    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['state']) ? $data['state'] : '');
        $list = $this->getStateList();
        return isset($list[$value]) ? $list[$value] : '';
    }




    public function user()
    {
        return $this->belongsTo('app\admin\model\User', 'user_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
