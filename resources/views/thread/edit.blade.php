@extends('layouts.default')
@section('content')
    <div class="container">
        <h4>{{ __('Editing') }} - {{ $thread->title }}</h4>

        <div class="card grey lighten-4">
            <div class="card-content">
                <form action="/threads/{{$thread->id}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="input-field">
                        <input type="text" name="title" placeholder="{{ __('Title') }}" value="{{old('title', $thread->title)}}" />
                    </div>
                    <div class="input-field">
                        <textarea class="materialize-textarea" name="body" placeholder="{{ __('Content') }}">{{old('body', $thread->body)}}</textarea>
                    </div>
                    <button type="submit" class="btn red accent-2">{{ __('Send') }}</button>
                </form>
            </div>
            <div class="card-action">
                <a href="/threads/{{ $thread->id }}">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
@endsection
