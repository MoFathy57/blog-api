@extends('layouts.master')

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Blog Dashboard</h2>
            </div>
            <div class="pull-right mb-3">
                <a href="#blogModal" data-bs-toggle="modal" class="btn btn-success">Create blog</a>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{$message}}
                </div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="blogTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>publish date</th>
                    <th>Status</th>
                    <th>actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- create blog modal --}}
<div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="blogModalLabel">New Blog</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="blogForm" action="javascript:void(0)" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="blogid" value="" id="blogid">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Title:</label>
              <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">body:</label>
              <textarea class="form-control" id="body" name="body"></textarea>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Publish date:</label>
              <input type="date" class="form-control" id="publish-date" name="publish_date">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="blogAction('{{route('blogs.store')}}')">Save</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('js')
    <script src="{{asset('/js/blog.js')}}"></script>
@endsection
