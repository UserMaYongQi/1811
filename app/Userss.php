<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userss extends Model
{
    protected $table = 'userss';
    public  $timestamps=false;
    protected  $primaryKey='u_id';
    //设置允许添加的字段
    protected $fillable = ['users_name','users_file','users_sex']; 
}
