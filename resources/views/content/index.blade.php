@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Packages'])
<div class="row mt-4 mx-4">

    <div class="col-12">

        <div class="card mb-4">

            <div class="card-body">
               <form action="{{route('contents.index')}}" method="get">
               <div class="form-group row align-items-center">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="content" value="{{request()->get('content')}}" placeholder="Contents">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="type" id="type">
                            <option @if(request()->get('type')==null) selected @endif value="">All</option>
                            <option @if(request()->get('type')=="1") selected @endif value="1">Truth</option>
                            <option @if(request()->get('type')=="0") selected @endif value="0">Dare</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="package" id="package">
                            @foreach($packages as $key => $package)
                            <option value="{{$key}}" @if(request()->get('package')==$key) selected @endif>{{$package}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
               </form>
                <div class="col-md-12 p-2 d-flex flex-row-reverse"><a type="button" class="btn btn-primary flex-right" href="{{route('contents.create')}}">Thêm mới</a></div>
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Content</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Package</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contents as $content)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$content->content}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$content->package->name}}</p>
                                </td>
                                <td>
                                    <span class="badge {{$content->type==1 ? ' bg-primary' : ' bg-danger '}}">{{$content->type==1 ? 'Truth' : 'Dare'}}</span>


                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <a class="btn btn-primary text-sm font-weight-bold mb-0 me-2" href="{{route('contents.edit',['id'=>$content->id])}}">Sửa</a>
                                        <a class="btn btn-danger text-sm font-weight-bold mb-0" href="{{route('contents.destroy',['id'=>$content->id])}}">Xóa</a>

                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
                <div class="justify-content-end d-flex p-2">
                    {{$contents->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection