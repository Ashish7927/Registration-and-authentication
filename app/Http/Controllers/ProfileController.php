<?php

namespace App\Http\Controllers;

use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_all_user()
    {
        $Users = User::all();
        return view('user.list', compact("Users"));
    }


    public function register(Request $request)
    {
        //
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;

        $checkEmail = User::where('email', $email)->first();
        if ($checkEmail == null) {
            $user = new User;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $email;
            $user->save();

            $result['status'] = 'success';
            $result['message'] = 'Registred Successfully !';
            return $result;
        } else {
            $result['status'] = 'fail';
            $result['message'] = 'Email id is already registreted!';
            return $result;
        }
    }


    public function login()
    {
        //
        return view('user.login');
    }


    public function checkmail(Request $request)
    {
        //
        $email = $request->email;
        $checkEmail = User::where('email', $email)->first();
        if ($checkEmail != null) {
            $user = User::find($checkEmail->id);

            $result['status'] = 'success';
            $result['message'] = 'Registred Successfully !';
            $result['data'] = $user;
            return $result;
        } else {
            $result['status'] = 'fail';
            $result['message'] = 'Email id is not registred!';
            return $result;
        }
    }


    public function generate_qrcode(string $id)
    {
        //
        $url = url('') . '/' . 'get-profile/' . $id;
        return view('user.qrcode', compact("url"));
    }


    public function get_profile(string $id)
    {
        //
        $user = User::find($id);
        if ($user == null) {
            return view('user.registration');
        }
        return view('user.edit', compact("user"));
    }


    public function update_profile(Request $request, String $id)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $user = User::find($id);
        if (!isset($id) || $user == null) {
            $result['status'] = 'error';
            $result['message'] = 'Invalid request!';
            return $result;
        }
        $checkEmail = User::where('email', $email)->where('id', '!=', $id)->first();
        if ($checkEmail == null) {

            $formFileName = "file";
            $fileFinalName_ar = "";
            if ($request->$formFileName != "") {
                $fileFinalName_ar = time() . rand(
                    1111,
                    9999
                ) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = 'uploads/';
                $request->file($formFileName)->move($path, $fileFinalName_ar);
                $user->profile_pic = $fileFinalName_ar;
            }

            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $email;
            $user->save();

            $result['status'] = 'success';
            $result['message'] = 'Profile updated Successfully !';
            return $result;
        } else {
            $result['status'] = 'fail';
            $result['message'] = 'Email id is already registreted!';
            return $result;
        }
    }
}
