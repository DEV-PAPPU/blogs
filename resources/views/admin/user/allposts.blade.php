@extends('admin.layouts.master')

@section('page-title')
<p>Create Post</p>
@endsection


@section('content')

<div class="user-post-categoy">
    <user-post-create :user_posts="{{$user_posts}}"></user-post-create>
</div>

@endsection
