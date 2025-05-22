<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 *
 * @property-read Product[] $products
 */
class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    protected $casts = [
        'id' => 'int',
    ];

    public function products() {
        return $this->hasMany(Product::class, 'category_id');
    }
}
