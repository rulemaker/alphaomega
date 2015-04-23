@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<p>Are you sure you want to delete this <strong>{{$user->username}}</strong> user?</p>
  {{-- Delete User Form --}}
  <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('users/' . $user->id . '/delete') }}@endif" autocomplete="off">
      <!-- CSRF Token -->
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <input type="hidden" name="id" value="{{ $user->id }}" />
      <!-- ./ csrf token -->

      <!-- Form Actions -->
      <div class="controls">
          <element class="btn-cancel close_popup">Cancel</element>
          <button type="submit" class="btn btn-danger">Delete</button>
      </div>
      <!-- ./ form actions -->
  </form>
@stop