<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hold extends Model
{
    protected $table = 'hold'; 
    protected $primaryKey='hold_id';
    public $timestamps=false;
    protected $fillable=['hold_name','hold_url','hold_file','hold_show'];
}

