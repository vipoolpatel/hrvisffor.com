<li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="title">Manage</span> <span class="arrow"></span> </a>
    <ul class="sub-menu">
        <li class="nav-item  "> <a href="{{ route('list.cms') }}" class="nav-link "> <span class="title">List C.M.S Pages</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.cms') }}" class="nav-link "> <span class="title">Add new C.M.S Page</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('list.cmsContent') }}" class="nav-link "> <span class="title">List Translated Pages</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.cmsContent') }}" class="nav-link "> <span class="title">Add new Translate Page</span> </a> </li>


        {{-- blog --}}

         <li class="nav-item  "> <a href="{{ route('blog') }}" class="nav-link "> <span class="title">List Blogs</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('add-new-blog') }}" class="nav-link "> <span class="title">Add Blog</span> </a> </li>
		<li class="nav-item  "> <a href="{{ URL::asset('/admin/blog_category')}}" class="nav-link "> <span class="title">Categories</span> </a> </li>

		{{-- seo --}}
		<li class="nav-item  "> <a href="{{ route('list.seo') }}" class="nav-link "> <span class="title">S.E.O Pages</span> </a> </li>

		{{-- FAQs --}}
	    <li class="nav-item  "> <a href="{{ route('list.faqs') }}" class="nav-link "> <span class="title">List FAQs</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.faq') }}" class="nav-link "> <span class="title">Add new FAQ</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.faqs') }}" class="nav-link "> <span class="title">Sort FAQs</span> </a> </li>

        {{-- Video --}}
        <li class="nav-item  "> <a href="{{ route('list.videos') }}" class="nav-link ">  <span class="title">List Video languages</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.video') }}" class="nav-link ">  <span class="title">Add new Video language</span> </a></li>


        {{-- Testimonials --}}
        <li class="nav-item  "> <a href="{{ route('list.testimonials') }}" class="nav-link ">  <span class="title">List Testimonials</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.testimonial') }}" class="nav-link ">  <span class="title">Add new Testimonial</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.testimonials') }}" class="nav-link "> <span class="title">Sort Testimonials</span> </a> </li>


        {{-- Sliders --}}

        <li class="nav-item  "> <a href="{{ route('list.sliders') }}" class="nav-link ">  <span class="title">List Sliders</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.slider') }}" class="nav-link ">  <span class="title">Add new Slider</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.sliders') }}" class="nav-link "> <span class="title">Sort Sliders</span> </a> </li>

    	@if(APAuthHelp::check(['SUP_ADM']))

    	{{-- Language --}}

   		<li class="nav-item  "> <a href="{{ route('list.languages') }}" class="nav-link "> <span class="title">List Languages</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.language') }}" class="nav-link "> <span class="title">Add new Language</span> </a> </li>

        {{-- countries --}}

        <li class="nav-item  "> <a href="{{ route('list.countries') }}" class="nav-link "> <span class="title">List Countries</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.country') }}" class="nav-link "> <span class="title">Add new Country</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.countries') }}" class="nav-link "> <span class="title">Sort Countries</span> </a> </li>

        {{-- Country Details --}}

        <li class="nav-item  "> <a href="{{ route('list.country.details') }}" class="nav-link "> <span class="title">List Country Details</span> </a> </li>  

        {{-- States --}}

        <li class="nav-item  "> <a href="{{ route('list.states') }}" class="nav-link "> <span class="title">List States</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.state') }}" class="nav-link ">  <span class="title">Add new State</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.states') }}" class="nav-link ">  <span class="title">Sort States</span> </a> </li>   

        {{-- Cities --}}

        <li class="nav-item  "> <a href="{{ route('list.cities') }}" class="nav-link "> <span class="title">List Cities</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.city') }}" class="nav-link "> <span class="title">Add new City</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.cities') }}" class="nav-link "> <span class="title">Sort Cities</span> </a> </li>


		{{-- packages --}}

        <li class="nav-item  "> <a href="{{ route('list.packages') }}" class="nav-link "> <span class="title">List Packages</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.package') }}" class="nav-link "> <span class="title">Add new Package</span> </a> </li>


        {{-- Language Levels --}}

        <li class="nav-item  "> <a href="{{ route('list.language.levels') }}" class="nav-link "> <span class="title">List Language Levels</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.language.level') }}" class="nav-link ">  <span class="title">Add new Language Level</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.language.levels') }}" class="nav-link ">  <span class="title">Sort Language Levels</span> </a> </li>

        {{-- career --}}

        <li class="nav-item  "> <a href="{{ route('list.career.levels') }}" class="nav-link "> <span class="title">List Career Levels</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.career.level') }}" class="nav-link "> <span class="title">Add new Career Level</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.career.levels') }}" class="nav-link "> <span class="title">Sort Career Levels</span> </a> </li>

		{{-- Functional Areas --}}

        <li class="nav-item  "> <a href="{{ route('list.functional.areas') }}" class="nav-link "> <span class="title">List Functional Areas</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.functional.area') }}" class="nav-link "> <span class="title">Add new Functional Area</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.functional.areas') }}" class="nav-link "> <span class="title">Sort Functional Areas</span> </a> </li>


        {{-- Genders --}}

        <li class="nav-item  "> <a href="{{ route('list.genders') }}" class="nav-link "> <span class="title">List Genders</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.gender') }}" class="nav-link "> <span class="title">Add new Gender</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.genders') }}" class="nav-link "> <span class="title">Sort Genders</span> </a> </li>

        {{-- industries --}}

        <li class="nav-item  "> <a href="{{ route('list.industries') }}" class="nav-link "> <span class="title">List Industries</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.industry') }}" class="nav-link "> <span class="title">Add new Industry</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.industries') }}" class="nav-link "> <span class="title">Sort Industries</span> </a> </li>

        {{-- Experiences --}}

        <li class="nav-item  "> <a href="{{ route('list.job.experiences') }}" class="nav-link ">  <span class="title">List Job Experiences</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.job.experience') }}" class="nav-link ">  <span class="title">Add new Job Experience</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.job.experiences') }}" class="nav-link ">  <span class="title">Sort Job Experiences</span> </a> </li>


        {{-- Job Skills --}}

         <li class="nav-item  "> <a href="{{ route('list.job.skills') }}" class="nav-link "> <span class="title">List Job Skills</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.job.skill') }}" class="nav-link "> <span class="title">Add new Job Skill</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.job.skills') }}" class="nav-link "> <span class="title">Sort Job Skills</span> </a> </li>


        {{-- Job Types --}}

        <li class="nav-item  "> <a href="{{ route('list.job.types') }}" class="nav-link"> <span class="title">List Job Types</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.job.type') }}" class="nav-link"> <span class="title">Add new Job Type</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.job.types') }}" class="nav-link"> <span class="title">Sort Job Types</span> </a> </li>

		{{-- Job Shifts --}}

     	<li class="nav-item  "> <a href="{{ route('list.job.shifts') }}" class="nav-link "> <span class="title">List Job Shifts</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.job.shift') }}" class="nav-link "> <span class="title">Add new Job Shift</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.job.shifts') }}" class="nav-link "> <span class="title">Sort Job Shifts</span> </a> </li>

        {{-- Degree Levels --}}

       <li class="nav-item  "> <a href="{{ route('list.degree.levels') }}" class="nav-link ">  <span class="title">List Degree Levels</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.degree.level') }}" class="nav-link ">  <span class="title">Add new Degree Level</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.degree.levels') }}" class="nav-link "> <span class="title">Sort Degree Levels</span> </a> </li>

		{{-- Degree Type --}}

  		<li class="nav-item  "> <a href="{{ route('list.degree.types') }}" class="nav-link "> <span class="title">List Degree Types</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.degree.type') }}" class="nav-link "> <span class="title">Add new Degree Type</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.degree.types') }}" class="nav-link "> <span class="title">Sort Degree Types</span> </a> </li>

		{{-- Major Subjects --}}

        <li class="nav-item  "> <a href="{{ route('list.major.subjects') }}" class="nav-link "> <span class="title">List Major Subjects</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.major.subject') }}" class="nav-link "> <span class="title">Add new Major Subject</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.major.subjects') }}" class="nav-link "> <span class="title">Sort Major Subjects</span> </a> </li>

        {{-- Result Types --}}

        <li class="nav-item  "> <a href="{{ route('list.result.types') }}" class="nav-link "> <span class="title">List Result Types</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.result.type') }}" class="nav-link "> <span class="title">Add new Result Type</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.result.types') }}" class="nav-link "> <span class="title">Sort Result Types</span> </a> </li>

        {{-- Marital Statuses --}}

        <li class="nav-item  "> <a href="{{ route('list.marital.statuses') }}" class="nav-link "> <span class="title">List Marital Statuses</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.marital.status') }}" class="nav-link "> <span class="title">Add new Marital Status</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.marital.statuses') }}" class="nav-link "> <span class="title">Sort Marital Statuses</span> </a> </li>

        {{-- Ownership Types --}}

        <li class="nav-item  "> <a href="{{ route('list.ownership.types') }}" class="nav-link "> <span class="title">List Ownership Types</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.ownership.type') }}" class="nav-link ">  <span class="title">Add new Ownership Type</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.ownership.types') }}" class="nav-link ">  <span class="title">Sort Ownership Types</span> </a> </li>

        {{-- Salary Periods --}}

        <li class="nav-item  "> <a href="{{ route('list.salary.periods') }}" class="nav-link ">  <span class="title">List Salary Periods</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.salary.period') }}" class="nav-link ">  <span class="title">Add new Salary Period</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('sort.salary.periods') }}" class="nav-link "> <span class="title">Sort Salary Periods</span> </a> </li>

        {{-- Site Settings --}}
        
        <li class="nav-item  "> <a href="{{ route('edit.site.setting') }}" class="nav-link "> <span class="title">Manage Site Settings</span> </a> </li>


        @endif	

    </ul>
</li>