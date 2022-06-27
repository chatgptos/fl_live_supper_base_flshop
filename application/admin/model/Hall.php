<?php

namespace app\admin\model;

use think\Model;


class Hall extends Model
{

    

    

    // 表名
    protected $name = 'booth_hall';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'integer';

    // 定义时间戳字段名
    protected $created = 'created';
    protected $modified = 'modified';
    protected $deleted = false;

    // 追加属性
    protected $append = [

    ];
    

    







}
