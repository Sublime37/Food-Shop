<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class OrderController extends Controller
{
     public function index(Request $request): JsonResponse{
        return response()->json([
            "header" => "Food Store more food",
            "body" => "all product"
        ], 200);
    }

    public function create(OrderRequest $request): JsonResponse{
        $order = $request->validated();
        return response()->json([
            "header" => "complete",
            "body" => "Заказ собирается по адресу " . $order["address"],
            "products" => "Вы заказали " . implode( ',' , (array) $order["id_products"]),
            "promocode" => "Промокод допишем"
        ], 200);
    }
}
