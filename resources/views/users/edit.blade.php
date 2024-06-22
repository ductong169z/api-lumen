@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Người dùng'])
<div class="row mt-4 mx-4">
    <div class="col-12">""
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Người dùng</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2 m-2">
                <form action="{{ route('users.update',$user) }}" method="post">
                @method('PUT')

                    @csrf


                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" required>
                        @error('firstname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}" required>
                        @error('lastname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                  

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>



                    <!-- Add other fields as needed -->

                    <button type="submit" class="btn btn-primary">Sửa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(".select2").select2();
</script>

@endpush