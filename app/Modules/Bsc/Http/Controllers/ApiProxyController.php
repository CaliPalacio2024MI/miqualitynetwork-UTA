<?php

namespace App\Modules\Bsc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ApiProxyController extends Controller
{
    public function fetchData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_url' => 'required|url',
            'api_params' => 'nullable|array',
            'api_params.*' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid parameters',
                'details' => $validator->errors()
            ], 422);
        }

        try {
            $response = Http::timeout(15)
                ->get($request->api_url, $request->api_params ?? []);

            return response()->json([
                'data' => $response->json(),
                'status' => $response->status(),
                'success' => $response->successful()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'API request failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}