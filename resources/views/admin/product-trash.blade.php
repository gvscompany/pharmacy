@extends('layouts.app')

@section('style')
    <style>
        .product-poster {
            width: 60px;
            height: 50px;
        }
        .availab_yes {
            font-size: 30px;
            color: lawngreen;
        }
        .availab_no {
            font-size: 30px;
            color: red;
        }
    </style>
@endsection

@section('title', 'Trashed products')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Trashed products</li>
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
                        <th scope="col">Poster</th>
                        <th scope="col">Name</th>
                        <th scope="col">Manufacturer</th>
                        <th scope="col">Purpose</th>
                        <th scope="col">Price</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Available</th>
                        <th scope="col">Restore</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($trashed_products) && is_object($trashed_products))
                        @foreach($trashed_products as $trashed_product)
                            <tr>
                                <th scope="row">{{ $trashed_product->id }}</th>
                                <td>
                                    @if($trashed_product->poster)
                                        <img src="{{ asset('images') . '/' . $trashed_product->poster }}" alt="{{ $trashed_product->name }}" class="product-poster">
                                    @else
                                        <img src="{{ asset('images/default-medicine.jpg') }}" alt="default-medicine-img" class="product-poster">
                                    @endif
                                </td>
                                <td>{{ $trashed_product->name }}</td>
                                <td>{{ $trashed_product->manufacturer->name }}</td>
                                <td>{{ $trashed_product->purpose->name }}</td>
                                <td>{{ $trashed_product->price }}</td>
                                <td>{{ $trashed_product->from }}</td>
                                <td>{{ $trashed_product->to }}</td>
                                <td>@if ($trashed_product->available) <i class="fa fa-check-circle-o availab_yes"></i> @else <i class="fa fa-minus-circle availab_no"></i> @endif</td>
                                <td>
                                    <a href="{{ route('product.restore', ['id'=>$trashed_product->id]) }}" class="btn btn-outline-info btn-sm" role="button">
                                        <i class="fa fa-fw fa-repeat"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('product.delete', ['id'=>$trashed_product->id]) }}" id="prod_del_form_{{ $trashed_product->id }}" method="post" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <button type="submit" form="prod_del_form_{{ $trashed_product->id }}" class="btn btn-outline-danger btn-sm">
                                        <i class="fa fa-fw fa-close"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            @if(isset($trashed_products) && is_object($trashed_products))
                {{ $trashed_products->links() }}
            @endif
        </div>
    </div>
@endsection
