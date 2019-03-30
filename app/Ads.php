<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ads extends Model
{
    //软删除
    use SoftDeletes;
    public $timestamps = false;
    protected $primaryKey="ads_id";
    //protected $table = 'ads';
    //软删除
    //protected $dates=['deleted_at'];
    protected $dates= ['deleted_at'];


}
