<?php

namespace app\admin\model\flbooth;

use think\Model;
use traits\model\SoftDelete;

class Attribute extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'flbooth_category_attribute';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
    protected $deleted = 'deleted';

    // 追加属性
    protected $append = [
        'status_text'
    ];
    

    protected static function init()
    {
        self::afterInsert(function ($row) {
            $pk = $row->getPk();
            $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
        });
    }

    
    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }




    public function category()
    {
        return $this->belongsTo('app\admin\model\flbooth\Category', 'category_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
