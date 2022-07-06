<?php
namespace app\admin\model\flshop;

use think\Model;
use traits\model\SoftDelete;

class FindUser extends Model
{

    use SoftDelete;
    

    // 表名
    protected $name = 'flbooth_find_user';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
    protected $deleted = 'deleted';
}
