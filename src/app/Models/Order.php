<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property int $product_count
 * @property int $product_price
 * @property OrderStatus $status
 * @property string $customer_name
 * @property string $comment
 *
 * @property Product $product
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'product_count', 'product_price', 'status', 'customer_name', 'comment'];

    protected $casts = [
        'id' => 'int',
        'product_id' => 'int',
        'product_count' => 'int',
        'product_price' => 'int',
        'status' => OrderStatus::class,
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function fullPrice(): int {
        return $this->product_count * $this->product_price / 100;
    }
}
