<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $data = array_merge($request->all(), [
            'user_id' => Auth::id()
        ]);

        Feedback::create($data);

        return $this->response->created();
    }
}
