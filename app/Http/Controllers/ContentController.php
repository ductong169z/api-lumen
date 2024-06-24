<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Repositories\ContentRepository;
use App\Repositories\PackageRepository;

class ContentController extends Controller
{
    protected $contentRepository;
    protected $packageRepository;


    public function __construct(ContentRepository $contentRepository, PackageRepository $packageRepository)
    {
        $this->contentRepository = $contentRepository;
        $this->packageRepository = $packageRepository;
    }

    public function index(Request $request)
    {
        $contents = $this->contentRepository->all([
            'content' => $request->content,
            'type' => $request->type,
            'pack' => $request->pack,
        ], 20);
        $packages = $this->packageRepository->all()->pluck('name', 'id')->prepend('All', '');
        return view('content.index', compact('contents', 'packages'));
    }
    public function create()
    {
        $packages = $this->packageRepository->all()->pluck('name', 'id');
        return view('content.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'package' => 'required',
            'content' => 'required',
        ]);

        $this->contentRepository->create([
            'type' => $request->type,
            'pack' => $request->package,
            'content' => $request->content,
        ]);
        return redirect()->route('contents.index');
    }
    public function edit($id)
    {
        $content = $this->contentRepository->find($id);
        $packages = $this->packageRepository->all()->pluck('name', 'id');
        return view('content.edit', compact('content', 'packages'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'package' => 'required',
            'content' => 'required',
        ]);
      $this->contentRepository->update([
        'type' => $request->type,
        'pack' => $request->package,
        'content' => $request->content,
      ], $id);
        return redirect()->route('contents.index');
    }
    public function destroy($id)
    {
        $this->contentRepository->delete($id);
        return redirect()->route('contents.index');
    }
}
