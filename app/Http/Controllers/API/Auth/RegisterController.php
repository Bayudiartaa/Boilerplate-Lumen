<?php

namespace App\Http\Controllers\API\Auth;

use App\Traits\Response;
use Illuminate\Http\Request;
use App\Services\RegisterService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use Response;
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'telphone' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'min:11'],
        ]);
        if($validator->fails()) {
            return $this->errorResponse(null, $validator->errors(), 422);
        }

        $data = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'telphone' => $request->input('telphone'),
        ];

        $user = $this->registerService->register($data);

        // return response()->json($user, 200);
        return $this->successResponse($user, 'Successfully Registered', 200);
    }
}
