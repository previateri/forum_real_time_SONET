@extends('layouts.default')
@section('content')
<div class="container">
    <h4>{{__('Recent Threads')}}</h4>
    <threads title="{{ __('Threads') }}" replies="{{ __('Replies') }}" action="{{ __('Open') }}">
        @include('layouts.default.preloader')
    </threads>
</div>
@endsection

@section('scripts')
    <script src="/js/threads.js"></script>
@endsection
