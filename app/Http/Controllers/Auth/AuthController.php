<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    //register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'ada kesalahan',
                'data' => $validator->errors(), 433
            ]);
        }

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 2,
            'username' => $request->username,
            'status' => 'NOT ACTIVE',
        ]);


        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Success register',
                'user' => $user,

            ], 201);
        }
        return response()->json([
            'success' => false,
        ], 409);
    }


    //login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);
        // try
        // {

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response(['status' => false, 'message' => 'User Not Found']);
        }
        if (Hash::check($request->password, $user->password)) {
            if ($user->status != "Active") {
                return response(['status' => false, 'message' => 'Akun Tidak Aktif, silahkan menghubungi admin']);
            }
            $token = $user->createToken($user->id)->accessToken;
            return response([
                'status' => true,
                'message' => [
                    'user' => $user,
                    'token' => $token
                ]
            ]);
        } else {
            return response(['status' => false, 'message' => 'Password atau Email salah, silahkan menghubungi admin']);
        }
        // } catch (\Exception $e) {
        //     return response(['status' => false, 'message'=> $e -> getMessage()]);
        // }

    }
        public function GetUser()
    {
        if (Auth::user()->role== 1 )
        {

            // $user= User::where('role',Auth::user()->role)->get();
            $user = user::orderBy('created_at', 'desc')->where('role','=',2)->get();
        if ($user) {
            // var_dump($user);
            // exit;
            return UserResource::collection($user);


            }
            return response()->json(array(
                'message' => 'reservasi tidak ditemukan',
                'status' => 'not found',
                'code' => 500,
            ));
        }
        return response()->json(array(
            'message' => 'Anda tidak memiliki akses',
            'status' => 'not exist',
            'code' => 405,
        ));
    }
    //logout
    public function logout(Request $request)
    {
        $request->user()->token()->delete();
        return "berhasil logout";
    }

    //data login

    public function me(Request $request)
    {
        return response()->json(Auth::user());
    }
}
