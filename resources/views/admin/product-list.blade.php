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

@section('title', 'Products')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Products</li>
    </ol>
@endsection

@section('content')
    <div class="row my-2">
        <div class="col-12">
            <a href="{{ route('product.create') }}" class="btn btn-success float-right" role="button">
                <i class="fa fa-fw fa-plus"></i>
                Add new product
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
                        <th scope="col">Poster</th>
                        <th scope="col">Name</th>
                        <th scope="col">Manufacturer</th>
                        <th scope="col">Purpose</th>
                        <th scope="col">Price</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Available</th>
                        <th scope="col">Edit</th>
                        <th scope="col">In trash</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($products) && is_object($products))
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>
                                    @if($product->poster)
                                        <img src="{{ asset('images') . '/' . $product->poster }}" alt="{{ $product->name }}" class="product-poster">
                                    @else
                                        <img src="{{ asset('images/default-medicine.jpg') }}" alt="default-medicine-img" class="product-poster">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->manufacturer->name }}</td>
                                <td>{{ $product->purpose->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->from }}</td>
                                <td>{{ $product->to }}</td>
                                <td>@if ($product->available) <i class="fa fa-check-circle-o availab_yes"></i> @else <i class="fa fa-minus-circle availab_no"></i> @endif</td>
                                <td>
                                    <a href="{{ route('product.edit', ['id'=>$product->id]) }}" class="btn btn-outline-info btn-sm" role="button">
                                        <i class="fa fa-fw fa-pencil-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('product.destroy', ['id'=>$product->id]) }}" id="prod_del_form_{{ $product->id }}" method="post" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                    <button type="submit" form="prod_del_form_{{ $product->id }}" class="btn btn-outline-danger btn-sm">
                                        <i class="fa fa-fw fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            @if(isset($products) && is_object($products))
                {{ $products->links() }}
            @endif
        </div>
    </div>
@endsection
