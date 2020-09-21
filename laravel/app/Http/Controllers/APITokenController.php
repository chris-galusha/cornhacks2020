<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\ApiToken;
use App\Service;
use App\User;
use Auth;
use DB;

class APITokenController extends Controller
{
    /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

     public function __construct () {
       $this->middleware('auth')->except('requestToken');
     }

     public function requestToken(Request $request)
     {
       $email = $request->input('email');
       $password = $request->input('password');
       $name = $request->input('name');
       $request->validate(getTokenRequestValidationRules());
       if (Auth::attempt(['email' => $email, 'password' => $password])) {

             $token = Str::random(80);

             $api_token = new ApiToken();
             $api_token->api_token = hash('sha256', $token);
             $api_token->save();

             if (!Service::where('name', $name)->exists()) {
               $service = new Service();
               $service->name = $name;
               $service->api_token_id = $api_token->id;
               $service->save();
               $api_token->service_id = $service->id;
               $api_token->save();
             } else {
               $service = Service::where('name', $name)->first();
               if ($service->api_token) {
                 $service->api_token->delete();
               }
               $service->api_token_id = $api_token->id;
               $api_token->service_id = $service->id;
               $service->save();
               $api_token->save();
             }

             return ['token' => $token];
       } else {
         return Response(['message' => 'Invalid Credentials'], 401);
       }
     }

     public function destroy($api_token_id)
     {

       $api_token = ApiToken::find($api_token_id);
       $service = $api_token->service;
       if ($service !== null) {
         $service->api_token_id = null;
         $service->save();
       }
       $api_token->delete();

       return redirect('/api/tokens');

     }

     public function regenerate($api_token_id)
     {

       $api_token = ApiToken::find($api_token_id);

       $service = $api_token->service;
       if ($service === null) {
         session()->flash('message', 'No Services to associate this token with.');
         return redirect('/api/tokens');
       }
         $token = Str::random(80);
         $hashed_token = hash('sha256', $token);

         $api_token->api_token = $hashed_token;
         $api_token->save();

         session()->flash('token', $token);

         return redirect('/api/tokens');
     }

    public function generate(Request $request)
    {

      $services = Service::where('api_token_id', null)->get();
      if ($services->count() == 0) {
        session()->flash('message', 'No Services to associate a token with. Add a service first!');
        return redirect('/api/tokens');
      }
        $token = Str::random(80);
        $hashed_token = hash('sha256', $token);

        session()->put('hashed_token', $hashed_token);

        return view('api.generate', compact('token', 'services'));
    }

    public function store(Request $request)
    {
      $hashed_token = session()->get('hashed_token');
      $api_token = new ApiToken();
      $api_token->api_token = $hashed_token;

      $service_id = $request->input('service_id');
      $service = Service::find($service_id);

      $api_token->service_id = $service->id;
      $api_token->save();

      $service->api_token_id = $api_token->id;
      $service->save();

      return redirect('/api/tokens');
    }

    public function index()
    {
      $api_tokens = ApiToken::all();
      return view('api.tokens', compact('api_tokens'));
    }
}
