<x-layout.layout title="Pixl-Profile">

<a href="" class="flex gap-2 group">
        <div class="text-pixl-light/40"><<</div>
        <span class="group-hover:underline">
back
            </span>
    </a>

    <img src="{{$profile->cover_url}}" alt="">

    <div class="-mt-20 flex flex-col gap-5 [&_a]:text-pixl [&_a]:hover:underline">
     <x-profile.header :profile="$profile" />

            <ul class="flex flex-col gap-2">
                @forelse($posts as $post)
                    <x-post
                        :post="$post"
                        :show-engagement="true"
                        :show-replies="true"
                    />
{{--                    @include('partials.profile.post', compact('profile'))--}}
                @empty
                @endforelse
            </ul>
    </div>
</x-layout.layout>
