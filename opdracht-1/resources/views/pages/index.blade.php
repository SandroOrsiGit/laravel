@extends('layouts.basic')

@section('header')
    <span class="logo"><img src={{ asset('images/logo.svg') }} alt="" /></span>
    <h1>Stellar</h1>
    <p>Just another free, fully responsive site template<br /> built by <a href="https://twitter.com/ajlkn">@ajlkn</a> for <a
            href="https://html5up.net">HTML5 UP</a>.</p>
@endsection

@section('content')
    <!-- Introduction -->
    @include('includes.intro')

    <!-- First Section -->
    @include('includes/section-1')
    <!-- Second Section -->
    @include('includes.section-2')
    <!-- Get Started -->
    @include('includes.get-started')
@endsection
