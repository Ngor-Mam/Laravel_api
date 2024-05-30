<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['product_id', 'student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('qty');
    }

    public static function list()
    {
        return self::all();
    }

    public static function store($request, $id = null)
    {
        $data = $request->only('student_id');
        $order = self::updateOrCreate(['id' => $id], $data);
        $products = collect($request->products)->mapWithKeys(function ($product) {
            return [$product['product_id'] => ['qty' => $product['qty']]];
        });
        $order->products()->sync($products);
        return $order;
    }
}
