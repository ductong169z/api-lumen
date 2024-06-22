<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Package;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;
        $pack = $request->package;
        $content = $request->content;
        $contents = Content::with('package');
        if(isset($type))
            $contents->where('type',$type);
        if(isset($pack))
            $contents->where('pack',$pack);
        if(isset($content))
            $contents->where('content','like','%'.$content.'%');
    
        if($request->wantsJson()){
            $key=$request->key;
            if($key!="hibrosoft"){
                return response('Unauthorized','403');
            }
            return ['success'=>true,'data'=>$contents->limit(2)->get()];
        }
        $contents=$contents->orderBy('id','desc')->cursorPaginate(10);
        $packages = Package::all()->pluck( 'name', 'id' )->prepend('All','');
        return view('content.index',compact('contents','packages'));
    }
    public function create()
    {
        $packages = Package::all()->pluck( 'name', 'id' );

        return view('content.create',compact('packages'));
    }

    public function store(Request $request)
    {
      $validated=  $request->validate([
            'type' => 'required',
            'package' => 'required',
            'content' => 'required',
        ]);

        $content = new Content();
        $content->type = $request->type;
        $content->pack = $request->package;
        $content->content = $request->content;
        $content->save();
        return redirect()->route('contents.index');
    }
    public function edit($id)
    {
        $content = Content::find($id);
        $packages = Package::all()->pluck( 'name', 'id' );

        return view('content.edit', compact('content','packages'));
    }
    public function update(Request $request, $id)
    {   
        $request->validate([
            'type' => 'required',
            'package' => 'required',
            'content' => 'required',
        ]);
        $content = Content::find($id);
        $content->type = $request->type;
        $content->pack = $request->package;
        $content->content = $request->content;
        $content->save();
        return redirect()->route('contents.index');
    }
    public function destroy($id)
    {
        $content = Content::find($id);
        $content->delete();
        return redirect()->route('contents.index');
    }
}
