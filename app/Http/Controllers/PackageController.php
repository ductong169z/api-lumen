<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Repositories\PackageRepositoryInterface;

class PackageController extends Controller
{
    //
    protected $packageRepository;

    public function __construct(PackageRepositoryInterface $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function index()
    {
        $packages = $this->packageRepository->all();
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
        $this->packageRepository->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('packages.index');
    }
    public function edit($id)
    {
        $package = $this->packageRepository->find($id);;
        return view('package.edit', compact('package'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $this->packageRepository->update([
            'name' => $request->name,
            'description' => $request->description,
        ], $id);
        return redirect()->route('packages.index');
    }
    public function destroy($id)
    {
        $isLinked = Content::where('pack', $id)->first();
        if ($isLinked) {
            return redirect()->route('packages.index')->with('error', 'Package is linked to content');
        }
        $this->packageRepository->delete($id);
        return redirect()->route('packages.index');
    }
}
