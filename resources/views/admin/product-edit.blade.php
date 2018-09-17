@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <style>
        .product-poster {
            width: 100px;
        }
    </style>
@endsection

@section('title', 'Edit product')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Purposes</a></li>
        <li class="breadcrumb-item active">Edit product</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            @if(isset($purposes) && isset($manufacturers) && isset($updatable_product) && is_object($purposes) && is_object($manufacturers) && is_object($updatable_product))
            <form action="{{ route('product.update', ['id'=>$updatable_product->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Product name</label>
                    <input type="text" name="name" class="form-control" value="{{ $updatable_product->name }}" id="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    @if($updatable_product->poster)
                        <img src="{{ asset('images') . '/' . $updatable_product->poster }}" alt="{{ $updatable_product->name }}" class="product-poster">
                    @else
                        <img src="{{ asset('images/default-medicine.jpg') }}" alt="default-medicine-img" class="product-poster">
                    @endif
                    <input type="hidden" name="old_poster" value="{{ $updatable_product->poster ?? null }}">
                </div>
                <div class="form-group">
                    <label for="product_poster">Product poster</label>
                    <div class="custom-file">
                        <input type="file" name="poster" class="custom-file-input" id="product_poster">
                        <label class="custom-file-label" id="custom-file-label" for="product_poster">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="manufacturer-list">Product manufacturer</label>
                    <select name="manufacturer_id" class="custom-select manufacturer-list" id="manufacturer-list">
                        <option value="">Choose manufacturer</option>
                        @foreach($manufacturers as $manufacturer)
                        <option value="{{ $manufacturer->id }}" {{ $updatable_product->manufacturer_id == $manufacturer->id ? 'selected' : '' }}>
                            {{ $manufacturer->name }}
                         </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="purpose-list">Product purpose</label>
                    <select name="purpose_id" class="custom-select purpose-list" id="purpose-list">
                        <option value="">Choose purpose</option>
                        @foreach($purposes as $purpose)
                        <option value="{{ $purpose->id }}" {{ $updatable_product->purpose_id == $purpose->id ? 'selected' : '' }}>
                            {{ $purpose->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Product available</label> <br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="yes" value="yes" {{ ($updatable_product->available) ? 'checked':'' }} name="available" class="custom-control-input">
                        <label class="custom-control-label yes" for="yes">Present</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="no" value="no" {{ ($updatable_product->available) ? '':'checked' }} name="available" class="custom-control-input">
                        <label class="custom-control-label no" for="no">Absent</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_poster">Product price</label>
                    <div class="product_price">
                        <input type="text" name="price" value="{{ $updatable_product->price }}" class="form-control" id="product_price" placeholder="Enter price">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="from">From</label>
                        <div class="input-group date" id="date_from" data-target-input="nearest">
                            <input type="text" name="from" value="{{ $updatable_product->from }}" id="to" class="form-control datetimepicker-input" data-target="#date_from">
                            <div class="input-group-append" data-target="#date_from" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <label for="to">To</label>
                    <div class="input-group date" id="date_to" data-target-input="nearest">
                        <input type="text" name="to" id="to" value="{{ $updatable_product->to }}" class="form-control datetimepicker-input" data-target="#date_to">
                        <div class="input-group-append" data-target="#date_to" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_description">Product description</label>
                    <textarea name="description" class="form-control" id="product_description" rows="5">{{ $updatable_product->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-success mb-5">Update product</button>
            </form>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        $('#product_poster').on('change',function(){
            var fileName = $(this).val();
            $(this).next('#custom-file-label').html(fileName);
        });

        $(function () {
            $('#date_from').datetimepicker({
                format: 'Y/MM/DD'
            });
        });

        $(function () {
            $('#date_to').datetimepicker({
                format: 'Y/MM/DD'
            });
        });
    </script>
@endsection
