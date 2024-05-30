<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'description'];

// .......................................Search Name in api...........................
    public static function list($params)
    {
        $list = self::query();

        if (isset($params['search']) && filled($params['search'])) {
            $list->where('name', 'LIKE', '%' . $params['search'] . '%');
        }
        return $list->get();
    }
    


    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }
    public static function store($request, $id = null){
        $data = $request->only('name', 'description');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
        
    }
}
