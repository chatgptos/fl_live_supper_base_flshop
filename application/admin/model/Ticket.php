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

    ];
    

    







}
