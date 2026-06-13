<nav class="">
    <ol class="flex flex-col gap-4">
        <li><a class="hover:underline" href="{{route('posts.index')}}">Home</a></li>
        <li><a class="hover:underline" href="">Explorer</a></li>
        <li class="-ml-4 flex items-center gap-2">
            <div class="bg-pixl size-2 shrink-0"></div>
            <a class="hover:underline" href="">Notifications</a>
        </li>
        <li><a class="hover:underline" href="">Lists</a></li>
        <li><a class="hover:underline" href="">Explorer</a></li>
        <li><a class="hover:underline" href="">Explorer</a></li>
        <li><a class="hover:underline" href="">Explorer</a></li>
        <li><a class="hover:underline" href="">Explorer</a></li>
        <li><a class="hover:underline" href="">Explorer</a></li>
        <li><a class="hover:underline" href="">Explorer</a></li>
        <li><a class="hover:underline" href="">Explorer</a></li>
    </ol>
</nav>
    <!--     Button   -->
    <div class="flex flex-col gap-4 pb-10">
        @if(!request()->routeIs('posts.index'))
        <button class="bg-pixl border border-transparent px-4 py-0.5 text-pixl-dark text-center">Post</button>
        @endif
        <div class="flex gap-4 pb-10">
            <img class="size-10 object-cover isolate" src="{{Vite::asset('resources/images/avatar.png')}}" alt="">
            <div class="flex flex-col gap-2">
                <p>_adrian</p>
                <p class="text-pixl-light/40">@tydsss</p>
            </div>
            <button class="flex gap-2">
                <span class="w-1 h-1 bg-pixl-light/20"></span>
                <span class="w-1 h-1 bg-pixl-light/20"></span>
                <span class="w-1 h-1 bg-pixl-light/20"></span>
            </button>
        </div>

    </div>
    <!--    Button end-->

