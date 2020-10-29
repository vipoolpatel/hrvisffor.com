@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Search start -->
{{--@include('includes.search')--}}
<!-- Search End -->
<!-- Home Banner Start   -->
@include('includes.home_banner')
<!-- Home Banner End   -->
<!-- Popular Searches start -->
@include('includes.tab_list')
{{--@include('includes.popular_searches')--}}
<!-- Popular Searches ends --> 
<!-- Testimonials start -->
@include('includes.home_blogs')
<!-- Testimonials End -->
@include('includes.why_tech')

@include('includes.why_choose')
@include('includes.application_process')
@include('includes.latest_news')
@include('includes.faq')
<!-- Top Employers start -->
{{-- @include('includes.top_employers') --}}
<!-- Top Employers ends --> 

<!-- Featured Jobs start -->
{{--@include('includes.featured_jobs')--}}
<!-- Featured Jobs ends -->
<!-- Login box start -->
{{--@include('includes.login_text')--}}
<!-- Login box ends --> 
<!-- How it Works start -->
{{--@include('includes.how_it_works')--}}
<!-- How it Works Ends -->
<!-- Latest Jobs start -->
{{--@include('includes.latest_jobs')--}}
<!-- Latest Jobs ends --> 
<!-- Testimonials start -->
{{--@include('includes.testimonials')--}}
<!-- Testimonials End -->
<!-- Video start -->
{{--@include('includes.video')--}}
<!-- Video end --> 
<!-- Login box start -->
{{--@include('includes.employer_login_text')--}}
<!-- Login box ends --> 
<!-- Subscribe start -->
{{--@include('includes.subscribe')--}}
<!-- Subscribe End -->
@include('includes.footer')
@endsection
@push('scripts')
    <!--Map-->
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/mapdata/custom/world-palestine-highres.js"></script>
    <!--End Map-->
    <script>
    $(document).ready(function ($) {
        $('.lazy').Lazy();
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);
    });

    $('.owl-carousel').owlCarousel({
        stagePadding: 300,
        loop:true,
        margin:10,
        nav:false,
        items:1,
        lazyLoad: true,
        nav:true,
        responsive:{
            0:{
                items:1,
                stagePadding: 60
            },
            600:{
                items:1,
                stagePadding: 400
            },
            1000:{
                items:1,
                stagePadding: 400
            },
            1200:{
                items:1,
                stagePadding: 285
            },
            1400:{
                items:1,
                stagePadding: 350
            },
            1600:{
                items:1,
                stagePadding: 500
            },
            1800:{
                items:1,
                stagePadding: 600
            }
        }
    });
    $(function() {
        $(".video").click(function () {
            var theModal = $(this).data("target"),
                videoSRC = $(this).attr("data-video"),
                videoSRCauto = videoSRC + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1";
            $(theModal + ' iframe').attr('src', videoSRCauto);
            $(theModal + ' button.close').click(function () {
                $(theModal + ' iframe').attr('src', videoSRC);
            });
        });
    });

    // Prepare demo data
    // Data is joined to map using value of 'hc-key' property by default.

    // See API docs for 'joinBy' for more info on linking data and map.
    var data = [
        ['gl', 1232],
        ['sh', 5678],
        ['bu', 4645],
        ['lk', 4543],
        ['as', 3432],
        ['dk', 2343],
        ['fo', 2323],
        ['gu', 2341],
        ['mp', 1232],
        ['um', 9499],
        ['us', 1770],
        ['vi', 1771],
        ['ca', 1277],
        ['st', 1377],
        ['jp', 1664],
        ['cv', 1775],
        ['dm', 1776],
        ['sc', 1557],
        ['nz', 1844],
        ['ye', 1944],
        ['jm', 2660],
        ['ws', 2166],
        ['om', 2266],
        ['in', 2366],
        ['vc', 2664],
        ['bd', 1231],
        ['sb', 2666],
        ['lc', 2227],
        ['fr', 28123],
        ['nr', 2569],
        ['no', 3000],
        ['fm', 3001],
        ['kn', 3882],
        ['cn', 3883],
        ['bh', 37664],
        ['to', 3555],
        ['fi', 3633],
        ['id', 3337],
        ['mu', 3998],
        ['se', 3977],
        ['tt', 478],
        ['sw', 4189],
        ['br', 4279],
        ['bs', 4379],
        ['pw', 4479],
        ['ec', 4544],
        ['au', 4644],
        ['tv', 4333],
        ['mh', 4333],
        ['cl', 4333],
        ['ki', 5330],
        ['ph', 5133],
        ['gd', 53332],
        ['ee', 53*10],
        ['ag', 54*10],
        ['es', 55*10],
        ['bb', 56*10],
        ['it', 57*10],
        ['mt', 58*10],
        ['mv', 59*10],
        ['sp', 60*10],
        ['pg', 61*10],
        ['vu', 62*10],
        ['sg', 63*10],
        ['gb', 64*120],
        ['cy', 65*99],
        ['gr', 66*10],
        ['km', 67*10],
        ['fj', 68*10],
        ['ru', 69*10],
        ['va', 70*10],
        ['sm', 71*10],
        ['am', 72*10],
        ['az', 73*10],
        ['ls', 74*10],
        ['tj', 75*10],
        ['ml', 76*10],
        ['dz', 77*10],
        ['tw', 78*10],
        ['uz', 79*10],
        ['tz', 80*10],
        ['ar', 81*10],
        ['sa', 82*10],
        ['nl', 83*10],
        ['ae', 84*10],
        ['ch', 852*10],
        ['pt', 86*10],
        ['my', 87*10],
        ['pa', 88*10],
        ['tr', 89*10],
        ['ir', 90*10],
        ['ht', 91*10],
        ['do', 92*10],
        ['gw', 93*10],
        ['hr', 94*10],
        ['th', 95*10],
        ['mx', 96*10],
        ['kw', 97*10],
        ['de', 98*10],
        ['gq', 99*10],
        ['cnm', 100*10],
        ['nc', 101*10],
        ['ie', 102*10],
        ['kz', 103*10],
        ['ge', 104*10],
        ['pl', 105*10],
        ['lt', 106*10],
        ['ug', 107*10],
        ['cd', 108*10],
        ['mk', 109*10],
        ['al', 110*10],
        ['ng', 111*10],
        ['cm', 112*10],
        ['bj', 113*10],
        ['tl', 114*10],
        ['tm', 115*10],
        ['kh', 116*10],
        ['pe', 117*10],
        ['mw', 118*10],
        ['mn', 119*10],
        ['ao', 120*10],
        ['mz', 121*10],
        ['za', 122*10],
        ['cr', 123*10],
        ['sv', 124*10],
        ['bz', 125*10],
        ['co', 126*10],
        ['kp', 127*10],
        ['kr', 128*10],
        ['gy', 129*10],
        ['hn', 130*10],
        ['ga', 131*10],
        ['ni', 132*10],
        ['et', 133*10],
        ['sd', 134*10],
        ['so', 135*10],
        ['gh', 136*10],
        ['ci', 137*10],
        ['si', 138*10],
        ['gt', 139*10],
        ['ba', 140*10],
        ['jo', 141*10],
        ['sy', 142*10],
        ['we', 143*10],
        ['il', 144*10],
        ['eg', 145*10],
        ['zm', 146*10],
        ['mc', 147*10],
        ['uy', 148*10],
        ['rw', 149*10],
        ['bo', 150*10],
        ['cg', 151*10],
        ['eh', 152*10],
        ['rs', 153*10],
        ['me', 154*10],
        ['tg', 155*10],
        ['mm', 156*10],
        ['la', 157*10],
        ['af', 158*10],
        ['jk', 159*10],
        ['pk', 160*10],
        ['bg', 161*10],
        ['ua', 162*10],
        ['ro', 163*10],
        ['qa', 164*10],
        ['li', 165*10],
        ['at', 166*10],
        ['sk', 167*10],
        ['sz', 168*10],
        ['hu', 169*10],
        ['ly', 170*10],
        ['ne', 171*10],
        ['lu', 172*10],
        ['ad', 173*10],
        ['lr', 174*10],
        ['sl', 175*10],
        ['bn', 176*10],
        ['mr', 177*10],
        ['be', 178*10],
        ['iq', 179*10],
        ['gm', 180*10],
        ['ma', 181*10],
        ['td', 182*10],
        ['kv', 183*10],
        ['lb', 184*10],
        ['sx', 185*10],
        ['dj', 186*10],
        ['er', 187*10],
        ['bi', 188*10],
        ['sn', 189*10],
        ['gn', 190*10],
        ['zw', 191*10],
        ['py', 192*10],
        ['by', 193*10],
        ['lv', 194*10],
        ['bt', 195*10],
        ['na', 196*10],
        ['bf', 197*10],
        ['ss', 198*10],
        ['cf', 199*10],
        ['md', 200*10],
        ['gz', 201*10],
        ['ke', 202*10],
        ['bw', 203*10],
        ['cz', 204*10],
        ['pr', 205*10],
        ['tn', 206*10],
        ['cu', 207*10],
        ['vn', 208*10],
        ['mg', 209*10],
        ['ve', 210*10],
        ['is', 211*10],
        ['np', 212*10],
        ['sr', 213*10],
        ['kg', 214*10]
    ];

    // Create the chart
    Highcharts.mapChart('container', {
        chart: {
            map: 'custom/world-palestine-highres'
        },
        legend:{ enabled:false },
        title: {
            text: ''
        },

        subtitle: {
            text: ''
        },

        mapNavigation: {
            enabled: false,
            buttonOptions: {
                verticalAlign: 'bottom'

            }
        },
        exporting: {
            buttons: {
                contextButton: {
                    enabled: false
                }
            }
        },
        colorAxis: {
            min: 0
        },

        series: [{
            data: data,
            name: 'Teacher Accounts',
            states: {
                hover: {
                    color: '#BADA55'
                }
            },
            dataLabels: {
                enabled: false,
                format: '{point.name}'
            }
        }]
    });

    </script>
@include('includes.country_state_city_js')
@endpush
