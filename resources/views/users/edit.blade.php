@extends('layout.master')
@section('title', 'Update User Screen')
@section('content')
  <div class="content border">
    <h2 class="text-center font-weight-bold mb-4">Update User</h2>
    <form method="post" action="{{ route('user.updateConfirm',$user->id)}}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">
      <div class="form-group row align-items-center">
        <label for="name" class="col-md-4 text-md-right ">Name <span class="text-danger">*</span></label>
          <div class="col-md-6">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="name" id="name" name="name" value="{{ $user->name }}">
            </div>
          </div>
      </div>
      <div class="form-group row align-items-center">
        <label for="email" class="col-md-4 text-md-right">Email Address <span class="text-danger">*</span></label>
          <div class="col-md-6">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="example@gmail.com" id="email" name="email" value="{{ $user->email }}">
            </div>
          </div>
      </div>
      <div class="form-group row align-items-baseline">
        <label for="profile" class="form-label col-md-4 text-md-right">Profile</label>
        <div class="col-md-6">
          <input class="form-control" type="file" id="profile" name="profile" onChange="previewFile()" value="{{ $user->profile }}">
          <img id="previewImg" src="/image/{{ $user->profile }}" alt="Profile Image" style="max-width:130px;margin-top:10px;" />     
        </div>  
      </div>
      <div class="row mt-4 mb-3">
        <label class="col-md-4 text-md-right">Password</label>
        <div class="col-md-6">
          <a href="{{ route('user.passwordScreen',$user->id)}}" class="text-md-right font-weight-bold"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
        </div>
      </div>
      <div class="form-group row align-items-center">
        <label for="type" class="col-md-4 text-md-right">Type <span class="text-danger">*</span></label>
          <div class="col-md-6">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
              </div>
              <select class="form-control" id="type" name="type">
                <option value="0" {{($user->type == '0') ? 'selected' : ''}}>Admin</option>
                <option value="1" {{($user->type == '1') ? 'selected' : ''}}>User</option>
              </select>
            </div>
          </div>
      </div>
      <div class="form-group row align-items-center">
        <label for="phone" class="col-md-4 text-md-right">Phone</label>
          <div class="col-md-6">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-phone-square" aria-hidden="true"></i>
                </span>
              </div>
              <input type="tel" class="form-control" placeholder="Enter Phone Number" id="phone" name="phone" value="{{ $user->phone }}">
            </div>
          </div>
      </div>
      <div class="form-group row align-items-center">
        <label for="dob" class="col-md-4 text-md-right">Date Of Birth</label>
          <div class="col-md-6">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
              </div>
              <input type="date" class="form-control" id="dob" name="dob" value="{{ $user->dob }}">
            </div>
          </div>
      </div>
      <div class="form-group row align-items-center">
        <label for="address" class="col-md-4 text-md-right">Address</label>
          <div class="col-md-6">
            <textarea rows="5" columns="5" id="address" name="address" value="{{ $user->address }}">{{ $user->address }}</textarea>
          </div>
      </div>
      
      <div class="btn-blk">
        <button type="submit" class="btn btn-primary mr-3">Confirm</button>
        <input type="reset" class="btn btn-secondary" value="Clear">
      </div>
    </form>
  </div>
@endsection
<script>
  function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];
    if(file) {
      var reader = new FileReader();
      reader.onload = function() {
        $("#previewImg").attr("src",reader.result);
      }
      reader.readAsDataURL(file);
    }
  }
</script>