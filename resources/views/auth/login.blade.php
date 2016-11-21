@extends('layouts.app')

@section('content')
    <div class="center">
        <div class="card bordered z-depth-2" style="margin:0% auto; max-width:400px;">
            <div class="card-header">
                <div class="brand-logo">
                    Alper
                </div>
            </div>
            <form class="form-floating" name="login-form" method="post">
                {{csrf_field()}}
                <div class="card-content">

                    <div class="form-group">
                        <label for="inputEmail" class="control-label">Email</label>
                        <input type="text" class="form-control" name="email"></div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password"></div>
                </div>
                <div class="card-action clearfix">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-link black-text">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
