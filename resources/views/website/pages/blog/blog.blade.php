@extends('website.layouts.master')

@section('content')

<div class="blogs site-padding">
    <div class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 gap-10">
        @foreach ($blogs as $blog)
        <div class="">
            <div class="my-8">
                <div
                    class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden  shadow-sm hover:shadow-lg">
                    <a href="{{route('blog.single',['slug'=>$blog->slug])}}"><img src="{{$blog->image}}"
                            class="blog-image"></a>
                    <div class="p-6">
                        <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-2"></h2>
                        <a href="{{route('blog.single',['slug'=>$blog->slug])}}">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-1">
                                {{Str::limit($blog->title, 30)}}</h1>
                        </a>
                        <a href="{{route('blog.single',['slug'=>$blog->slug])}}"
                            class="btn btn-primary btn-block mt-3">View Post</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
