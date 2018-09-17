@extends('layouts.app')

@section('title', 'Purposes')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Purposes</li>
    </ol>
@endsection

@section('content')
    <div class="row my-2">
        <div class="col-12">
            <a href="{{ route('purpose.create') }}" class="btn btn-success float-right" role="button">
                <i class="fa fa-fw fa-plus"></i>
                Add new purpose
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Edit</th>
                        <th scope="col">In trash</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($purposes) && is_object($purposes))
                        @foreach($purposes as $purpose)
                            <tr>
                                <th scope="row">{{ $purpose->id }}</th>
                                <td>{{ $purpose->name }}</td>
                                <td>{{ $purpose->created_at }}</td>
                                <td>{{ $purpose->updated_at }}</td>
                                <td>
                                    <a href="{{ route('purpose.edit', ['id'=>$purpose->id]) }}" class="btn btn-outline-info" role="button">
                                        <i class="fa fa-fw fa-pencil-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('purpose.destroy', ['id'=>$purpose->id]) }}" id="purp_del_form_{{ $purpose->id }}" method="post" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <button type="submit" form="purp_del_form_{{ $purpose->id }}" class="btn btn-outline-danger">
                                        <i class="fa fa-fw fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            @if(isset($purposes) && is_object($purposes))
                {{ $purposes->links() }}
            @endif
        </div>
    </div>
@endsection
