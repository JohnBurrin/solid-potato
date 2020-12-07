@extends('layouts.plain')

@section('content')
<div class="container">
    <div class="row">
      <div class="col">
          <div class="card">
            <div class="card-body">
                This is a test launch page for various application features, it should be available without the need to be logged in
            </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Home (here)</h5>
                <p class="card-text">This link will only return you to this page. if it ever promts a login something has gone wrong.</p>
                <a href="/" class="btn btn-primary">Home</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Login as user/admin</h5>
                    <p class="card-text">if not logged in the login user form will be displayed,
                        if logging in as a user you will be redirected to the user dashboard, if logging in as an admin you will be redirected to the admin dashboard</p>
                    <a href="/admin/login" class="btn btn-primary">Login</a>
                </div>
            </div>
        </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Logout user</h5>
                        <p class="card-text">Should log the user out and redirected to the login page</p>
                        <a href="/admin/logout" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Go to post user dashboard page</h5>
                    <p class="card-text">This should be the opposite of Login in as user, should take you to the dashboard page if logged in,
                         if not redirct to the user login page</p>
                    <a href="/dashboard" class="btn btn-primary">Dashboard</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Go to user my account page</h5>
                    <p class="card-text">Will present the user My Account page, login is required</p>
                    <a href="/myaccount" class="btn btn-primary">My Account</a>
                </div>
            </div>
        </div>
    </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Go to admin dashboard</h5>
                    <p class="card-text">This will go straight to the admin dashboard if logged in as an admin user, it should not allow a regular user access</p>
                    <a href="/admin/dashboard" class="btn btn-primary">Admin Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
