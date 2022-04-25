<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('posts') }}" method="post" class="mb-4">
                        @csrf
                        <div class="mb-4">
                            <label for="body" class="sr-only"></label>
                            <textarea name="body" id="body" cols="30" rows="3" class="bg-gray-100 border-2 w-full p-2 rounded-lg @error('body') border-red-500 @enderror" placeholder="{{ auth()->user()->firstname }} ơi, bạn đang nghĩ gì thế?!"></textarea>
                            @error('body')
                                <div class="text-red-500 mt-2 text-sm">
                                    Bạn phải viết bài thì mới đăng được!
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class=" text-white px-4 py-2 rounded font-medium" style="background-color:blue">Đăng</button>
                        </div>
                    </form>

                        @if($posts->count())
                            @foreach($posts as $post)
                            <p>  {{$post->user->username}} {{$post->body}} </p>



                                @foreach($post->comments as $comment)
                                <!-- Comment vote -->
                                
                                    <div style="margin-left:4rem">
                                        <p> {{$comment->user->username}} {{$comment->commentbody}} </p>
                                        @if(!$comment->votedBy(Auth::user()))
                            <div class="flex items-center">
                                <form action="{{ route('comment.vote', ['comment' => $comment, 'vote' => 'up']) }}" method="POST" style="margin: 3px">
                                    @csrf 
                                    <button type="submit"> Up </button>
                                </form>
                                <form action="{{ route('comment.vote', ['comment' => $comment, 'vote' => 'down']) }}" method="POST" style="margin: 3px">
                                    @csrf 
                                    <button type="submit"> Down </button>
                                </form>

                                {{ $comment->commentvotes->where('vote','up')->count() - $comment->commentvotes->where('vote','down')->count() }}

                            </div>
                            @else
                                @if($comment->commentvotes->where('user_id', Auth::user()->id)->contains('vote','up'))
                                <div class="flex items-center">
                                    <form action="{{ route('comment.unvote', ['comment' => $comment]) }}" method="POST" style="margin: 3px">
                                        @csrf
                                        <button type="submit" style="color:red"> Up </button>
                                    </form>
                                    <form action="{{ route('comment.vote', ['comment' => $comment, 'vote' => 'down']) }}" method="POST" style="margin: 3px">
                                        @csrf 
                                        <button type="submit"> Down </button>
                                    </form>

                                    {{ $comment->commentvotes->where('vote','up')->count() - $comment->commentvotes->where('vote','down')->count() }}

                                </div>
                                @else
                                <div class="flex items-center">
                                    <form action="{{ route('comment.vote', ['comment' => $comment, 'vote' => 'up']) }}" method="POST" style="margin: 3px">
                                        @csrf 
                                        <button type="submit"> Up </button>
                                    </form>
                                    <form action="{{ route('comment.unvote', ['comment' => $comment]) }}" method="POST" style="margin: 3px">
                                        @csrf 
                                        <button type="submit" style="color:red"> Down </button>
                                    </form>

                                    {{ $comment->commentvotes->where('vote','up')->count() - $comment->commentvotes->where('vote','down')->count() }}

                                </div>
                                @endif
                            @endif
                                    </div>

                                @endforeach
                            <form action="{{ route('posts.comment', $post) }}" method="POST">
                                @csrf
                                <textarea name="commentbody" id="commentbody" cols="15" rows="1" placeholder="Viet binh luan"></textarea>
                                <button type="submit">Dang binh luan</button>
                            </form>
                            <form action="{{ route('posts.bookmark', $post) }}" method="POST">
                                @csrf
                                <button type="submit">Bookmark</button>
                            </form>
                            <!-- Post Vote -->
                            @if(!$post->votedBy(Auth::user()))
                            <div class="flex items-center">
                                <form action="{{ route('posts.vote', ['post' => $post, 'vote' => 'up']) }}" method="POST" style="margin: 3px">
                                    @csrf 
                                    <button type="submit"> Up </button>
                                </form>
                                <form action="{{ route('posts.vote', ['post' => $post, 'vote' => 'down']) }}" method="POST" style="margin: 3px">
                                    @csrf 
                                    <button type="submit"> Down </button>
                                </form>

                                {{ $post->postvotes->where('vote','up')->count() - $post->postvotes->where('vote','down')->count() }}

                            </div>
                            @else
                                @if($post->postvotes->where('user_id', Auth::user()->id)->contains('vote','up'))
                                <div class="flex items-center">
                                    <form action="{{ route('posts.unvote', ['post' => $post]) }}" method="POST" style="margin: 3px">
                                        @csrf 
                                        <button type="submit" style="color:red"> Up </button>
                                    </form>
                                    <form action="{{ route('posts.vote', ['post' => $post, 'vote' => 'down']) }}" method="POST" style="margin: 3px">
                                        @csrf 
                                        <button type="submit"> Down </button>
                                    </form>

                                    {{ $post->postvotes->where('vote','up')->count() - $post->postvotes->where('vote','down')->count() }}

                                </div>
                                @else
                                <div class="flex items-center">
                                    <form action="{{ route('posts.vote', ['post' => $post, 'vote' => 'up']) }}" method="POST" style="margin: 3px">
                                        @csrf 
                                        <button type="submit"> Up </button>
                                    </form>
                                    <form action="{{ route('posts.unvote', ['post' => $post]) }}" method="POST" style="margin: 3px">
                                        @csrf 
                                        <button type="submit" style="color:red"> Down </button>
                                    </form>

                                    {{ $post->postvotes->where('vote','up')->count() - $post->postvotes->where('vote','down')->count() }}

                                </div>
                                @endif
                            @endif
                            
                            @endforeach
                        @else
                            <p>Khong co bai viet</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
