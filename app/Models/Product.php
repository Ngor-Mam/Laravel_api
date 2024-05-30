<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name','category_id', 'description'];


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
  

    // ..................search................
    public static function list($params)
    {
        $list = self::query();

        if (isset($params['search']) && filled($params['search'])) {
            $list->where('name', 'LIKE', '%' . $params['search'] . '%');
        }
        return $list->get();
    }



    // public static function list(){
    //     return self::all();
    // }

    public static function create($request, $id = null){
        $data = $request->only('name', 'category_id', 'description');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
        
    }

}
