@extends('front.layouts.master')

<style>
    /* APPLY */

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link {
        color: #221238!important;
        background-color: #fff!important;
        border-color: #221238!important;
        outline: #221238!important;
    }

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #fff!important;
        background-color: #221238!important;
        /* border-color: blue!important;
        outline: blue!important; */
    }

    .cv-pills-form {
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 7px;
    }

    .cv-pills-form button,
    .easy-apply-form button {
        width: 200px;
        height: 40px;
        border-radius: 5px;
        background-color: #fff;
        color: #221238;
        border: 1px solid #221238;
        outline: #221238;
    }

    .cv-pills-form select {
        width: 50%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #221238;
        outline: #221238;
    }

    .cv-pills-form button:hover,
    .easy-apply-form button:hover {
        background-color: #221238;
        color: #fff;
    }

    .easy-apply-form div {
        display: flex;
        flex-direction: column;
    }

    .form-control:focus {
        border-color: #22123850!important;
        box-shadow: 0 0 0 .2rem rgba(34,18,56,.25)!important;
    }

    .apply-buttons-wrapper {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .apply-pills-nav {
        margin: 0!important;
        width: auto!important;
        max-width: auto!important;
    }

    .apply-button {
        margin: 0!important;
    }

    .nav-link {
        padding: .44rem 1rem!important;
        font-family: montserrat!important;
        font-style: normal!important;
        font-weight: 400!important;
    }

    .nav-tabs .nav-link {
        border-top-left-radius: 0!important;
        border-top-right-radius: 0!important;
    }
</style>

@section('content')
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach

        <div class="instructions-header d-flex flex-column align-items-center">

            <div class="instructions-div1">
                <ul>
                    {{$vacdetail->sectors_title}}

                </ul>
            </div>

            <div class="instructions-div2">
                <h2>{{$vacdetail->position}}</h2>
            </div>
            <div class="d-flex instructions-div3">
                <div style="margin-right:24px;">
                    <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.5 8.25C5.67708 8.25 5.82563 8.19 5.94563 8.07C6.06521 7.95042 6.125 7.80208 6.125 7.625V6.375H7.375C7.55208 6.375 7.70063 6.315 7.82063 6.195C7.94021 6.07542 8 5.92708 8 5.75C8 5.57292 7.94021 5.42437 7.82063 5.30437C7.70063 5.18479 7.55208 5.125 7.375 5.125H6.125V3.875C6.125 3.69792 6.06521 3.54938 5.94563 3.42938C5.82563 3.30979 5.67708 3.25 5.5 3.25C5.32292 3.25 5.17458 3.30979 5.055 3.42938C4.935 3.54938 4.875 3.69792 4.875 3.875V5.125H3.625C3.44792 5.125 3.29958 5.18479 3.18 5.30437C3.06 5.42437 3 5.57292 3 5.75C3 5.92708 3.06 6.07542 3.18 6.195C3.29958 6.315 3.44792 6.375 3.625 6.375H4.875V7.625C4.875 7.80208 4.935 7.95042 5.055 8.07C5.17458 8.19 5.32292 8.25 5.5 8.25ZM5.5 13.0156C5.41667 13.0156 5.33333 13 5.25 12.9688C5.16667 12.9375 5.09375 12.8958 5.03125 12.8438C3.51042 11.5 2.375 10.2527 1.625 9.10188C0.875 7.95062 0.5 6.875 0.5 5.875C0.5 4.3125 1.00271 3.06771 2.00813 2.14062C3.01313 1.21354 4.17708 0.75 5.5 0.75C6.82292 0.75 7.98688 1.21354 8.99187 2.14062C9.99729 3.06771 10.5 4.3125 10.5 5.875C10.5 6.875 10.125 7.95062 9.375 9.10188C8.625 10.2527 7.48958 11.5 5.96875 12.8438C5.90625 12.8958 5.83333 12.9375 5.75 12.9688C5.66667 13 5.58333 13.0156 5.5 13.0156Z"
                            fill="#C7C7C7" />
                    </svg>

                    <span>{{$vacdetail->city_title}}</span>
                </div>
                <div>
                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.5 8.625H4.375V9.875H2.5V8.625ZM5.625 9.875H7.5V8.625H5.625V9.875ZM2.5 12.375H4.375V11.125H2.5V12.375ZM5.625 12.375H7.5V11.125H5.625V12.375ZM2.5 4.875H4.375V3.625H2.5V4.875ZM5.625 4.875H7.5V3.625H5.625V4.875ZM2.5 7.375H4.375V6.125H2.5V7.375ZM5.625 7.375H7.5V6.125H5.625V7.375ZM15 5.5V15.5H0V2.375C0 1.87772 0.197544 1.40081 0.549175 1.04917C0.900805 0.697544 1.37772 0.5 1.875 0.5L8.125 0.5C8.62228 0.5 9.09919 0.697544 9.45083 1.04917C9.80246 1.40081 10 1.87772 10 2.375V3.625H13.125C13.6223 3.625 14.0992 3.82254 14.4508 4.17417C14.8025 4.52581 15 5.00272 15 5.5ZM8.75 2.375C8.75 2.20924 8.68415 2.05027 8.56694 1.93306C8.44973 1.81585 8.29076 1.75 8.125 1.75H1.875C1.70924 1.75 1.55027 1.81585 1.43306 1.93306C1.31585 2.05027 1.25 2.20924 1.25 2.375V14.25H8.75V2.375ZM13.75 5.5C13.75 5.33424 13.6842 5.17527 13.5669 5.05806C13.4497 4.94085 13.2908 4.875 13.125 4.875H10V14.25H13.75V5.5ZM11.25 9.875H12.5V8.625H11.25V9.875ZM11.25 12.375H12.5V11.125H11.25V12.375ZM11.25 7.375H12.5V6.125H11.25V7.375Z"
                            fill="#C7C7C7" />
                    </svg>

                    <a href="{{route('compdetail', $vacdetail->company_id)}}" style="color: #ffff;"><span>{{$vacdetail->name}}</span></a>
                </div>
            </div>
        </div>

    </section>
    <section class="info-boxs">
        <div class="info-boxs-container">
            <div class="box-info1">
                <div class="box-svg">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6 0C5.17157 0 4.5 0.671573 4.5 1.5V3H3C1.34315 3 0 4.34315 0 6V21C0 22.6569 1.34315 24 3 24H21C22.6569 24 24 22.6569 24 21V6C24 4.34315 22.6569 3 21 3H19.5V1.5C19.5 0.671573 18.8284 0 18 0C17.1716 0 16.5 0.671573 16.5 1.5V3H7.5V1.5C7.5 0.671573 6.82843 0 6 0ZM6 7.5C5.17157 7.5 4.5 8.17157 4.5 9C4.5 9.82843 5.17157 10.5 6 10.5H18C18.8284 10.5 19.5 9.82843 19.5 9C19.5 8.17157 18.8284 7.5 18 7.5H6Z"
                            fill="white" />
                    </svg>
                </div>

                <div class="box-info-text1">
                    <p>@lang('front.jobtype')</p>
                    <p>{{$vacdetail->job_type_title}}</p>
                </div>
            </div>
            <div class="box-info2">
                <div class="box-svg">
                    <svg width="22" height="18" viewBox="0 0 22 18" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.5 1.5C0.5 0.671573 1.17157 0 2 0H20C20.8284 0 21.5 0.671573 21.5 1.5C21.5 2.32843 20.8284 3 20 3H2C1.17157 3 0.5 2.32843 0.5 1.5Z"
                            fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.5 9C0.5 8.17157 1.17157 7.5 2 7.5H20C20.8284 7.5 21.5 8.17157 21.5 9C21.5 9.82843 20.8284 10.5 20 10.5H2C1.17157 10.5 0.5 9.82843 0.5 9Z"
                            fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.5 16.5C9.5 15.6716 10.1716 15 11 15H20C20.8284 15 21.5 15.6716 21.5 16.5C21.5 17.3284 20.8284 18 20 18H11C10.1716 18 9.5 17.3284 9.5 16.5Z"
                            fill="white" />
                    </svg>
                </div>

                <div class="box-info-text2">
                    <p>@lang('front.cat')</p>
                    <p>{{$vacdetail->sectors_title}}</p>
                </div>
            </div>
            <div class="box-info3">
                <div class="box-svg">
                    <svg width="28" height="22" viewBox="0 0 28 22" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.25 21H26.5V18.5C26.5 16.4289 24.8211 14.75 22.75 14.75C21.5555 14.75 20.4914 15.3085 19.8047 16.1786M20.25 21H7.75M20.25 21V18.5C20.25 17.6797 20.092 16.8963 19.8047 16.1786M7.75 21H1.5V18.5C1.5 16.4289 3.17893 14.75 5.25 14.75C6.44451 14.75 7.50857 15.3085 8.19531 16.1786M7.75 21V18.5C7.75 17.6797 7.90803 16.8963 8.19531 16.1786M8.19531 16.1786C9.11688 13.8763 11.3685 12.25 14 12.25C16.6315 12.25 18.8831 13.8763 19.8047 16.1786M17.75 4.75C17.75 6.82107 16.0711 8.5 14 8.5C11.9289 8.5 10.25 6.82107 10.25 4.75C10.25 2.67893 11.9289 1 14 1C16.0711 1 17.75 2.67893 17.75 4.75ZM25.25 8.5C25.25 9.88071 24.1307 11 22.75 11C21.3693 11 20.25 9.88071 20.25 8.5C20.25 7.11929 21.3693 6 22.75 6C24.1307 6 25.25 7.11929 25.25 8.5ZM7.75 8.5C7.75 9.88071 6.63071 11 5.25 11C3.86929 11 2.75 9.88071 2.75 8.5C2.75 7.11929 3.86929 6 5.25 6C6.63071 6 7.75 7.11929 7.75 8.5Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </div>
                <div class="box-info-text3">
                    <p>@lang('front.yas')</p>
                    <p>{{$vacdetail->min_age}}-{{$vacdetail->max_age}}</p>
                </div>
            </div>
            <div class="box-info4">
                <div class="box-svg">
                    <svg width="25" height="26" viewBox="0 0 25 26" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M23.5 15.8193C20.0259 17.2256 16.2284 18 12.25 18C8.27163 18 4.47412 17.2256 1 15.8193M17.25 6.75V4.25C17.25 2.86929 16.1307 1.75 14.75 1.75H9.75C8.36929 1.75 7.25 2.86929 7.25 4.25V6.75M12.25 14.25H12.2625M3.5 24.25H21C22.3807 24.25 23.5 23.1307 23.5 21.75V9.25C23.5 7.86929 22.3807 6.75 21 6.75H3.5C2.11929 6.75 1 7.86929 1 9.25V21.75C1 23.1307 2.11929 24.25 3.5 24.25Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                <div class="box-info-text4">
                    <p>@lang('front.exp')</p>
                    <p>{{$vacdetail->experience_title}}</p>
                </div>
            </div>
            <div class="box-info5">
                <div class="box-svg">
                    <svg width="22" height="26" viewBox="0 0 22 26" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.6667 6.75C16.6667 9.51142 14.1296 11.75 11 11.75C7.8704 11.75 5.33334 9.51142 5.33334 6.75C5.33334 3.98858 7.8704 1.75 11 1.75C14.1296 1.75 16.6667 3.98858 16.6667 6.75Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M11 15.5C5.52319 15.5 1.08334 19.4175 1.08334 24.25H20.9167C20.9167 19.4175 16.4768 15.5 11 15.5Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                <div class="box-info-text5">
                    <p>@lang('front.elaqesexs')</p>
                    <p>{{$vacdetail->contact_name}}</p>
                </div>
            </div>
            <div class="box-info6">
                <div class="box-svg">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.493 9.90538C15.855 10.3225 16.4866 10.3673 16.9037 10.0053C17.3208 9.64335 17.3656 9.01176 17.0036 8.59462L15.493 9.90538ZM10.507 16.0946C10.1451 15.6775 9.51347 15.6327 9.09633 15.9947C8.67919 16.3567 8.63445 16.9882 8.99641 17.4054L10.507 16.0946ZM14 6.75C14 6.19772 13.5523 5.75 13 5.75C12.4477 5.75 12 6.19772 12 6.75H14ZM12 19.25C12 19.8023 12.4477 20.25 13 20.25C13.5523 20.25 14 19.8023 14 19.25L12 19.25ZM23.25 13C23.25 18.6609 18.6609 23.25 13 23.25V25.25C19.7655 25.25 25.25 19.7655 25.25 13H23.25ZM13 23.25C7.33908 23.25 2.75 18.6609 2.75 13H0.75C0.75 19.7655 6.23451 25.25 13 25.25V23.25ZM2.75 13C2.75 7.33908 7.33908 2.75 13 2.75V0.75C6.23451 0.75 0.75 6.23451 0.75 13H2.75ZM13 2.75C18.6609 2.75 23.25 7.33908 23.25 13H25.25C25.25 6.23451 19.7655 0.75 13 0.75V2.75ZM13 12C12.1344 12 11.3959 11.7643 10.903 11.4357C10.4032 11.1025 10.25 10.752 10.25 10.5H8.25C8.25 11.6287 8.93625 12.5282 9.79365 13.0998C10.658 13.6761 11.7946 14 13 14V12ZM10.25 10.5C10.25 10.248 10.4032 9.8975 10.903 9.56428C11.3959 9.23572 12.1344 9 13 9V7C11.7946 7 10.658 7.32392 9.79365 7.90018C8.93625 8.47178 8.25 9.37126 8.25 10.5H10.25ZM13 9C14.1814 9 15.083 9.43286 15.493 9.90538L17.0036 8.59462C16.1168 7.57264 14.5947 7 13 7V9ZM13 14C13.8656 14 14.6041 14.2357 15.097 14.5643C15.5968 14.8975 15.75 15.248 15.75 15.5H17.75C17.75 14.3713 17.0638 13.4718 16.2064 12.9002C15.342 12.3239 14.2054 12 13 12V14ZM12 6.75V8H14V6.75H12ZM12 18L12 19.25L14 19.25L14 18L12 18ZM13 17C11.8186 17 10.917 16.5671 10.507 16.0946L8.99641 17.4054C9.88319 18.4274 11.4054 19 13 19L13 17ZM15.75 15.5C15.75 15.752 15.5968 16.1025 15.097 16.4357C14.6041 16.7643 13.8657 17 13 17V19C14.2054 19 15.342 18.6761 16.2064 18.0998C17.0638 17.5282 17.75 16.6287 17.75 15.5H15.75ZM12 8L12 18L14 18L14 8L12 8Z"
                            fill="white" />
                    </svg>
                </div>

                <div class="box-info-text6">
                    <p>@lang('front.maas')</p>
                    @if($vacdetail->min_salary===NULL)
                    <p>@lang('front.musahibe')</p>
                    @else
                    <p>{{$vacdetail->min_salary}}-{{$vacdetail->max_salary}}</p>
                    @endif
                </div>
            </div>
            <div class="box-info7">
                <div class="box-svg">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.493 9.90538C15.855 10.3225 16.4866 10.3673 16.9037 10.0053C17.3208 9.64335 17.3656 9.01176 17.0036 8.59462L15.493 9.90538ZM10.507 16.0946C10.1451 15.6775 9.51347 15.6327 9.09633 15.9947C8.67919 16.3567 8.63445 16.9882 8.99641 17.4054L10.507 16.0946ZM14 6.75C14 6.19772 13.5523 5.75 13 5.75C12.4477 5.75 12 6.19772 12 6.75H14ZM12 19.25C12 19.8023 12.4477 20.25 13 20.25C13.5523 20.25 14 19.8023 14 19.25L12 19.25ZM23.25 13C23.25 18.6609 18.6609 23.25 13 23.25V25.25C19.7655 25.25 25.25 19.7655 25.25 13H23.25ZM13 23.25C7.33908 23.25 2.75 18.6609 2.75 13H0.75C0.75 19.7655 6.23451 25.25 13 25.25V23.25ZM2.75 13C2.75 7.33908 7.33908 2.75 13 2.75V0.75C6.23451 0.75 0.75 6.23451 0.75 13H2.75ZM13 2.75C18.6609 2.75 23.25 7.33908 23.25 13H25.25C25.25 6.23451 19.7655 0.75 13 0.75V2.75ZM13 12C12.1344 12 11.3959 11.7643 10.903 11.4357C10.4032 11.1025 10.25 10.752 10.25 10.5H8.25C8.25 11.6287 8.93625 12.5282 9.79365 13.0998C10.658 13.6761 11.7946 14 13 14V12ZM10.25 10.5C10.25 10.248 10.4032 9.8975 10.903 9.56428C11.3959 9.23572 12.1344 9 13 9V7C11.7946 7 10.658 7.32392 9.79365 7.90018C8.93625 8.47178 8.25 9.37126 8.25 10.5H10.25ZM13 9C14.1814 9 15.083 9.43286 15.493 9.90538L17.0036 8.59462C16.1168 7.57264 14.5947 7 13 7V9ZM13 14C13.8656 14 14.6041 14.2357 15.097 14.5643C15.5968 14.8975 15.75 15.248 15.75 15.5H17.75C17.75 14.3713 17.0638 13.4718 16.2064 12.9002C15.342 12.3239 14.2054 12 13 12V14ZM12 6.75V8H14V6.75H12ZM12 18L12 19.25L14 19.25L14 18L12 18ZM13 17C11.8186 17 10.917 16.5671 10.507 16.0946L8.99641 17.4054C9.88319 18.4274 11.4054 19 13 19L13 17ZM15.75 15.5C15.75 15.752 15.5968 16.1025 15.097 16.4357C14.6041 16.7643 13.8657 17 13 17V19C14.2054 19 15.342 18.6761 16.2064 18.0998C17.0638 17.5282 17.75 16.6287 17.75 15.5H15.75ZM12 8L12 18L14 18L14 8L12 8Z"
                            fill="white" />
                    </svg>

                </div>
                <div class="box-info-text7">
                    <p>@lang('front.deadline')</p>
                    <p>{{ \Carbon\Carbon::parse($vacdetail->deadline)->format('d-m-Y')}}</p>
                </div>
            </div>
            <div class="box-info8">
                <div class="box-svg">
                    <svg width="26" height="20" viewBox="0 0 26 20" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.75 10C16.75 12.0711 15.0711 13.75 13 13.75C10.9289 13.75 9.25 12.0711 9.25 10C9.25 7.92893 10.9289 6.25 13 6.25C15.0711 6.25 16.75 7.92893 16.75 10Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M1.07281 9.99996C2.66566 4.9286 7.40351 1.25 13.0005 1.25C18.5976 1.25 23.3355 4.92864 24.9283 10C23.3355 15.0714 18.5976 18.75 13.0006 18.75C7.40351 18.75 2.66563 15.0714 1.07281 9.99996Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                <div class="box-info-text8">
                    <p>@lang('front.baxissay') </p>
                    <p>{{$vacdetail->view}}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="position-instructions">
        <h3>@lang('front.vezifetel')</h3>
        <div class="position-instructions-container">
            <ul>
                {!! html_entity_decode($vacdetail->description) !!}
                
            </ul>
        </div>
        <h3>@lang('front.namteleb')</h3>
        <div class="position-instructions-container">
            <ul>
                
                {!! html_entity_decode($vacdetail->requirement) !!}
               
            </ul>
        </div>
        <div class="vac-apply-button">
            @if (Auth::check())
                <button id="apply_button">Müraciət</button>
            @else
                <a href="{{ route('login') }}">
                    <button id="dsdf">Müraciət</button>
                </a>
            @endif
        </div>
        
        <div id="apply_section">
            <div class="apply-buttons-wrapper" style="padding: 6px;">
            
                @if ($vacdetail->accept_type == 2)
    
                <nav class="apply-pills-nav">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">@lang('front.asantmur')</button>
                        <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">@lang('front.indimur')</button>
                    </div>
                </nav>
                    
                @else
                <?php
                $contact_info = str_replace('https://1is.butagrup.az/vacancy/', '', $vacdetail->contact_info);
                ?>
            
            @if (strpos($contact_info, '@') !== false)
            <a class="apply-button" href="mailto:{{ $contact_info }}">@lang('front.muraciet')</a>
        @else
            @if (Auth::check())
                <a class="apply-button" href="{{ $contact_info }}">@lang('front.muraciet')</a>
            @else
                <a class="apply-button" href="{{ route('login') }}">@lang('front.muraciet')</a>
            @endif
        @endif
        
                
                @endif
            </div>
            
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active container" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form class="cv-pills-form py-3" method="POST" action="{{route('selectcv')}}">
                        @csrf
                        <input type="hidden" name="vacancy_id" value="{{ $vacdetail->id }}">
    
                        <label for="my-cv">@lang('front.cvler')</label>
                        @if (auth()->check() && count($cvs) > 0)
                            <select id="my-cv" required name="my-cv">
                                <option value="">@lang('front.cvsec')</option>
                                @foreach ($cvs as $cv)
                                    <option value="{{ $cv->id }}">{{ $cv->name }}</option>
                                @endforeach
                            </select>
                        @else
                        <select id="my-cv" required name="my-cv">
                            <option value="">@lang('front.cvyox')</option>
                            
                        </select>
                            @endif
    
                        <button>@lang('front.muraciet')</button>
                    </form>
                    
                </div>
    
                <div class="tab-pane fade container" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <form action="{{route('asantmur')}}" class="easy-apply-form row py-3" method="POST" enctype="multipart/form-data" id="register_form">
                        @csrf
                        <input type="hidden" name="vacancy_id" value="{{ $vacdetail->id }}">
    
                        <div class="col-md-6 mt-3 input-group" @error('name') has-error @enderror>
                            <label for="name">@lang('front.ad'):</label>
                            <input type="text" name="name" class="form-control w-100" id="name" placeholder="@lang('front.ad')" />
                        </div>
                        <div class="col-md-6 mt-3 input-group" @error('surname') has-error @enderror>
                            <label for="surname">@lang('front.soyad'):</label>
                            <input type="text" name="surname" class="form-control w-100" id="surname" placeholder="@lang('front.soyad')"  />
                        </div>
                        <div class="col-md-6 mt-3 input-group" @error('mail') has-error @enderror>
                            <label for="email">@lang('front.email'):</label>
                            <input type="email" name="mail" class="form-control w-100" id="email" placeholder="@lang('front.email')"/>
                        </div>
                        <div class="col-md-6 mt-3 input-group" @error('phone') has-error @enderror>
                            <label for="contact">@lang('front.telnom'):</label>
                            <input type="text" name="phone" class="form-control w-100" id="contact" placeholder="@lang('front.telnom')" />
                            
                        </div>
                        <div class="col-md-6 mt-3" @error('cv') has-error @enderror>
                            <label for="cv-add">@lang('front.cvyukle'):</label>
                            <input id="cv-add" name="cv" accept="application/pdf,application/vnd.ms-excel" type="file" />
                            
                        </div>
                        <div class="col-12 mt-3">
                            <button>@lang('front.muraciet')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>



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
                    maxlength: {
                        'AZ': 'Bu sahə üçün maksimum 5gb keçilməlidir!',
                        'EN': 'Maximum 5gb should not be exceeded for this field!',
                        'RU': 'Максимальное количество символов для этого поля - !',
                        'TR': 'Bu alan için maksimum 5gb karakter sınırı aşılmamalıdır!'
                    },

                    number: {
                        'AZ': 'Rəqəm daxil edin!',
                        'EN': 'Enter a number!',
                        'RU': 'Введите число!',
                        'TR': 'Bir sayı girin!'
                    },
                    
                    minlength: {
                        'AZ': 'Bu sahə üçün minimum 9 simvol limiti keçilməlidir!',
                        'EN': 'Minimum 9 characters limit should not be exceeded for this field!',
                        'RU': 'Минимальное количество символов для этого поля - 9!',
                        'TR': 'Bu alanda en az 9 karakter sınırı aşılmamalıdır!'
                    },
                    
                };
    
                return errorMessages[field][lang] || errorMessages[field]['AZ']; // Varsayılan olarak İngilizce mesaj kullan
            }
    
            $("#register_form").validate({
                rules: {
                    mail: {
                        required: true,
                        email: true,
                    },
                    name: {
                        required: true,
                        maxlength: 255,
                    },
                    surname: {
                        required: true,
                        maxlength: 255,
                    },

                    phone: {
                        required: true,
                        minlength: 9,
                        number: true
                    },
                    cv: {
                        required: true,
                        maxlength: 5120

                    },
                    


                },
                messages: {
                    mail: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        email: function() {
                            return getErrorMessage('email', lang);
                        },
                        
                    },
    
                    name: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        
                        maxlength: function() {
                            return getErrorMessage('maxlength', lang);
                        }
                    },

                    surname: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        
                        maxlength: function() {
                            return getErrorMessage('maxlength', lang);
                        }
                    },

                    phone: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        
                        minlength: function() {
                            return getErrorMessage('minlength', lang);
                        },

                        number: function() {
                            return getErrorMessage('number', lang);
                        },
                    },

                    cv: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
   
                        maxlength: function() {
                            return getErrorMessage('maxlength', lang);
                        }
                    },
                    
                },
                submitHandler: function(form) {
                    form.submit(); // Formu gönder
                }
            });
        });
    
    </script>
        
    <script>    
        const apply_button = document.querySelector('#apply_button');
        const apply_section = document.querySelector('#apply_section');

        apply_button.addEventListener('click', () => {
            apply_section.style.display = 'block';
            apply_button.style.display = 'none';
        })
    </script>
@endsection


@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/instruction.css')}}">
@endsection