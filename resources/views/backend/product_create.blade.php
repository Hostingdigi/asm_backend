@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Create New Product

            <a href="{{ route('admin.products.index') }}" class="btn btn-primary float-right">
                <i class="fa fa-arrow-left"></i>
                BACK
            </a>
        </x-slot>

        <x-slot name="body">
            <form method="post" action="{{ route('admin.products.store') }}" id="createProductForm" enctype="multipart/form-data">
                        {{csrf_field()}}
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="sup">Supplier</label>
                        <select required class="form-control" name="sup" required>
                            @foreach($sup as $su)
                            <option value="{{ $su->id }}">{{ $su->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="exampleFormControlInput1">Category</label>
                        <select required class="form-control" name="category" required>
                            @foreach($category as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="exampleFormControlInput1">Brand</label>
                        <select required class="form-control" name="brand">
                            @foreach($brand as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="pro_code">Product Code</label>
                        <input class="form-control" name="pro_code" type="text" placeholder="Enter product code">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <br>
                        <label class="form-label" for="pro_name">Name</label>
                        <input class="form-control" required name="pro_name" type="name" placeholder="Enter product name">
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label" for="price">Price</label>
                        <input class="form-control" required name="price" type="text" required data-rule-number="true" placeholder="Enter Product Price">
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label" for="pro_unit">Unit</label>
                        <select required class="form-control" name="pro_unit">
                            @foreach($unit as $u)
                            <option value="{{ $u['id'] }}">{{ $u['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label" for="pro_image">Cover Image</label>
                        <input class="" name="pro_image" type="file">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <br>
                        <label class="form-label" for="pro_desc">Description</label>
                        <textarea class="form-control" name="pro_desc" rows="3"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col" align="right">
                        <br>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
<script>
    $(document).ready( function () {

        $("#createProductForm").validate({});
    });
</script>
@endpush
