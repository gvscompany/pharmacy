@extends('layouts.app')

@section('title', 'Trashed Manufacturers')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Trashed Manufacturers</li>
    </ol>
@endsection

@section('content')
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
                        <th scope="col">Restore</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($trashed_manufacturers) && is_object($trashed_manufacturers))
                        @foreach($trashed_manufacturers as $trashed_manufacturer)
                            <tr>
                                <th scope="row">{{ $trashed_manufacturer->id }}</th>
                                <td>{{ $trashed_manufacturer->name }}</td>
                                <td>{{ $trashed_manufacturer->created_at }}</td>
                                <td>{{ $trashed_manufacturer->updated_at }}</td>
                                <td>
                                    <a href="{{ route('manufacturer.restore', ['id'=>$trashed_manufacturer->id]) }}" class="btn btn-outline-success" role="button">
                                        <i class="fa fa-fw fa-repeat"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('manufacturer.delete',['id'=>$trashed_manufacturer->id]) }}" id="manuf_del_form_{{ $trashed_manufacturer->id }}" method="post" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <button type="submit" form="manuf_del_form_{{ $trashed_manufacturer->id }}" class="btn btn-outline-danger">
                                        <i class="fa fa-fw fa-close"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            @if(isset($trashed_manufacturers) && is_object($trashed_manufacturers))
                {{ $trashed_manufacturers->links() }}
            @endif
        </div>
    </div>
@endsection
