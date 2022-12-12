@extends('frontend.layout.master-layout')
@php
$a = 1;
@endphp
@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    <form method="POST" action="{{ route('cart.store', $article->id) }}" class="form">
        @csrf
        <div class="form-group">
            <label>Số lượng</label>
            <input type="number" class="form-control" name="qty">
        </div>
        <button class="btn btn-success">Add to cart</button>
    </form>
</div>
@endsection
@push('style')
@endpush
@push('script')
@endpush