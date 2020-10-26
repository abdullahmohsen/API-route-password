<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Admin;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use GeneralTrait;
    public function login(Request $request)
    {
        //validation
        try {
            $rules = [
                "email" => "required|exists:admins,email",
                "password" => "required"
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login
            $credentials = $request->only(['email','password']) ;

            $token =  Auth::guard('admin-api')->attempt($credentials);

            if(!$token)
            {
                return $this->returnError('E001','The credentials not valid');
            }

            $admin = Auth::guard('admin-api')->user(); //Data of admin
            $admin -> api_token = $token; //token of admin

            //return data and token
            return $this -> returnData('admin', $admin);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
}
