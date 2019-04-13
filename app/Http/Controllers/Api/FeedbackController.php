<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $data = array_merge($request->all(), [
            'user_id' => Auth::id()
        ]);

        Feedback::create($data);

        return $this->response->created();
    }
}
