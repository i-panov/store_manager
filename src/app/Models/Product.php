<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property int $price
 *
 * @property Category $category
 * @property Order[] $orders
 */
class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'price'];

    protected $casts = [
        'id' => 'int',
        'category_id' => 'int',
        'price' => 'int',
    ];

    public function category() {
        return $this->hasOne(Category::class, 'category_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'product_id');
    }
}
