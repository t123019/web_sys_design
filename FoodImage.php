<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FoodImage extends Model
{
  use HasFactory;
  /* Added by gautam Start */
  protected $fillable = [
    'food_name',
    'expiration_date',
    'storage_location',
  ];
    /* Added by gautam End */
}
