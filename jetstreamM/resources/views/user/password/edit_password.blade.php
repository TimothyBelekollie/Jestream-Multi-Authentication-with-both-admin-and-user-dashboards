@extends('user.user_master')

 @section('user')
 

<div class="row" style="padding: 20px;">
<div class="col-md-6">

<h3>Change Password</h3>
 <form action="{{route('password.update')}}" method="POST" >
  @csrf
   
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Current Password</label>
      <input id="current_password" type="password" name="oldpassword" class="form-control" >
      @error('oldpassword')
       <p style="color: red;font-weight:bold;">{{$message}}</p>   
      @enderror
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">New Password</label>
        <input id="password" type="password" name="password" class="form-control">
        @error('password')
        <p style="color: red; font-weight:bold">{{$message}}</p>   
       @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Comfirm Password</label>
        <input id="password_confirmation" type="password"  name="password_confirmation" class="form-control">
        @error('password_confirmation; font-weight:bold;')
        <p style="color: red">{{$message}}</p>   
       @enderror
    </div>

    <button type="submit" class="btn btn-primary">UPDATE</button>
  </form>
 </div>  {{-- end col-md-6 --}}
</div>   {{-- end row --}}


 @endsection

