{{-- tạo thanh đường dẫn, Ví dụ: Home→Jobs→Electrical Parts Reconditioner→Apply --}}

<nav {{$attributes}}>
    <ul class="flex space-x-2 text-slate-500">
        <li>
            <a href="/">Home</a>
        </li>

        @foreach ($links as $lable => $link)
            <li>→</li>
            <li>
                <a href="{{$link}}">
                    {{ $lable }}
                </a>
            </li>
        @endforeach
        
    </ul>
</nav>