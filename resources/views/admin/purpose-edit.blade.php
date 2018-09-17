@extends('layouts.app')

@section('title', 'Edit purpose')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purpose.index') }}">Purposes</a></li>
        <li class="breadcrumb-item active">Edit purpose</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            @if(isset($updatable_purpose) && is_object($updatable_purpose))
            <form action="{{ route('purpose.update', ['id'=>$updatable_purpose->id]) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Purpose new name</label>
                    <input type="text" class="form-control" name="name" value="{{ $updatable_purpose->name }}" id="name">
                </div>
                <button type="submit" class="btn btn-success">Update purpose</button>
            </form>
            @endif
        </div>
    </div>
@endsection
