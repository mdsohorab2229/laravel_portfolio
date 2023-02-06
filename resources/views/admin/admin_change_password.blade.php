@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Change Password page</h4><br>

                            @if(count($errors))
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissable fade show">{{$error}}</p>
                                @endforeach
                            @endif

                            <form action="{{ route('update.password') }}" method="POST">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Current Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="current_password" placeholder="Current Password"  id="current_password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="new_password" placeholder="New Password"  id="new_password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"  type="password" name="confirm_password" placeholder="Confirm Password"  id="confirm_password">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Change Password">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

@endsection
