@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Môn học'])
<div class="row mt-4 mx-4">
    <div class="col-12">
        <div class="card mb-4">

            <div class="card-body px-0 pt-0 pb-2 m-2">
                <form action="{{ route('contents.update',[ $content->id ]) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <input type="text" class="form-control" id="content" name="content" value="{{ $content->content }}">
                        @error('content')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" name="type" id="type">
                            <option @if($content->type == '1') selected @endif  value="1">Truth</option>
                            <option @if($content->type == '0') selected @endif  value="0">Dare</option>
              
                        </select>
                        @error('type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="package" class="form-label">Package</label>
                        <select class="form-control" name="package" id="package">
                            @foreach($packages as $key => $package)
                            <option value="{{$key}}">{{$package}}</option>
                            @endforeach
                        </select>
                        @error('package')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Add other fields as needed -->

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')


@endpush