@extends('layouts.app')

@section('title', 'Edit manufacturers')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('manufacturer.index') }}">Manufacturers</a></li>
        <li class="breadcrumb-item active">Edit manufacturer</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            @if(isset($updatable_manufacturer) && is_object($updatable_manufacturer))
            <form action="{{ route('manufacturer.update', ['id'=>$updatable_manufacturer->id]) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Manufacturer new name</label>
                    <input type="text" class="form-control" name="name" value="{{ $updatable_manufacturer->name }}" id="name">
                </div>
                <button type="submit" class="btn btn-success">Update manufacturer</button>
            </form>
            @endif
        </div>
    </div>
@endsection
