<x-layout title="Pixl-Profile">

    <a href="" class="flex gap-2 group">
        <div class="text-pixl-light/40"><<</div>
        <span class="group-hover:underline">
back
            </span>
    </a>

    <img src="{{$post->profile->cover_url}}" alt="">

    <div class="-mt-20 flex flex-col gap-5 [&_a]:text-pixl [&_a]:hover:underline">
        <x-profile.header :profile="$post->profile" />

        <ul class="flex flex-col gap-2">
          <x-post :post="$post" :show-replies="true" :show-engagement="true"/>
        </ul>
    </div>
</x-layout>
