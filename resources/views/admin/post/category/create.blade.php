@extends('admin.layouts.master')

@section('page-title')
<p>Create Post</p>
@endsection


@section('content')

<div class="catrgory-categoy">
    <category-create :categories="{{$categories}}"></category-create>
</div>

@endsection
