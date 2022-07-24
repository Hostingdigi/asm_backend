@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Edit Product - {{ ucwords($product->name) }}

            <a href="{{ route('admin.products.index') }}" class="btn btn-primary float-right">
                <i class="fa fa-arrow-left"></i>
                BACK
            </a>
        </x-slot>

        <x-slot name="body">
            <form method="post" action="{{ route('admin.products.update',$product->id) }}" id="editProductForm" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="sup">Supplier</label>
                        <select required class="form-control" name="sup" required>
                            @foreach($sup as $su)
                            <option @if($product->user_id==$su->id) selected @endif value="{{ $su->id }}">{{ $su->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="exampleFormControlInput1">Category</label>
                        <select required class="form-control" name="category" required>
                            @foreach($category as $c)
                            <option @if($product->category_id==$c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="exampleFormControlInput1">Brand</label>
                        <select required class="form-control" name="brand">
                            @foreach($brand as $b)
                            <option @if($product->brand_id==$b->id) selected @endif value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="pro_code">Product Code</label>
                        <input class="form-control" value="{{ trim($product->code) }}" name="pro_code" type="text" placeholder="Enter product code">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <br>
                        <label class="form-label" for="pro_name">Name</label>
                        <input class="form-control" value="{{ trim($product->name) }}" required name="pro_name" type="name" placeholder="Enter product name">
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label" for="price">Price</label>
                        <input class="form-control" value="{{ trim($product->price) }}" required name="price" type="text" required data-rule-number="true" placeholder="Enter Product Price">
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label" for="pro_unit">Unit</label>
                        <select required class="form-control" name="pro_unit">
                            @foreach($unit as $u)
                            <option @if($product->unit==$u['id']) selected @endif value="{{ $u['id'] }}">{{ $u['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label" for="pro_image">Cover Image</label>
                        <input class="" name="pro_image" type="file">
                        @if(!empty($product->cover_image))
                        <br>
                        <br>
                        <img width="65" height="65" src="{{ url('img/'.$product->cover_image) }}">
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <br>
                        <label class="form-label" for="pro_desc">Description</label>
                        <textarea class="form-control" name="pro_desc" rows="3">{{ trim($product->description) }}</textarea>
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

        $("#editProductForm").validate({});
    });
</script>
@endpush
