@extends('layouts.default')
{{-- @section('title', $user->name) --}}

@section('content')
{{-- {{ $user->name }} - {{ $user->email }} --}}
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="col-md-12">
            <div class="col-md-offset-2 col-md-8">
                <section class="user_info">
                    {{-- @include('shared.userAvatar', ['user' => $user]) --}}
                    @include('shared.userAvatar')
                </section>
            </div>
        </div>
    </div>
</div>
@stop