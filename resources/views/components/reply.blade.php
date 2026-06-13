<li class="flex gap-2 pt-4 relative group/li">
    <div class="absolute w-px h-full bg-pixl-light/10 left-5 top-0 group-last/li:h-4"></div>
    <img class="size-10 object-cover isolate" src="{{$reply->profile->avatar_url}}" alt="">
    <div class="border-t border-pixl-light/10 grow">
        <!--Thread meta user data start-->
        <div class="flex gap-2 items-center">
            <div class="mt-4 grow text-pixl-light/50 pb-4">
                <div class="flex gap-2 justify-between">
                    <div class="flex gap-2">
                        <a href="{{route('profiles.show', $reply->profile)}}" class="hover:underline !text-pixl-light/50">{{$reply->profile->display_name}}</a>
                        <a href="{{route('posts.show', [$reply->profile, $reply])}}" class="text-sm text-pixl-light/50 hover:text-pixl-light">{{$reply->created_at->diffForHumans()}} {{"@{$reply->profile->handle}"}}</a>
                    </div>
                </div>
            </div>
        </div>
        <!--Thread meta user data end-->

        <p class="mt-3">{{$reply->content}}</p>
        @if($showEngagement)
            <div class="flex justify-between">
                <!--Meta action start-->
                <div class="flex justify-between mt-4">
                    <div class="flex justify-between">
                        <div class="flex gap-6">
                            <x-like-button :post="$reply"></x-like-button>
                            <x-reply-button :post="$reply"></x-reply-button>
                            <x-repost-button :post="$reply"></x-repost-button>
                        </div>
                    </div>
                </div>
                <!--Meta action end-->

                <!--Meta right action start-->
                <div class="flex justify-between">
                    <div class="flex gap-4">
                        <x-save-button :id="$reply->id"></x-save-button>
                        <x-share-button :id="$reply->id"></x-share-button>
                    </div>
                </div>
                <!--Meta right action end-->
            </div>

        @endif
        @if($showReplies)
            <ol class="">
                @forelse($reply->replies as $reply)
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

</li>
