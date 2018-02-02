@extends('layouts.default')
@section('content')
    <div class="container">
        <h4>{{ $result->title }}</h4>

        <div class="card grey lighten-4">
            <div class="card-content">
                {!! $result->body !!}
            </div>
            <div class="card-action">
            @if(\Auth::user() and \Auth::user()->can('update', $result))
                    <a href="/threads/{{ $result->id }}/edit">{{ __('Edit') }}</a>
            @endif
                <a href="{{ route('inicio') }}">{{ __('Back') }}</a>
            </div>
        </div>

    <replies
            responded="{{__('Responded')}}"
            reply="{{ __("Reply") }}"
            your-answer="{{ __('Yout Answer:') }}"
            send="{{ __('Send') }}"
            fix="{{__('Fix')}}"
            thread-id="{{ $result->id }}"
            is-Closed="{{ $result->closed }}">
            @include('layouts.default.preloader')
        </replies>
    </div>
@endsection
@section('scripts')
    <script src="/js/replies.js"></script>
@endsection