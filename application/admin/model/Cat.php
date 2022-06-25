<?php

namespace app\admin\model;

use think\Model;


class Cat extends Model
{

    

    

    // 表名
    protected $name = 'booth_article_cat';
    
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
