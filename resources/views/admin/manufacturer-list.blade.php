@extends('layouts.app')

@section('title', 'Manufacturers')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Manufacturers</li>
    </ol>
@endsection

@section('content')
    <div class="row my-2">
        <div class="col-12">
            <a href="{{ route('manufacturer.create') }}" class="btn btn-success float-right" role="button">
                <i class="fa fa-fw fa-plus"></i>
                Add new manufacturer
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
                    @if(isset($manufacturers) && is_object($manufacturers))
                        @foreach($manufacturers as $manufacturer)
                            <tr>
                                <th scope="row">{{ $manufacturer->id }}</th>
                                <td>{{ $manufacturer->name }}</td>
                                <td>{{ $manufacturer->created_at }}</td>
                                <td>{{ $manufacturer->updated_at }}</td>
                                <td>
                                    <a href="{{ route('manufacturer.edit', ['id'=>$manufacturer->id]) }}" class="btn btn-outline-info" role="button">
                                        <i class="fa fa-fw fa-pencil-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('manufacturer.destroy', ['id'=>$manufacturer->id]) }}" id="manuf_del_form_{{ $manufacturer->id }}" method="post" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <button type="submit" form="manuf_del_form_{{ $manufacturer->id }}" class="btn btn-outline-danger">
                                        <i class="fa fa-fw fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            @if(isset($manufacturers) && is_object($manufacturers))
                {{ $manufacturers->links() }}
            @endif
        </div>
    </div>
@endsection
