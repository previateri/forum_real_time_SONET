<?php

namespace App\Http\Controllers;

use App\SocialAuth;
use App\User;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    private $provider;
    private $user;


    public function redirect($provider){
        return \Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $this->provider = $provider;
        $this->user = \Socialite::driver($provider)->user();

        $account = SocialAuth::where([
            'provider'  => $this->provider,
            'social_id' => $this->user->id
        ])->first();

        if($account){
            auth()->login($account->user);
            return redirect()->to('/');
        }

        $localUser = User::where('email', $this->user->email)->first();

        if($localUser){
            $this->newSocialUser($localUser);
            return redirect()->to('/');
        }

        //Novo usuário do Fórum cadastrado pelo Facebook
        $newUser = new User();
        $newUser->name = $this->user->name;
        $newUser->email = $this->user->email;
        $newUser->password = md5(rand(1,1000));
        $newUser->save();

        $this->newSocialUser($newUser);

        return redirect()->to('/');
    }

    //Novo cadastro do usuário com facebook
    private function newSocialUser($typeUser){

        $account = new SocialAuth();
        $account->provider = $this->provider;
        $account->social_id = $this->user->id;
        $account->user_id = $typeUser->id;
        $account->save();

        auth()->login($typeUser);
    }
}
