@extends('front.layouts.master')


@section('content')
<section class="login-section">
        <div class="login-background">
            <div class="login-authentification">
                <img src="{{asset('back/assets/images/icons/oneJob-login.png')}}" alt="oneJob-login" />
                <h3>@lang('front.saytagir')</h3>
              
                <form action="{{ route('select_post') }}" class="row login-form" method="POST">
                    @csrf
                   
                    <div class="form-group login-form-group col-lg-9 col-md-7">
                        <div id="no-limit">
                            <p>Select categories</p>
                            <select class="select2 form-select" style="width: 100%;" name="cat_id[]">

                              @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title_az}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="login-bottom">
                        
                    </div>

                    <div class="col-lg-9 col-md-7 login-buttons">
                        <button class="login-registration" type="submit">@lang('front.daxilol')</button>                 
                        
                    </div>
                </form>


            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    const moreSearch = document.getElementById('detail-btn')
    const moreSearchSect = document.getElementById('getshow')
    moreSearch.addEventListener('click' , () => {
        moreSearchSect.classList.toggle('filter-active');
    })
</script>

<script>
    $(document).ready(function() {
    $('#no-limit .select2').select2({
        multiple: "multiple",
    });

    $('#limit-2 .select2').select2({
        multiple: "multiple",
        maximumSelectionLength: 2,
    });

    $('#limit-2-custom-message .select2').select2({
        multiple: "multiple",
        maximumSelectionLength: 2,
        language: {
        maximumSelected: (args) => args.maximum + ' 件しか選べないよ！'
        }
    });
    });
</script>
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/login.css')}}">
@endsection