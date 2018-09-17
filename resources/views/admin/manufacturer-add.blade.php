@extends('layouts.app')

@section('title', 'Add manufacturers')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('manufacturer.index') }}">Manufacturers</a></li>
        <li class="breadcrumb-item active">Add manufacturers</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <form action="{{ route('manufacturer.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Manufacturer name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Enter name">
                </div>
                <button type="submit" class="btn btn-success">Save manufacturer</button>
            </form>
        </div>
    </div>
@endsection
