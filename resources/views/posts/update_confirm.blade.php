@extends('layout.master')
@section('title', 'Post Confirm Screen')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4"><?php echo $name;?></h2>

    <div class="row">
      <div class="col-8 mx-auto">
        
        <form action="{{ route('post.update',$post['id']) }}" class="create-post" method="post">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" value="{{ $post['id'] }}">
          <table class="table table-bordered user-confirm-tbl">
            <tbody>
              <tr>
                <td>Title</th>
                <td>
                  <input type="hidden" name="title" class="form-control" value="{{ $post['title'] }}">
                  {{ $post['title'] }}
                </td>
              </tr>
              <tr>
                <td>Description</th>
                <td>
                  <input type="hidden" name="description" class="form-control" value="{{ $post['description'] }}">
                  {{ $post['description'] }}
                </td>
              </tr>
              <tr>
                <td>Status</th>
                <td>
                  <label class="switch">
                    <input type="hidden" checked>
                    <span class="status round"></span>
                  </label>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="btn-blk">
            <button type="submit" class="btn btn-primary mr-3">Update</button>
            <input type="reset" class="btn btn-secondary" value="Cancel">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection