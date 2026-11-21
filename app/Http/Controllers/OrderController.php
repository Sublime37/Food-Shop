<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
           "header" => "Food Store more food",
           "body" => "all product"
        ], 200);
    }

    public function store(OrderRequest $request): JsonResponse
    {
        $order = $request->validated();
        return response()->json([
            "header" => "complete",
            "body" => "Заказ собирается по адресу " . $order["address"],
            "products" => "Вы заказали " . serialize($order["products"]),
            "promocode" => null
        ], 200);
    }
}
