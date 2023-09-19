<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use App\Http\Requests\StoreUserRequest;
// use App\Http\Requests\UserLoginRequest;
// use App\Traits\HttpResponses;
// use Illuminate\Support\Facades\Log;

// class AuthController extends Controller
// {
//     use HttpResponses;


//     public function showLoginForm()
//     {

//         Log::error('Error ' . "Login form error" );
//         return view('auth.login');
//     }

//     public function login(UserLoginRequest $request) 
//    {

//     Log::error('Error before authentication'  );
//         $request->validated($request->all());

//         if (!Auth::attempt($request->only(['email' , 'password']))) {
//             return $this->error('' ,'Credentials Do not Match' , 401);
//          }
         
//          $user = User::where('email' , $request->email)->first();
//          $dataString = json_encode($user);
//          Log::error('Error ' . $dataString );
//          Log::info('Error ' . $dataString );

//         //  return redirect()->route('contacts.index');
//          return view('contacts.index' , [
//             'user' => $user
//          ]);
//         // $this->success([
//         //     'user' => $user,
//         //     'token' => $user->createToken('Api Token for user' . $request->name)->plainTextToken
//         // ]);
//     }

//     public function register(StoreUserRequest $request)
//        {
//             $request->validated($request->all());

//             $user = User::create(
//                 [
//                     'name' => $request->name,
//                     'password' => Hash::make($request->password),
//                     'email' => $request->email
    
//                 ]
//                 );

//                 return $this->success([
//                     'user'=> $user,
//                     'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
//                 ]);
            
            
//         }

//         public function logout()  {


//             Auth::user()->currentAccessToken()->delete();
    
    
//             return $this->success([
//                 'message' => 'You have been successfully Logged Out'
//             ]);
            
//         }
        
    


// }
