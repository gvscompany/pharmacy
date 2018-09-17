@extends('layouts.app')

@section('title', 'Trashed Purposes')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Trashed Purposes</li>
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
                    @if(isset($trashed_purposes) && is_object($trashed_purposes))
                        @foreach($trashed_purposes as $trashed_purpose)
                            <tr>
                                <th scope="row">{{ $trashed_purpose->id }}</th>
                                <td>{{ $trashed_purpose->name }}</td>
                                <td>{{ $trashed_purpose->created_at }}</td>
                                <td>{{ $trashed_purpose->updated_at }}</td>
                                <td>
                                    <a href="{{ route('purpose.restore', ['id'=>$trashed_purpose->id]) }}" class="btn btn-outline-success" role="button">
                                        <i class="fa fa-fw fa-repeat"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('purpose.delete',['id'=>$trashed_purpose->id]) }}" id="purp_del_form_{{ $trashed_purpose->id }}" method="post" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <button type="submit" form="purp_del_form_{{ $trashed_purpose->id }}" class="btn btn-outline-danger">
                                        <i class="fa fa-fw fa-close"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            @if(isset($trashed_purposes) && is_object($trashed_purposes))
                {{ $trashed_purposes->links() }}
            @endif
        </div>
    </div>
@endsection
