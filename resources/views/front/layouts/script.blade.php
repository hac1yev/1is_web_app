<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('front/js/app.js') }}"></script>
<script src="{{asset('front/js/jquery.js')}}"></script>

@yield('js-link')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/4.0.0/jquery.validate.unobtrusive.min.js" integrity="sha512-xq+Vm8jC94ynOikewaQXMEkJIOBp7iArs3IhFWSWdRT3Pq8wFz46p+ZDFAR7kHnSFf+zUv52B3prRYnbDRdgog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>
    @if(Session::has('success'))
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        })
    @endif
  
    @if(Session::has('error'))
    Swal.fire({
        icon: 'error',
        title: '{{ session('error') }}',
        })
    @endif
  
    @if(Session::has('warning'))
    Swal.fire({
        icon: 'warning',
        title: '{{ session('warning') }}',
        })
    @endif
  </script>

