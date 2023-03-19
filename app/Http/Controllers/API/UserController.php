<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use Response;
    protected $userService;

    public function __construct(UserService $userService) {
       $this->userService = $userService;
    }

    public function createUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'telphone' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'min:11'],
        ]);
        if($validator->fails()) {
            return $this->errorResponse('null', $validator->errors(), 422);
        }

        $user = $this->userService->createUser([
            'fullname' => $request->get('fullname'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'telphone' => $request->get('telphone'),
        ]);

        return $this->successResponse($user, 'Successfully Created User');
     }
  
     public function updateUser(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'telphone' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'min:11'],
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(null, $validator->errors(), 422);
        }
        $data = [
           'fullname' => $request->input('fullname'),
           'email' => $request->input('email'),
           'password' => Hash::make($request->input('password')),
           'telphone' => $request->input('telphone'),
        ];
        $user = $this->userService->updateUser($id, $data);
        return $this->successResponse($user, 'User successfully updated');
     }
  
     public function deleteUser(int $id) {
        $user = $this->userService->deleteUser($id);
        return $this->successResponse($user, 'User successfully deleted');
     }
}
