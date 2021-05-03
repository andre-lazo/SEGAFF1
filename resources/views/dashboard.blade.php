<x-app-layout>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('js/jquery-3.5.1.js')}}" ></script>
<script src="{{asset('js/bootstrap.min.js')}}" ></script>
<script src="{{asset('js/dropzone.js')}}"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="content mt-5">
                    @include('sweet::alert')
                    @yield('content')
                    </section>
            </div>
        </div>
    </div>
</x-app-layout>
