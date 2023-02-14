@extends('layouts.basic')

@section('header')
    @include('includes.header')
@endsection

@section('content')
    <!-- Content -->
    <section id="content" class="main">
        <span class="image main"><img src={{ asset('images/pic04.jpg') }} alt="" /></span>

        <h2>Contact us</h2>
        <p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor
            imperdiet dolor mattis sagittis. Praesent rutrum sem diam, vitae egestas enim auctor sit amet. Pellentesque leo
            mauris, consectetur
            id ipsum sit amet, fergiat. Pellentesque in mi eu massa lacinia malesuada et a elit. Donec urna ex, lacinia in
            purus ac, pretium pulvinar mauris. Curabitur sapien risus, commodo eget turpis at, elementum convallis fames ac
            ante ipsum
            primis in faucibus.</p>

        <section>
            @include('includes.contact-form')
        </section>
    </section>
@endsection
