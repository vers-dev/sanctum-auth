<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminController extends Controller
{
    public function check(Request $request)
    {
        return $this->successResponse(new JsonResource([
            'user' => $request->user(),
            'message' => 'You are admin'
        ]));
    }
}
