@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Packages'])
<div class="row mt-4 mx-4">

    <div class="col-12">

        <div class="card mb-4">
   
            <div class="card-body px-0 pt-0 pb-2">
                <div class="col-md-12 p-2 d-flex flex-row-reverse"><a type="button" class="btn btn-primary flex-right" href="{{route('packages.create')}}">Thêm mới</a></div>
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description
                                </th>
                                <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$package->name}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{$package->description}}</p>
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                        <a class="btn btn-primary text-sm font-weight-bold mb-0 me-2" href="{{route('packages.edit',['id'=>$package->id])}}">Sửa</a>
                                        <a class="btn btn-danger text-sm font-weight-bold mb-0" href="{{route('packages.destroy',['id'=>$package->id])}}">Xóa</a>

                                    </div>
                                  
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection