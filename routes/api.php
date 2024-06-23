<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContentController;
use App\Models\Content;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('question', function (Request $request) {

        $type = $request->type;
        $pack = $request->package;
        $content = $request->content;
        $contents = Content::query();
        if(isset($type))
            $contents->where('type',$type);
        if(isset($pack))
            $contents->where('pack',$pack);
        if(isset($content))
            $contents->where('content','like','%'.$content.'%');
        return ['success'=>true,'data'=>$contents->get()];
    }
);

Route::get('packages', function () {
    return ['success'=>true,'data'=>Package::all()];
});