@extends('layouts.app')
@section('title','Tambah Produk')
@section('content')
  <h1>Tambah Produk</h1>
  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @include('admin.products.form')
  </form>
@endsection
