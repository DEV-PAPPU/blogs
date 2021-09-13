@extends('admin.layouts.master')

@section('page-title')
<p>All catrgorys</p>
@endsection


@section('content')

<div class="catrgory-categoy">

    <category-index :categories="{{$categories}}"></category-index>
</div>

@endsection
