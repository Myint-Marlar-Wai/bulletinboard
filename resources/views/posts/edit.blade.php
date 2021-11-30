@extends('layout.master')
@section('title', 'Update Post Screen')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>

    <div class="row">
      <div class="col-8 mx-auto">
        <form method="POST" action="{{ route('post.updateConfirm',$post->id)}}">
          @csrf
          <input type="hidden" class="form-control" name="id" value="{{ $post->id }}">
          <div class="form-group">
            <label for="title">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" value="{{ $post->title }}"/>
        </div>
        <div class="form-group">
            <label for="description">Description <span class="text-danger">*</span></label>
            <textarea rows="5" columns="5" class="form-control" name="description" value="{{ $post->description }}" style="resize: none;">{{ $post->description }}</textarea>
        </div>
        <p class="mb-0">Status</p>

        <div class="btn-blk mt-3">
          <button type="submit" class="btn btn-primary mr-3">Confirm</button>
          <input type="reset" class="btn btn-secondary" value="Clear">
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection