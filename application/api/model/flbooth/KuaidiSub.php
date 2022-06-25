<?php
namespace app\api\model\flbooth;

use think\Model;

class KuaidiSub extends Model
{
    // 表名
    protected $name = 'booth_kuaidi_sub';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';

}
