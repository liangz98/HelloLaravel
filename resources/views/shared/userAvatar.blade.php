<a href="{{ route('user.show', $user->id) }}">
    <img src="http://upload.qqbody.com/allimg/1702/140I11914-2.jpg" alt="{{ $user->name }}" class="gravatar">
    {{-- <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar"/> --}}
</a>
<h1>{{ $user->name }}</h1>