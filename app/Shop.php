<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	//设置数据库表名
    protected $table = 'shop'; 
    //关闭自动写入时间戳
    public $timestamps = false; 
    //设置主键
    protected $primaryKey='brand_id';
    //设置允许添加的字段
    // protected $fillable = ['brand_name','brand_logo','brand_url','brand_desc','created_at']; 
}
