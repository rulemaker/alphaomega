@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
		<p>Are you sure you want to delete this <strong>{{$marital->marital_name}}</strong> marital status?</p>
    {{-- Delete Marital Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($marital)){{ URL::to('maritals/' . $marital->marital_id . '/delete') }}@endif" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="marital_id" value="{{ $marital->marital_id }}" />
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="controls">
            <element class="btn-cancel close_popup">Cancel</element>
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
        <!-- ./ form actions -->
    </form>
@stop