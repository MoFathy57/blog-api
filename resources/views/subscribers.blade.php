@extends('layouts.master')

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Blog Dashboard</h2>
            </div>
            <div class="pull-right mb-3">
                <a href="#" class="btn btn-success">Create user</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>username</th>
                    <th>status</th>
                    <th>actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
