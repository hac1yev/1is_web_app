<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-home">Ana səhifə</li>
                <li>
                    <a href="{{route('adminIndex')}}" class="waves-effect">
                        <i class="fas fa-paper-plane"></i>
                        <span key="t-not">Ana səhifə</span>
                    </a>
                </li>
                <li class="menu-title" key="t-menu">Menyu</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-building"></i>
                        <span key="t-company">Şirkətlər</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('companiesAdd')}}" key="t-add">Əlavə et</a></li>
                        <li><a href="{{route('companiesList')}}" key="t-list">Siyahı</a></li>
                       </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-briefcase"></i>
                        <span key="t-vacancy">Vakansiyalar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('vacanciesAdd')}}" key="t-add">Əlavə et</a></li>
                        <li><a href="{{route('vacanciesList')}}" key="t-list">Siyahı</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-graduation-cap"></i>
                        <span key="t-education">Təlimlər</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('trainingAdd')}}" key="t-add">Əlavə et</a></li>
                        <li><a href="{{route('trainingList')}}" key="t-list">Siyahı</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-list-alt"></i>
                        <span key="t-blog">Blog</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('blogAddIndex')}}" key="t-add">Əlavə et</a></li>
                        <li><a href="{{route('blogListIndex')}}" key="t-list">Siyahı</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('cvList')}}" class=" waves-effect">
                        <i class="far fa-address-card"></i>
                        <span key="t-blog">Cv-lər</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('reviewIndex')}}" class="waves-effect">
                        <i class="fas fa-comments"></i>
                        <span key="t-not">Şirkət şərhləri</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('contactIndex')}}" class="waves-effect">
                        <i class="fas fa-comment-dots"></i>
                        <span class="badge rounded-pill @if(count($contact) == 0) bg-success @else bg-danger @endif float-end">{{count($contact)}}</span>
                        <span key="t-not">İsmarıclar (Əlaqə)</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('subscribersIndex')}}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span key="t-subs">Abunələr</span>
                    </a>
                </li>
                <li class="menu-title" key="t-menu">Sayt nizamlamaları</li>
                <li>
                    <a href="{{route('bannerImageIndex')}}" class="waves-effect">
                        <i class="fas fa-image"></i>
                        <span key="t-not">Banner (Şəkil)</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('imageIndex')}}" class="waves-effect">
                        <i class="fas fa-images"></i>
                        <span key="t-not">Giriş səhifəsi (Şəkillər)</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('storyIndex')}}" class="waves-effect">
                        <i class="fas fa-icons"></i>
                        <span key="t-not">Hekayələr</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('policyList')}}" class="waves-effect">
                        <i class="fas fa-info-circle"></i>
                        <span key="t-not">İstifadəçi şərtləri</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-lock"></i>
                        <span key="t-blog">Məxfilik siyasəti</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('privacyComList')}}" key="t-add">Kommunikasiya</a></li>
                        <li><a href="{{route('privacyProList')}}" key="t-list">Program Təminatı</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('settingsSeoIndex')}}" class="waves-effect">
                        <i class="fas fa-radiation-alt"></i>
                        <span key="t-seo">SEO</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('settingsLogoIndex')}}" class="waves-effect">
                        <i class="far fa-file-image"></i>
                        <span key="t-seo">Logo və favicon</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('settingsContactIndex')}}" class="waves-effect">
                        <i class="fas fa-phone"></i>
                        <span key="t-ads">Əlaqə məlumatları</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('settingsSocialIndex')}}" class="waves-effect">
                        <i class="fas fa-share-alt"></i>
                        <span key="t-social">Sosial medialar</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-bullhorn"></i>
                        <span key="t-ads">Reklamlar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-add">Əsas səhifə</a></li>
                        <li><a href="{{route('advertListIndex')}}" key="t-list">Footer</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-sun"></i>
                        <span key="t-other">Əlavələr</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('settingsCategoriesIndex')}}" key="t-category">Kateqoriyalar</a></li>
                        <li><a href="{{route('settingsSectorsIndex')}}" key="t-sector">Sektorlar</a></li>
                        <li><a href="{{route('settingsCitiesIndex')}}" key="t-city">Şəhərlər</a></li>
                        <li><a href="{{route('settingsEducationIndex')}}" key="t-edu">Təhsil</a></li>
                        <li><a href="{{route('settingsExperienceIndex')}}" key="t-exp">Təcrübə</a></li>
                        <li><a href="{{route('settingsRegionsIndex')}}" key="t-baku">Bakı rayonları</a></li>
                        <li><a href="{{route('settingsAcceptIndex')}}" key="t-accept">Cv qəbul tipi</a></li>
                        <li><a href="{{route('settingsGendersIndex')}}" key="t-gender">Cins</a></li>
                        <li><a href="{{route('settingsJobTypeIndex')}}" key="t-jobtype">Çalışma tipi</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-bomb"></i>
                        <span key="t-change">Məlumat Dəyişilmələri</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('companiesDataIndex')}}" key="t-change-company">Şirkət məlumatları</a></li>
                    </ul>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
