<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bookmarks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($posts->count())
                        @foreach($posts as $post)
                        <p>  {{$post->user->username}} {{$post->body}} </p>
                            @foreach($post->comments as $comment)
                                <p style="margin-left:4rem"> {{$comment->user->username}} {{$comment->commentbody}} </p>
                            @endforeach
                        <form action="{{ route('posts.comment', $post) }}" method="POST">
                            @csrf
                            <textarea name="commentbody" id="commentbody" cols="15" rows="1" placeholder="Viet binh luan"></textarea>
                            <button>Dang binh luan</button>
                        </form>
                        <form action="{{ route('posts.bookmark', $post) }}" method="POST">
                            @csrf
                            <button>Bookmark</button>
                        </form>
                        @endforeach
                    @else
                        <p>Khong co bai viet</p>
                    @endif
                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
