<x-layout>
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
        <img class="size-10 object-cover" src="/images/avatar.png" alt="">

        <form action="" class="mt-4 grow">
            <label for="post" class="sr-only">Post body</label>
            <div class="flex gap-2 justify-start items-center">
                <textarea cols="30" rows="5" id="post" class="border-none w-full resize-none"
                          placeholder="What's on your mind?"></textarea>
            </div>
            <div class="flex justify-between">
                <div class="flex gap-2 mt-2">
                    <button>
                        <svg class="w-8" viewBox="0 0 32 32" version="1.1" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M30 2.497h-28c-1.099 0-2 0.901-2 2v23.006c0 1.099 0.9 2 2 2h28c1.099 0 2-0.901 2-2v-23.006c0-1.099-0.901-2-2-2zM30 27.503l-28-0v-5.892l8.027-7.779 8.275 8.265c0.341 0.414 0.948 0.361 1.379 0.035l3.652-3.306 6.587 6.762c0.025 0.025 0.053 0.044 0.080 0.065v1.85zM30 22.806l-5.876-6.013c-0.357-0.352-0.915-0.387-1.311-0.086l-3.768 3.282-8.28-8.19c-0.177-0.214-0.432-0.344-0.709-0.363-0.275-0.010-0.547 0.080-0.749 0.27l-7.309 7.112v-14.322h28v18.309zM23 12.504c1.102 0 1.995-0.894 1.995-1.995s-0.892-1.995-1.995-1.995-1.995 0.894-1.995 1.995c0 1.101 0.892 1.995 1.995 1.995z"></path>
                        </svg>
                    </button>
                    <button>
                        <svg class="w-8" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6582 9.28638C18.098 10.1862 18.8178 10.6361 19.0647 11.2122C19.2803 11.7152 19.2803 12.2847 19.0647 12.7878C18.8178 13.3638 18.098 13.8137 16.6582 14.7136L9.896 18.94C8.29805 19.9387 7.49907 20.4381 6.83973 20.385C6.26501 20.3388 5.73818 20.0469 5.3944 19.584C5 19.053 5 18.1108 5 16.2264V7.77357C5 5.88919 5 4.94701 5.3944 4.41598C5.73818 3.9531 6.26501 3.66111 6.83973 3.6149C7.49907 3.5619 8.29805 4.06126 9.896 5.05998L16.6582 9.28638Z"
                                  stroke="#000000" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                <input type="submit" class="bg-pixl border border-transparent px-4 py-0.5 text-pixl-dark" value="Post">
            </div>
        </form>
    </div>
</x-layout>
