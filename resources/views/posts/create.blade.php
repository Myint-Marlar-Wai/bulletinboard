@extends('layout.master')
@section('title', 'Post Create Screen')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>

    <div class="row">
      <div class="col-8 mx-auto">
        <form action="{{ url('post/confirm') }}" method="POST">
          @csrf
          <div class="form-group row align-items-center">
            <label for="title">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Title..." id="title" name="title">
          </div>
          <div class="form-group row align-items-center">
            <label for="description">Description <span class="text-danger">*</span></label>
            <textarea rows="5" columns="5" id="description" name="description" class="form-control"></textarea>
          </div>
          <p class="mb-0">Status</p>
          <label class="switch">
            <input type="checkbox" checked="" name="status">
            <span class="status round"></span>
          </label>
          <div class="btn-blk">
            <button type="submit" class="btn btn-primary mr-3">Confirm</button>
            <input type="reset" class="btn btn-secondary" value="Clear">
          </div>
      </form>
      </div>
    </div>
  </div>
@endsection