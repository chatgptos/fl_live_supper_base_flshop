<?php

namespace app\api\model\flbooth;

use think\Model;


class Collect extends Model
{

    

    

    // 表名
    protected $name = 'booth_user_collect';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $created = false;
    protected $modified = false;
    protected $deleted = false;

    // 追加属性
    protected $append = [
        'add_time_text'
    ];
    

    



    public function getAddTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['add_time']) ? $data['add_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setAddTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }



    public function getSkuAttr($value)
    {
        return json_decode($value, true);
    }

    public function getCheckedAttr($value)
    {
        return $value == 0 ? false : true;
    }

    public function setCheckedAttr($value)
    {
        return $value ? 1 : 0;
    }

    public function setSkuAttr($value)
    {
        return json_encode($value);
    }

    public function shop()
    {
        return $this->belongsTo('app\api\model\flbooth\Shop', 'exhibitor_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    // 商品 1.0.2升级
    public function goods()
    {
        return $this->belongsTo('app\api\model\flbooth\Goods', 'goods_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }



    // 商品 1.0.2升级
    public function Topic()
    {
        return $this->belongsTo('app\admin\model\Topic', 'activity_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
    // 商品 1.0.2升级
    public function activity()
    {
        return $this->belongsTo('app\admin\model\Activity', 'activity_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }


}
