@extends('layout.template')
@extends('layout.navbar')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/wishlist.css') }}" />

<section>
    <div class="main-container container">
        <div class="row py-5">
            <div class="header">
                <img src="{{ asset('images/kalasewa.png') }}" alt="kalasewa" class="header-image">
                <h1>K A L A S E W A</h1>
                <h4>Wujudkan impian cosplaymu bersama-sama!</h4>
            </div>
        </div>

        <h1 class="text-start">TENTANG KALASEWA</h1>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur efficitur vel tellus ut pharetra.
            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam id nunc
            vitae ligula finibus ultrices sit amet vitae neque. Nam eu mi ac quam ultricies efficitur sed vel sem.
            Aenean accumsan felis nec ante ultrices sodales et et tortor. In rutrum dignissim arcu, pulvinar cursus orci
            cursus tristique. Nam aliquet suscipit mauris, id auctor dolor luctus non. Suspendisse lacinia, ante ut
            finibus sodales, velit nisi varius arcu, eu imperdiet libero orci non orci. Aenean porttitor urna sit amet
            turpis facilisis fringilla. Sed placerat rutrum pharetra.

            Mauris turpis diam, aliquet sit amet lectus sed, sollicitudin cursus mi. Nulla fringilla blandit leo et
            scelerisque. Aliquam convallis iaculis magna et aliquam. Pellentesque sed sem non magna lacinia suscipit.
            Fusce purus neque, ultrices in tincidunt id, venenatis eu lacus. Curabitur lacinia fringilla velit et
            egestas. Nam nisi nulla, pharetra a risus a, commodo commodo ante. Vestibulum quis semper dui, vitae
            tincidunt justo. Maecenas nec sollicitudin ante, id viverra neque.</p>
    </div>
</section>

@include('layout.footer')
@endsection