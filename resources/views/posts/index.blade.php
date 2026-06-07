<x-layout title="Pixl-Feed">
    <div class="h-full">
        <nav class="overflow-x-auto [scrollbar-width:none]">
            <ul class="flex justify-end gap-4">
                <li><a href="" class="hover:text-pixl-light text-pixl-light/50">Home</a></li>
                <li><a href="" class="hover:text-pixl-light text-pixl-light/50">Idea streaming</a></li>
                <li><a href="" class="hover:text-pixl-light text-pixl-light/50">Following</a></li>
            </ul>
        </nav>
    </div>
    <div class="flex gap-2 mb-4">
        <img class="size-10 object-cover"
             src="{{$profile->avatar_url}}"
             alt="">
       <x-post-form
        :label="'Post Body'"
        :name="'content'"
        :placeHolder="'What\'s on ' . $profile->handle . '?'"
        :action="route('posts.store')"
       >


       </x-post-form>
{{--        @include('partials.post-form', [--}}
{{--    'label' => 'Post Body',--}}
{{--     'name' => 'post-body',--}}
{{--      'placeHolder' => "What's on your mind?"])--}}
    </div>
    <!--Thread replies start-->
    <ol class="">
        @forelse($posts as $post)
            <x-post :post="$post"></x-post>

{{--            @include('partials.item-feed')--}}
        @empty
        @endforelse
    </ol>
    <!--Thread replies end-->


</x-layout>
