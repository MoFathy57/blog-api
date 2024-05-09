<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        if(request()->ajax()){
            return datatables()->of(User::select('*'))
            ->editColumn('status', function(User $user) {
                return $user->status ? '<button class="btn btn-success">Active</button>': '<button class="btn btn-success">Not Active</button>';
            })
            ->removeColumn('password')
            ->addColumn('actions', 'user-actions')
            ->rawColumns(['status','actions'])
            ->addIndexColumn()
            ->make();
        };
        return view('subscribers');
    }

    public function store(StoreUserRequest $request)
    {
        $userId = $request->id;

        if($request->password){
            $password = Hash::make($request->password);
        }elseif($userId){
            $password = User::find($userId)->password;
        }

        User::updateOrCreate(['id'=>$userId],[
            'name' => $request->name,
            'username' => $request->username,
            'password' => $password
        ]);

        return response()->json([
            'message' => 'user added successfully.',
        ], 200);
    }


    public function edit(User $user)
    {
        return Response()->json($user);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'user deleted successfully.',
        ]);
    }

    public function login(Request $request){

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            $user = Auth::user();
            $user['accessToken'] =  $user->createToken('MyApp')->plainTextToken;

            return $this->sendResponse($user, 'User login successfully.');

        }

        else{

            return $this->sendError('wrong username or password.', ['error'=>'wrong username or password']);

        }

    }

    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }



    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
