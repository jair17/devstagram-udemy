<div>
    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach($posts as $post)
                <div>
                    <a href="{{route('posts.show',[$post->user,$post])}}">
                        <img src="{{asset('uploads').'/'.$post->image}}"
                             alt="{{__('Post\'s Image ').$post->title}}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10 ">
            {{$posts->links()}}
        </div>
    @else
        <p class="text-center ">{{__('None posts')}}</p>
    @endif
</div>
