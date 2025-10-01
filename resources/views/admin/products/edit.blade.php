@extends('layouts.app')
@section('title','Edit Produk')
@section('content')
  <h1>Edit Produk</h1>
  <form action="{{ route('admin.products.update',$product) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.products.form')
  </form>
@endsection
