<?php
namespace app\index\model\flshop;

use think\Model;
use traits\model\SoftDelete;

class GoodsSku extends Model
{

    use SoftDelete;

    

    // 表名
    protected $name = 'booth_goods_sku';
    
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
    
	// 1.0.5升级 注释以下
    // protected static function init()
    // {
    //     self::afterInsert(function ($row) {
    //         $pk = $row->getPk();
    //         $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
    //     });
    // }

    
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




}
