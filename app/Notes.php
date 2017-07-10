<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\PublicScope;
class Notes extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'notes';
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = true;
    protected $fillable = ['title','content','origin_content','u_id','f_id','isPrivate','type','active'];
//    protected $guarded = ['created_at','updated_at'];

    /**
     * 添加全局条件
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PublicScope);
    }

    /**
     *  是否公开
     * @param $query
     * @param string $type 默认是公开
     * @return mixed
     */
    public function scopeIsPrivate($query, $type = '1')
    {
        return $query->where('isPrivate', $type);
    }
}
