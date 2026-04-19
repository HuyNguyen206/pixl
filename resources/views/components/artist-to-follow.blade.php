<div class="mt-10 border border-pixl/50">
    <h2 class="text-sm text-pixl-light/60 p-2">Artist to follow</h2>
    <ol class="flex flex-col gap-2">
        @forelse($artists as $artist)
            <li class="flex gap-3 items-center justify-between p-2">
                <div class="flex gap-1 items-center">
                    <img class="w-10 object-cover" src="/public/images/avatar.png" alt="">
                    <p class="text-sm truncate">Alessia draw</p>
                </div>
                <button class="bg-pixl-dark/50 hover:bg-pixl-dark/75 border border-pixl/50 hover:border-pixl/75 active:border-pixl/85 px-4 py-1.5 text-pixl text-sm">
                    follow
                </button>
            </li>
        @empty
            <li>No Data</li>
        @endforelse
    </ol>
    <a href="#" class="text-sm text-pixl-light/60 p-2">Show more</a>

</div>
