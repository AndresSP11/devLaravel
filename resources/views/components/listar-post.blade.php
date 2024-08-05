<div>
    <h2 class=" text-center text-2xl text-black font-bold my-10">Publicaciones</h2>

        @if($posts->count())

        <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 justify-center gap-4">
        @foreach ($posts as $post )
            <div class=" h-96 flex justify-center">
                <a href="{{route('posts.show',['post'=>$post,'user'=>$post->user])}}">
                    <img src="/uploads/{{$post->imagen}}" alt="Imagen del post {{$post->titulo}}" class=" h-full">
                </a>
            </div>
        @endforeach
        </div>
        <div class=" my-10">
            {{$posts->links()}}
        </div>


        @else


        <p class=" text-gray-600 uppercase">No hay Post's</p>

        @endif
</div>