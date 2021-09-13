@extends('website.layouts.master')

@section('content')

<div class="blogs site-padding">
    <div class="grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-2 gap-10">

        <div class="post-detail">
            <div class="post-image">
                <img src="{{$blog->image}}" class="blog-image">
            </div>
            <h4 class="title mt-5"> {{$blog->title}}</h4>
            <div class="mt-3 mb-5">
                <h5>Post Description</h5>
                <p class="description"> {{$blog->description}}</p>
            </div>

            <post-comment :post_id="{{$blog->id}}"></post-comment>

            <div class="mt-10">
                <post-comment-show :post_id="{{$blog->id}}"></post-comment-showp>
            </div>
        </div>

        <div class="related-post">

            <div class="related-header bg-black text-center pt-2 pb-1 text-white mb-2 btn-primary">
                <h4>Related Blogs</h4>
            </div>

            @foreach ($related_post as $blog)
            <div class="">
                <div
                    class="border-2 mb-4 border-gray-200 border-opacity-60 rounded-lg overflow-hidden  shadow-sm hover:shadow-2xl">
                    <a href="{{route('blog.single',['slug'=>$blog->slug])}}"><img src="{{$blog->image}}"
                            class="blog-image"></a>
                    <div class="p-6">
                        <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-2"></h2>
                        <a href="{{route('blog.single',['slug'=>$blog->slug])}}">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-1">
                                {{Str::limit($blog->title, 30)}}</h1>
                        </a>
                        {{$blog->category->name}}

                        <a href="{{route('blog.single',['slug'=>$blog->slug])}}"
                            class="btn btn-primary btn-block mt-3">View Post</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection

@section('style')

<style>

@media only screen and (max-width: 4000px) and (min-width: 1150px)  {

    .post-detail {
    width: 800px !important;
}

.related-post {
    width: 300px !important;
    margin-left: 270px;
}

}


</style>

@endsection
