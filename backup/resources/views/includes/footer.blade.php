<!--Footer-->
{{-- <div class="largebanner shadow3">
<div class="adin">
{!! $siteSetting->above_footer_ad !!}
</div>
<div class="clearfix"></div>
</div> --}}


<div class="footerWrap">
    <div class="footer-area">
    <div class="container">
        <div class="row"> 
            <div class="col-md-6">
                <div class="row">
                <!--Quick Links-->
            <div class="col-md-4 col-sm-6 text-center">
                <img src="{{ asset('images/home/carton images.png') }}">
               
            </div>
            <!--Quick Links menu end-->

            <div class="col-md-4 col-sm-6">
                <h5>{{__('Visffor')}}</h5>
                <!--Quick Links menu Start-->
                <ul class="quicklinks">
                    <li><a href="#">{{__('About Us')}}</a></li>
                    <li><a href="{{ route('contact.us') }}">{{__('Contact Us')}}</a></li>
                    <li><a href="{{ url('/#why_us') }}">{{__('Why Us')}}</a></li>
                    <li><a href="{{ url('/'.'#application') }}">{{__('Process')}}</a></li>
                    <li><a href="{{ url('/#map') }}">{{__('Map')}}</a></li>
                    {{--<li class="postad"><a href="{{ route('post.job') }}">{{__('Post a Job')}}</a></li>
                    <li><a href="{{ route('faq') }}">{{__('FAQs')}}</a></li>--}}
                    {{--@foreach($show_in_footer_menu as $footer_menu)
                        @php
                            $cmsContent = App\CmsContent::getContentBySlug($footer_menu->page_slug);
                        @endphp

                        <li class="{{ Request::url() == route('cms', $footer_menu->page_slug) ? 'active' : '' }}"><a href="{{ route('cms', $footer_menu->page_slug) }}">{{ $cmsContent->page_title }}</a></li>
                    @endforeach--}}
                </ul>
            </div>
                    <div class="col-md-4 col-sm-6" style="padding-left: 0px;">
                        <h5>{{__('Location')}}</h5>
                        <div>
                            <div class="font-weight-bold text-white py-1">United Kingdom</div>
                            <p>City Point, 1 Solly Street,
                                Sheffield, S1 4BX.
                                TEL:(+44)07455962168 </p>
                        </div>
                        <div>
                            <div class="font-weight-bold text-white py-1">China</div>
                            <p>Xicheng, Beijing.
                                100045. <br /> 
                                Landline: (+86)-01057958881</p>
                        </div>
                        <!--Quick Links menu Start-->
                        {{--<ul class="quicklinks">
                            @php
                                $functionalAreas = App\FunctionalArea::getUsingFunctionalAreas(10);
                            @endphp
                            @foreach($functionalAreas as $functionalArea)
                                <li><a href="{{ route('job.list', ['functional_area_id[]'=>$functionalArea->functional_area_id]) }}">{{$functionalArea->functional_area}}</a></li>
                            @endforeach
                        </ul>--}}
                    </div>
            </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                <!--Jobs By Industry-->
            <div class="col-md-6 col-sm-6">
                <h5>{{__('Register Now')}}</h5>
                <p>Sign up with your email address to receive news
                    and updates</p>
                <div class="newsletter py-3">
                    <div class="content">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <span class="input-group-btn">
         <button class="btn" type="submit">Register</button>
         </span>
                    </div>
                    </div>
                </div>
                <div class="font-weight-bold text-white py-1">Connect With us</div>
                <!-- Social Icons -->
                <div class="social py-3">@include('includes.footer_social')</div>
                <!-- Social Icons end -->
                <!--Industry menu Start-->
                {{--<ul class="quicklinks">
                    @php
                    $industries = App\Industry::getUsingIndustries(10);
                    @endphp
                    @foreach($industries as $industry)
                    <li><a href="{{ route('job.list', ['industry_id[]'=>$industry->industry_id]) }}">{{$industry->industry}}</a></li>
                    @endforeach
                </ul>--}}
                <!--Industry menu End-->
                <div class="clear"></div>
            </div>

            <!--About Us-->
            <div class="col-md-6 col-sm-12">
                <h5>{{__('Get Visffor App')}}</h5>
                <p>Download our app from ISO or
                    Android free cost</p>
                <div class="py-3">
                <a href="#" class="">
                    <img src="{{ asset('images/home/google-play-and-apple-app-store-logos-22.png') }}" class="img-fluid">
                </a>
                </div>
                <div class="py-3">
                <a href="#">
                    <img src="{{ asset('images/home/google-play-and-apple-app-store-logos-221.png') }}" class="img-fluid">
                </a>
                </div>
                <{{--div class="address">{{ $siteSetting->site_street_address }}</div>
                <div class="email"> <a href="mailto:{{ $siteSetting->mail_to_address }}">{{ $siteSetting->mail_to_address }}</a> </div>
                <div class="phone"> <a href="tel:{{ $siteSetting->site_phone_primary }}">{{ $siteSetting->site_phone_primary }}</a></div>
--}}

            </div>
            </div>
            <!--About us End-->
            </div>
        </div>
        </div>
    </div>
</div>
<!--Footer end--> 
<!--Copyright-->
{{--<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="bttxt">{{__('Copyright')}} &copy; {{date('Y')}} {{ $siteSetting->site_name }}. {{__('All Rights Reserved')}}. {{__('Design by')}}: <a href="{{url('/')}}http://graphicriver.net/user/ecreativesol" target="_blank">eCreativeSolutions</a></div>
            </div>
            <div class="col-md-4">
                <div class="paylogos"><img src="{{asset('/')}}images/payment-icons.png" alt="" /></div>	
            </div>
        </div>

    </div>
</div>--}}
