@extends('layouts.default')
@section('content')
    <div class="container">
        <h4>{{ $result->title }}</h4>

        <div class="card grey lighten-4">
            <div class="card-content">
                {!! $result->body !!}
            </div>
        </div>

    <replies responded="{{__('Responded')}}" reply="{{ __("Reply") }}" your-answer="{{ __('Yout Answer:') }}" send="{{ __('Send') }}">
            @include('layouts.default.preloader')
        </replies>
    </div>
@endsection
@section('scripts')
    <script src="/js/replies.js"></script>
@endsection