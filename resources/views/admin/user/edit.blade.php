@extends('layouts.admin')

@section('title','Cập nhật nhóm sản phẩm')

@section('content')
    <form action="{{route('admin.usermanagement.update',$user->id)}}" method='post'>
        @csrf @method('PUT')
        <div class="form-group">
          <label for="user">user </label>
          <input type="text" value="{{$user->name}}" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Tên user">
          @error('name')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="email">email</label>
          <select class="form-control" name="email" id="email">
            <option value=1 @if ($user->email=="fixed") selected='selected' @endif>fixed</option>
            <option value=0 @if ($user->email=="percent") selected='selected' @endif>percent</option>
          </select>
        </div>
        <div class="form-group">
          <label for="status">status</label>
          <input type="number" status="{{$user->status}}" class="form-control" name="status" id="status" aria-describedby="helpId" placeholder="status">
          @error('status')
          <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group">
            <label for="level">Cart Value</label>
            <input type="number" value="{{$user->level}}" class="form-control" name="level" id="level" aria-describedby="helpId" placeholder="level">
            @error('level')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
