<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Mail;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;

class ChangeaddressController extends Controller
{
    public function preupdate(Request $request)
    {
        // ログインしているユーザーを取ってくる
        $user = Auth::user()->id;

        $address = $request->input('new_email');
        $token = hash_hmac(
            'sha256',
            str_random(35).$address,
            env('APP_KEY')
        );

        Mail::send(
            'emails.changemailaddress',
            ['url' => "settings/authorizeMail/?token={$token}"],
            function ($message) use ($address) {
                $message->to($address);
                $message->subject('メールアドレス変更確認');
            }
        );

        
        DB::table('newemails')->insert([
            [
                'id' => $user,
                'new_email' => $address,
                'token' => $token
            ]
        ]);

        return view('emails/showmessage');
    }

    public function authorizeMail(Request $request,$token = null)
    {
        $token = $request->input('token');

        $email_changes = DB::table('newemails')
            ->where('token', '=', $token)
            ->first();

        $user = User::find($email_changes->id);
        $user->email = $email_changes->new_email;
        $user->save();

        DB::table('newemails')
            ->where('token', '=', $token)
            ->delete();

            return view('emails/confirmaddress');
    }
}
