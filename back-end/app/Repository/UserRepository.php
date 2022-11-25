<?php
namespace App\Repository;

use App\Models\User;
use App\Repository\UserInterface;
use Illuminate\Support\Facades\Hash;
use JWTAuth;


class UserRepository implements UserInterface
{   
    protected $user = null;

    public function createUser($collection = [] )
        {
            try {
                //code...
                $user = new User;
                $user->name = $collection['name'];
                $user->email = $collection['email'];
                $user->password = bcrypt($collection['password']) ;
                $user->save();

                return $user = $user->exists ?  $user : false;
                
            } catch (\Throwable $th) {
                //throw $th;
                return false;
            }   
            
        
        }

    public function createNewToken($token = [] )
        {
            try {
                //code...
                return [
                    'token' => $token,
                    'token_type' => 'bearer',
                    'status' => true,
                    'status_code'=>200,
                    'user' => auth()->user(),
                ]; 
            } catch (\Throwable $th) {
                //throw $th;
                return false;
            }
                      
        
        }
    
    // public function deleteUser($id)
    // {
    //     return User::find($id)->delete();
    // }
}