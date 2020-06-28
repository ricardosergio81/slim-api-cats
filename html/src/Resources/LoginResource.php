<?php

namespace rs81\Resources;


use \rs81\Models\Users as Users;

class LoginResource
{

   public function validate($user, $password)
    {
        $result = Users::where('username', '=', $user);
            
        if ($result->count() > 0) {
            if(password_verify($password,$result->get()[0]->password )){
                return $result->get()[0];
            }
         }

        return false;
    }
}