<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Restart_passwords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showIndex(Request $request)
    {

        return response()->json(User::all());
    }
    public function search($key){
        $kw = $key;
        if(empty($key)){
            $users = User::all();
        }
        $users = User::where('name', 'like', "%$kw%")
        ->get();
        if(count($users)){
            return response()->json($users);
        }else{
             return response()->json(['MESSAGE' =>'No Data'], 200);
        }
         return response()->json($users);

        
        
    }
    public function saveAddNew(Request $r){

        $this->validate($r, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
         ]);
        $user = User::create([
             'name'=>$r->name,    
             'email'=>$r->email,
             'password'=> password_hash($r->password, PASSWORD_DEFAULT), 
             'role_id'=>$r->role_id
        ]);
        return response()->json(['MESSAGE' =>'Create user '], 200);
    }
    public function showIndexUser($id){
        // dd($id);
      return response()->json(User::findOrFail($id));
    }
    public function saveEditUser(Request $request,$id){
        if (isset($id)) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|unique:users,email,' .$id,
               
            ]);
            $user= User::find($id);
            $user->update($request->all());

            return response()->json($user);
        };
        return response('error');
    }
    
    public function deleteUser($id){
        $user= User::destroy($id);
        return ('success');
    }


    public function login(){
        
       return response()->json(User::all()); 
    }
    public function password(Request $request){
        $email= User::where('email',$request->email)->first();
        $test= $request->email;
        if(!$email){
            return response(['error'=>['Email không tồn tại!.']], 401);
        }
        $permitted_chars ='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code= substr(str_shuffle($permitted_chars), 0, 30);
        $checkemail= Restart_passwords::where('email',$email->email)->get();
        if(count($checkemail) != 1 ){
            $ressetpassword= new Restart_passwords();
            $ressetpassword->email=$test;
            $ressetpassword->token= $code;
            $ressetpassword->save();
            
        }
        foreach ($checkemail as $mail) {
            $mail->token=$code;
            $mail->save();
        } 
        
        $url= "http://localhost:4200/ressetpassword/$code";
        // dd($url);
        $details=[
            'url'=>$url,
        ];
        Mail::to($test)->send(new MyEmail($details));
        // return "ok"; 
       return response()->json($code);
    }
    public function getpassword($token){
        $email= Restart_passwords::where('token',$token)->first();
        $user= User::where('email',$email->email)->first();
        return response()->json($user);
    }
    public function savepassword(Request $request,$token){
        $permitted_chars ='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code= substr(str_shuffle($permitted_chars), 0, 35);
        $user= User::find($token);
        $user->password= password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();
        $model= Restart_passwords::where('email',$user->email)->first();
        $model->token = $code;
        $model->save();
        return response(['thanh cong']);
    }

    //
}
