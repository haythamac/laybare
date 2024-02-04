<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ApiProductController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $products = Product::paginate($perPage);
        $simulateError = true;

        if (!$products) {
            return $this->handleErrorResponse('Product not found', 404);
        }

        $meta = [
            'total' => $products->total(),
            'count' => $products->count(),
            'per_page' => $products->perPage(),
            'current_page' => $products->currentPage(),
            'total_pages' => $products->lastPage(),
            'links' => [
                'next' => $products->nextPageUrl(),
            ],
        ];

        $data = collect($products->items())->map(function ($item) {
            return [
                'product_id' => $item->id,
                'product_name' => $item->product_name,
                'product_sku' => $item->product_sku,
                'product_category_id' => $item->product_category_id,
                'product_category' => $item->product_category,
                'product_description' => $item->product_description,
            ];
        });

        $response = [
            'status_code' => 200,
            'message' => 'OK',
            'data' => $data,
            'meta' => $meta,
        ];

        return response()->json($response, 200);
    }

    private function handleErrorResponse($message, $statusCode)
    {
        $response = [
            'status_code' => $statusCode,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }
}
