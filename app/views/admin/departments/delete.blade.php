@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
		<p>Are you sure you want to delete this <strong>{{$department->department_name}}</strong> department?</p>
    {{-- Delete Department Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($department)){{ URL::to('departments/' . $department->department_id . '/delete') }}@endif" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="department_id" value="{{ $department->department_id }}" />
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="controls">
            <element class="btn-cancel close_popup">Cancel</element>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
        <!-- ./ form actions -->
    </form>
@stop