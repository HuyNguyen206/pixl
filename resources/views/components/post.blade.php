<li class="border-t border-t-pixl-light/10 pt-4">
    <div class="flex gap-2">
        <img class="size-10 object-cover" src="{{$post->profile->avatar_url}}" alt="">
        <div class="mt-4 grow text-pixl-light/50 pb-4">
            <div class="flex gap-2 justify-between">
                <div class="flex gap-2">
                    <a href="{{route('profiles.show', $post->profile)}}" class="hover:underline !text-pixl-light/50">{{$post->profile->display_name}}</a>
                    <a href="{{route('posts.show', [$post->profile, $post])}}" class="text-sm text-pixl-light/50 hover:text-pixl-light">{{$post->created_at->diffForHumans()}} {{"@{$post->profile->handle}"}}</a>
                </div>
                <button class="flex gap-1 py-2 group">
                    <span class="bg-pixl-light/50 size-1 group-hover:bg-pixl-light/70"></span>
                    <span class="bg-pixl-light/50 size-1 group-hover:bg-pixl-light/70"></span>
                    <span class="bg-pixl-light/50 size-1 group-hover:bg-pixl-light/70"></span>

                </button>
            </div>
            <p class="mt-3 [&_a]:text-pixl [&_a]:hover:underline">
            {{$post->content}}
            @if($post->parentRepost)
                <blockquote class="p-4 my-4 border-s-4 border-default bg-neutral-secondary-soft">
                    <p class="text-xl italic font-medium leading-relaxed text-heading">
                    <x-post
                        :post="$post->parentRepost"
                        :show-engagement="false"
                        />
                    <p/>
                </blockquote>
                @endif

                </p>
            @if($showEngagement)
                <div class="flex justify-between mt-4 pb-4">

                        <!--Meta left action start-->
                        <div class="flex justify-between">
                            <div class="flex gap-6">
                            <x-like-button :post="$post"></x-like-button>
                            <x-reply-button :post="$post"></x-reply-button>
                            <x-repost-button :post="$post"></x-repost-button>
                            </div>
                        </div>
                        <!--Meta left action end-->


                    <!--Meta right action start-->
                    <div class="flex justify-between">
                        <div class="flex gap-4">
                            <x-save-button :id="$post->id"></x-save-button>
                            <x-share-button :id="$post->id"></x-share-button>
                        </div>
                    </div>
                    <!--Meta right action end-->
                </div>
            @endif
{{--            @dd($post)--}}
            <x-reply-form :post="$post"></x-reply-form>
            @if($showReplies)
                    <ol class="">
                        @forelse($post->replies as $reply)
                            <x-reply
                                :reply="$reply"
                                :show-engagement="$showEngagement"
                                :show-replies="$showReplies"

                            />
{{--                            @include('partials.feed-item-reply')--}}
                        @empty
                        @endforelse
                    </ol>
            @endif

        </div>
    </div>
</li>
