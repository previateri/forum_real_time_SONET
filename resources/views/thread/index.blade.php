@extends('layouts.default')
@section('content')
<div class="container">
    <h4>{{__('Recent Threads')}}</h4>
    <threads
            title="{{ __('Threads') }}"
            replies="{{ __('Replies') }}"
            action="{{ __('View') }}"
            new-thread="{{ __('New Thread') }}"
            title-thread="{{ __('Title') }}"
            body-thread="{{ __('Content') }}"
            fix="{{__('Fix')}}"
            close="{{__('Open | Close')}}"
            send="{{ __('Send') }}" >
        @include('layouts.default.preloader')
    </threads>
</div>
@endsection

@section('scripts')
    <script src="/js/threads.js"></script>
@endsection
