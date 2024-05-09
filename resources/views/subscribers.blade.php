@extends('layouts.master')

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Dashboard</h2>
            </div>
            <div class="pull-right mb-3">
                <a href="#subscriberModal" data-bs-toggle="modal" class="btn btn-success">Create User</a>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{$message}}
                </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="subscriberTable">
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

{{-- create subscriber modal --}}
<div class="modal fade" id="subscriberModal" tabindex="-1" aria-labelledby="subscriberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="subscriberModalLabel">New subscriber</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="subscriberForm" action="javascript:void(0)" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="" id="subscriberid">
            <div class="mb-3">
                <label for="name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
              <label for="username" class="col-form-label">Username:</label>
              <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
              <label for="password" class="col-form-label">Password:</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="subscriberAction('{{route('users.store')}}')">Save</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('js')
    <script src="{{asset('/js/subscriber.js')}}"></script>
@endsection
