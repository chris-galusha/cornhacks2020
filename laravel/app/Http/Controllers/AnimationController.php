<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use App\Animation;
use App\Light;
use Log;

class AnimationController extends Controller
{
    public function index()
    {
      $animations = Animation::all();
      return view('animation.animations', compact('animations'));
    }

    public function store(Request $request)
    {
        $request->validate(getAnimationValidationRules());

        $name = $request->input('name');
        $file = $request->file('animation') ?? null;

        $animation = new Animation();
        $animation->name = $name;
        $data = json_decode(file_get_contents($file), true);
        $animation->data = $data;
        $animation->save();

        $message = 'New animation Created';
        session()->flash('message', $message);

        return redirect('/animations');
    }

    public function show(Request $request, Animation $animation)
    {
      return view('animation.show', compact('animation'));
    }

    public function create(Request $request)
    {
      return view('animation.create');
    }

    public function update(Request $request, Animation $animation)
    {
      $request->validate(getAnimationValidationRules());

      $name = $request->input('name');
      $file = $request->file('animation') ?? null;

      $animation->name = $name;
      if ($file !== null) {
        $data = json_decode(file_get_contents($file), true);
        $animation->data = $data;
      }
      $animation->save();

      $message = 'New animation Created';
      session()->flash('message', $message);

      return redirect('/animations');
    }

    public function edit(Request $request, Animation $animation)
    {
      return view('animation.edit', compact('animation'));
    }

    public function destroy(Request $request, Animation $animation)
    {
      $animation->delete();

      $message = 'Light Deleted: '.$animation->name;
      session()->flash('message', $message);

      return redirect('/animations');
    }

    public function play(Request $request)
    {
      $color_hex = $request->input('color');
      if ($color_hex) {
        $animation = new Animation();
        if (strpos($color_hex, '#')) {
          list($r, $g, $b) = sscanf($color_hex, "#%02x%02x%02x");
        } else {
          list($r, $g, $b) = sscanf($color_hex, "0x%02x%02x%02x");
        }
        $animation_data = ['Rate' => 1000, 'Basis' => 1, "Animation" => [[$r, $g, $b]]];
        $animation->data = $animation_data;
      } else {
        $animation_name = $request->input('animation');
        $animation = Animation::where('name', 'like', '%'.$animation_name.'%')->first();
      }

      $light_name = $request->input('light');
      $light = Light::where('name', 'like', '%'.$light_name.'%')->first();

      if ($animation === null) {
        return new Response(['Message' => 'The animation does not exist.'], 400);
      } elseif ($light === null) {
        return new Response(['Message' => 'The light does not exist.'], 400);
      }

      $binary = $this->getBinaryFromAnimationData($animation->data);
      // Send request to 192.168.0.102/api/animate
      $client = new Client();
      $url = 'http://192.168.43.53/api/animate';
      $response = $client->put($url, ["body" => $binary])->send();

      return ['Status' => 'Success'];
    }

    protected function getBinaryFromAnimationData($animation_data) {
      $rate = $animation_data['Rate'];
      $basis = $animation_data['Basis'];
      $animation = $animation_data['Animation'];

      $binary = pack('nnn', 44459, $basis, $rate);
      foreach ($animation as $frame) {
        list($r, $g, $b) = $frame;
        $binary = $binary.pack('C*', $r, $g, $b);
      }

      return $binary;
    }
}
