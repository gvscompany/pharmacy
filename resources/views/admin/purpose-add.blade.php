@extends('layouts.app')

@section('title', 'Add purpose')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purpose.index') }}">Purposes</a></li>
        <li class="breadcrumb-item active">Add purpose</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <form action="{{ route('purpose.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Purpose name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Enter name">
                </div>
                <button type="submit" class="btn btn-success">Save purpose</button>
            </form>
        </div>
    </div>
@endsection
