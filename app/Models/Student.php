<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'age',
        'province',
        'score',
        'phone_number',
    ];





    // .............// Check if or else score in api  resource.....................
    public function getStatusAttribute(){
         if($this->score >=50){
            return 'pass';
         }else{
            return 'fail';
         }
    }


     // .......................................Search Name in api...........................
     public static function list($params)
     {
         $list = self::query();
 
         if (isset($params['search']) && filled($params['search'])) {
             $list->where('name', 'LIKE', '%' . $params['search'] . '%');
         }
         return $list->get();
     }
 





    // public static function list()
    // {
    //     $data = self::all();
    //     return $data;
    // }

    public static function store($request, $id = null)
    {
        $data = $request->only('name', 'age', 'province', 'score', 'phone_number');
        $data = self::updateOrCreate(['id' => $id], $data);
    }
}
