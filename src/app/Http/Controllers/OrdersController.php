<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders/index', [
            'orders' => Order::paginate(10),
        ]);
    }

    public function create()
    {
        return view('orders/form', [
            'products' => Product::select(['id', 'name'])->get()
                ->pluck('name', 'id')->toArray(),
        ]);
    }

    public function store(SaveOrderRequest $request)
    {
        $data = $request->validated();
        $data['status'] = OrderStatus::NEW;
        $data['product_price'] = Product::findOrFail($data['product_id'])->price;
        Order::create($data);
        return redirect()->route('orders.index')->with('success', 'Заказ добавлен.');
    }

    public function show($id)
    {
        return view('orders/view', [
            'order' => Order::findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        return view('orders/form', [
            'order' => Order::findOrFail($id),
        ]);
    }

    public function update(SaveOrderRequest $request, $id)
    {
        Order::findOrFail($id)->update($request->validated());
        return redirect()->route('orders.index')->with('success', 'Заказ обновлен.');
    }

    public function complete($id)
    {
        Order::findOrFail($id)->update(['status' => OrderStatus::COMPLETED]);
        return redirect()->route('orders.index')->with('success', 'Заказ завершен.');
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('orders.index')->with('success', 'Заказ удален.');
    }
}
