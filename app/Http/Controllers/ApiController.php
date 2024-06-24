<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContentRepositoryInterface;
use App\Repositories\PackageRepositoryInterface;
class ApiController extends Controller
{
    protected $contentRepository;
    protected $packageRepository;
    public function __construct(ContentRepositoryInterface $contentRepository, PackageRepositoryInterface $packageRepository)
    {
        $this->contentRepository = $contentRepository;
        $this->packageRepository = $packageRepository;
    }
    //
    public function contents(Request $request){
        $contents=$this->contentRepository->all([
            'content'=>$request->content,
            'package'=>$request->package,
            'type'=>$request->type,
        ],0);

        return [
            'success'=>true,
            'data'=>$contents->withQueryString()
        ];
    }
   
    public function packages(){
        $packages=  $this->packageRepository->all();
        return [
            'success'=>true,
            'data'=>$packages
        ];
    }
}
