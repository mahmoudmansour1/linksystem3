<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Category;

class Employee extends Model
{


    public $table = "employees";
    public $fillable = ['name','category_id'];


    public function categories() {
        return $this->belongsTo(Category::class,'category_id');
    }    

}