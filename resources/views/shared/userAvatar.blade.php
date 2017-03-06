<a href="{{ route('user.show', 1) }}">
    {{-- <img src="http://upload.qqbody.com/allimg/1702/140I11914-2.jpg" alt="{{ $user->name }}" class="gravatar"> --}}
    {{-- <img src="http://upload.qqbody.com/allimg/1702/140I11914-2.jpg" class="gravatar"> --}}
    {{-- <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar"/> --}}
    <img src="{{ $user->gravatar('140') }}" class="gravatar"/>
</a>
{{-- <h1>{{ $user->name }}</h1> --}}