@if(Route::current()->getName() != 'home')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-2">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Projects</a></li>
            @php
                $link = url('/');
            @endphp
            @foreach(request()->segments() as $segment)
                @php
                    $link .= "/" . request()->segment($loop->iteration);
                @endphp
                @if(rtrim(request()->route()->getPrefix(), '/') != $segment && ! preg_match('/[0-9]/', $segment))
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                        @if($loop->last)
                            {{ $segment }}
                        @else
                            <a href="{{ $link }}">{{ $segment }}</a>
                        @endif
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif