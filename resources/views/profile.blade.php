<x-layout>

<a href="" class="flex gap-2 group">
        <div class="text-pixl-light/40"><<</div>
        <span class="group-hover:underline">
back
            </span>
    </a>

    <img src="/public/images/cover.png" alt="">

    <div class="-mt-20 flex flex-col gap-5 [&_a]:text-pixl [&_a]:hover:underline">
        <!--       User profile start-->
        <div class="flex flex-wrap flex-row justify-between gap-2 items-end">
            <div class="flex gap-4 items-end">
                <img class="md:size-30 lg:40 size-20 object-cover" src="/images/adelle.png" alt="">
                <div class="flex flex-col gap-2">
                    <p>_adelle</p>
                    <p class="text-pixl-light/40">@tydsss</p>
                </div>
            </div>
            <a href="#" class="bg-pixl-light/10 border border-transparent px-4 py-0.5">Edit profile</a>
        </div>
        <!--       User profile end-->

        <p>I design <a href="#">@Laracasts</a> so hit me up whenever =]</p>
        <div class="flex gap-6 text-sm">
            <div class="flex gap-2">
                <p>100</p>
                <p class="text-pixl-light/40">Following</p>
            </div>
            <div class="flex gap-2">
                <p>2190</p>
                <p class="text-pixl-light/40">Followers</p>
            </div>
        </div>

        <!-- Navigation tab-->
        <ul class="flex gap-6 justify-end">
            <li>
                <a href="" class="text-pixl-light/60!">Posts</a>
            </li>
            <li>
                <a href="" class="text-pixl-light/60!">Replies</a>
            </li>
            <li>
                <a href="" class="text-pixl-light/60!">Highlight</a>
            </li>
            <li>
                <a href="" class="text-pixl-light/60!">Inspiration</a>
            </li>
            <li>
                <a href="" class="text-pixl-light/60!">Stream</a>
            </li>
        </ul>
        <!-- Navigation end tab-->

    </div>
</x-layout>
