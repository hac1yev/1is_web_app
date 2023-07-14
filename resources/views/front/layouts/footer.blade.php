   

<!-- FOOTER -->

<div class="footer">
    <div class="container footer-container">
        <div class="row footer-row">
            <div class="col-md-6 px-0 my-3">
                <div class="footer-left">
                    <div class="row w-100">
                        <div class="col-lg-6 col-8 pl-0">
                            <div class="footer-logo-social">
                                <img src="{{ asset($setting->logo) }}" style="width: 140px; height: 130px" alt="footer-1is">
                                <span>@lang('front.biziizle')</span>
                                <div class="footer-social">
                                    <a href="https://www.facebook.com/1ish.az/"><div><img src="https://1is-new.netlify.app/images/footer-fb.png" alt="fb"></div></a>
                                    <a href="https://www.instagram.com/1is_az/"><div><img src="https://1is-new.netlify.app/images/footer-ig.png" alt="insta"></div></a>
                                    <a href="https://www.linkedin.com/company/recruitment-azerbaycan/"><div><img src="https://1is-new.netlify.app/images/footer-li.png" alt="linkedin"></div></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-lg-6 footer-links-wrapper">
                            <div class="footer-links">
                                <h4>1iş.az</h4>
                                <ul>
                                    <li>
                                        <a href="{{route('allvacancies')}}">@lang('front.vacancies')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('jobsearch')}}">@lang('front.jobsearch')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('allcompany')}}">@lang('front.companies')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('allblogs')}}">@lang('front.blog')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('terms')}}">@lang('front.term')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('policy')}}">@lang('front.policy')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('contactindex')}}">@lang('front.contact')</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-0 my-3">
                <div class="footer-right">
                    <h3>@lang('front.bildiris')</h3>
                    <p>@lang('front.gelenlerqutu')</p>
                   
                        <form action="{{route('newslatter')}}" method="POST" id="news_form">
                            @csrf
                            <div class="footer-input-group">
                                <div class="footer-input-label">
                                    <input type="email" name="email" placeholder="@lang('front.emaildaxilet')" />
                                    <button type="submit">
                                        <img src="https://1is-new.netlify.app/images/footer-arrow.png" alt="arrow">
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
      </div>
    </div>
    <div class="footer-bottom">
        <div class="container footer-bottom-container">
            <span class="footer-span1">@2023</span>
            <span>@lang('front.butunhuquq')</span>
            <span>@lang('front.butateref')</span>
        </div>
    </div>
  </div>


  <script>
    $(document).ready(function() {
        var lang = "{{ app()->getLocale() }}"; // Dil seçimini al

        function getErrorMessage(field, lang) {
            var errorMessages = {
                required: {
                    'AZ': 'Bu sahə doldurulmalıdır!',
                    'EN': 'This field is required!',
                    'RU': 'Поле обязательно для заполнения!',
                    'TR': 'Bu alan zorunludur!'
                },
                email: {
                    'AZ': 'Düzgün bir email adresi daxil edin.',
                    'EN': 'Please enter a valid email address.',
                    'RU': 'Введите действительный адрес электронной почты.',
                    'TR': 'Geçerli bir email adresi giriniz.'
                },
                

               
            };

            return errorMessages[field][lang] || errorMessages[field]['AZ']; // Varsayılan olarak İngilizce mesaj kullan
        }

        $("#news_form").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                

            },
            messages: {
                email: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    email: function() {
                        return getErrorMessage('email', lang);
                    },
                    
                },
              
            },
            submitHandler: function(form) {
                form.submit(); // Formu gönder
            }
        });
    });

</script>