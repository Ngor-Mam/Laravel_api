<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'product_id', 'discount'];

    // ......................search....................
    public static function list($params)
    {
        $list = self::query();

        if (isset($params['search']) && filled($params['search'])) {
            $list->where('title', 'LIKE', '%' . $params['search'] . '%');
        }
        return $list->get();
    }





    public function products()
    {
        return $this->belongsToMany(Product::class, 'discount_products');
    }




    public static function store($request, $id = null)
    {
        $data = $request->only("title", "discount");
        $data = self::updateOrCreate(['id' => $id], $data);
        $data->products()->sync($request->product_id);
        return $data;
    }
}
