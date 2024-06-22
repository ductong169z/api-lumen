<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //
    public function index()
    {
        $packages = Package::all();
        return view('package.index', compact('packages'));
    }
    public function create()
    {
        return view('package.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $package = new Package();
        $package->name = $request->name;
        $package->description = $request->description;
        $package->save();
        return redirect()->route('packages.index');
    }
    public function edit($id)
    {
        $package = Package::find($id);
        return view('package.edit', compact('package'));
    }
    public function update(Request $request, $id)
    {   
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $package = Package::find($id);
        $package->name = $request->name;
        $package->description = $request->description;
        $package->save();
        return redirect()->route('packages.index');
    }
    public function destroy($id)
    {
        $package = Package::find($id);
        $isLinked=Content::where('pack',$id)->first();
        if($isLinked){
            return redirect()->route('packages.index')->with('error', 'Package is linked to content');
        }
        $package->delete();
        return redirect()->route('packages.index');
    }
    
}
