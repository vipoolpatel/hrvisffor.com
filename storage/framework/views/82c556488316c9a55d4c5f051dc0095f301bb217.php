<li class="nav-item  "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="title">Manage</span> <span class="arrow"></span> </a>
    <ul class="sub-menu">
        <li class="nav-item  "> <a href="<?php echo e(route('list.cms')); ?>" class="nav-link "> <span class="title">List C.M.S Pages</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.cms')); ?>" class="nav-link "> <span class="title">Add new C.M.S Page</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('list.cmsContent')); ?>" class="nav-link "> <span class="title">List Translated Pages</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.cmsContent')); ?>" class="nav-link "> <span class="title">Add new Translate Page</span> </a> </li>


        

         <li class="nav-item  "> <a href="<?php echo e(route('blog')); ?>" class="nav-link "> <span class="title">List Blogs</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('add-new-blog')); ?>" class="nav-link "> <span class="title">Add Blog</span> </a> </li>
		<li class="nav-item  "> <a href="<?php echo e(URL::asset('/admin/blog_category')); ?>" class="nav-link "> <span class="title">Categories</span> </a> </li>

		
		<li class="nav-item  "> <a href="<?php echo e(route('list.seo')); ?>" class="nav-link "> <span class="title">S.E.O Pages</span> </a> </li>

		
	    <li class="nav-item  "> <a href="<?php echo e(route('list.faqs')); ?>" class="nav-link "> <span class="title">List FAQs</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.faq')); ?>" class="nav-link "> <span class="title">Add new FAQ</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.faqs')); ?>" class="nav-link "> <span class="title">Sort FAQs</span> </a> </li>

        
        <li class="nav-item  "> <a href="<?php echo e(route('list.videos')); ?>" class="nav-link ">  <span class="title">List Video languages</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.video')); ?>" class="nav-link ">  <span class="title">Add new Video language</span> </a></li>


        
        <li class="nav-item  "> <a href="<?php echo e(route('list.testimonials')); ?>" class="nav-link ">  <span class="title">List Testimonials</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.testimonial')); ?>" class="nav-link ">  <span class="title">Add new Testimonial</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.testimonials')); ?>" class="nav-link "> <span class="title">Sort Testimonials</span> </a> </li>


        

        <li class="nav-item  "> <a href="<?php echo e(route('list.sliders')); ?>" class="nav-link ">  <span class="title">List Sliders</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.slider')); ?>" class="nav-link ">  <span class="title">Add new Slider</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.sliders')); ?>" class="nav-link "> <span class="title">Sort Sliders</span> </a> </li>

    	<?php if(APAuthHelp::check(['SUP_ADM'])): ?>

    	

   		<li class="nav-item  "> <a href="<?php echo e(route('list.languages')); ?>" class="nav-link "> <span class="title">List Languages</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.language')); ?>" class="nav-link "> <span class="title">Add new Language</span> </a> </li>

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.countries')); ?>" class="nav-link "> <span class="title">List Countries</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.country')); ?>" class="nav-link "> <span class="title">Add new Country</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.countries')); ?>" class="nav-link "> <span class="title">Sort Countries</span> </a> </li>

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.country.details')); ?>" class="nav-link "> <span class="title">List Country Details</span> </a> </li>  

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.states')); ?>" class="nav-link "> <span class="title">List States</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.state')); ?>" class="nav-link ">  <span class="title">Add new State</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.states')); ?>" class="nav-link ">  <span class="title">Sort States</span> </a> </li>   

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.cities')); ?>" class="nav-link "> <span class="title">List Cities</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.city')); ?>" class="nav-link "> <span class="title">Add new City</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.cities')); ?>" class="nav-link "> <span class="title">Sort Cities</span> </a> </li>


		

        <li class="nav-item  "> <a href="<?php echo e(route('list.packages')); ?>" class="nav-link "> <span class="title">List Packages</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.package')); ?>" class="nav-link "> <span class="title">Add new Package</span> </a> </li>


        

        <li class="nav-item  "> <a href="<?php echo e(route('list.language.levels')); ?>" class="nav-link "> <span class="title">List Language Levels</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.language.level')); ?>" class="nav-link ">  <span class="title">Add new Language Level</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.language.levels')); ?>" class="nav-link ">  <span class="title">Sort Language Levels</span> </a> </li>

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.career.levels')); ?>" class="nav-link "> <span class="title">List Career Levels</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.career.level')); ?>" class="nav-link "> <span class="title">Add new Career Level</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.career.levels')); ?>" class="nav-link "> <span class="title">Sort Career Levels</span> </a> </li>

		

        <li class="nav-item  "> <a href="<?php echo e(route('list.functional.areas')); ?>" class="nav-link "> <span class="title">List Functional Areas</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.functional.area')); ?>" class="nav-link "> <span class="title">Add new Functional Area</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.functional.areas')); ?>" class="nav-link "> <span class="title">Sort Functional Areas</span> </a> </li>


        

        <li class="nav-item  "> <a href="<?php echo e(route('list.genders')); ?>" class="nav-link "> <span class="title">List Genders</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.gender')); ?>" class="nav-link "> <span class="title">Add new Gender</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.genders')); ?>" class="nav-link "> <span class="title">Sort Genders</span> </a> </li>

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.industries')); ?>" class="nav-link "> <span class="title">List Industries</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.industry')); ?>" class="nav-link "> <span class="title">Add new Industry</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.industries')); ?>" class="nav-link "> <span class="title">Sort Industries</span> </a> </li>

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.job.experiences')); ?>" class="nav-link ">  <span class="title">List Job Experiences</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.job.experience')); ?>" class="nav-link ">  <span class="title">Add new Job Experience</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.job.experiences')); ?>" class="nav-link ">  <span class="title">Sort Job Experiences</span> </a> </li>


        

         <li class="nav-item  "> <a href="<?php echo e(route('list.job.skills')); ?>" class="nav-link "> <span class="title">List Job Skills</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.job.skill')); ?>" class="nav-link "> <span class="title">Add new Job Skill</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.job.skills')); ?>" class="nav-link "> <span class="title">Sort Job Skills</span> </a> </li>


        

        <li class="nav-item  "> <a href="<?php echo e(route('list.job.types')); ?>" class="nav-link"> <span class="title">List Job Types</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.job.type')); ?>" class="nav-link"> <span class="title">Add new Job Type</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.job.types')); ?>" class="nav-link"> <span class="title">Sort Job Types</span> </a> </li>

		

     	<li class="nav-item  "> <a href="<?php echo e(route('list.job.shifts')); ?>" class="nav-link "> <span class="title">List Job Shifts</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.job.shift')); ?>" class="nav-link "> <span class="title">Add new Job Shift</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.job.shifts')); ?>" class="nav-link "> <span class="title">Sort Job Shifts</span> </a> </li>

        

       <li class="nav-item  "> <a href="<?php echo e(route('list.degree.levels')); ?>" class="nav-link ">  <span class="title">List Degree Levels</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.degree.level')); ?>" class="nav-link ">  <span class="title">Add new Degree Level</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.degree.levels')); ?>" class="nav-link "> <span class="title">Sort Degree Levels</span> </a> </li>

		

  		<li class="nav-item  "> <a href="<?php echo e(route('list.degree.types')); ?>" class="nav-link "> <span class="title">List Degree Types</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.degree.type')); ?>" class="nav-link "> <span class="title">Add new Degree Type</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.degree.types')); ?>" class="nav-link "> <span class="title">Sort Degree Types</span> </a> </li>

		

        <li class="nav-item  "> <a href="<?php echo e(route('list.major.subjects')); ?>" class="nav-link "> <span class="title">List Major Subjects</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.major.subject')); ?>" class="nav-link "> <span class="title">Add new Major Subject</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.major.subjects')); ?>" class="nav-link "> <span class="title">Sort Major Subjects</span> </a> </li>

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.result.types')); ?>" class="nav-link "> <span class="title">List Result Types</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.result.type')); ?>" class="nav-link "> <span class="title">Add new Result Type</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.result.types')); ?>" class="nav-link "> <span class="title">Sort Result Types</span> </a> </li>

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.marital.statuses')); ?>" class="nav-link "> <span class="title">List Marital Statuses</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.marital.status')); ?>" class="nav-link "> <span class="title">Add new Marital Status</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.marital.statuses')); ?>" class="nav-link "> <span class="title">Sort Marital Statuses</span> </a> </li>

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.ownership.types')); ?>" class="nav-link "> <span class="title">List Ownership Types</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.ownership.type')); ?>" class="nav-link ">  <span class="title">Add new Ownership Type</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.ownership.types')); ?>" class="nav-link ">  <span class="title">Sort Ownership Types</span> </a> </li>

        

        <li class="nav-item  "> <a href="<?php echo e(route('list.salary.periods')); ?>" class="nav-link ">  <span class="title">List Salary Periods</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('create.salary.period')); ?>" class="nav-link ">  <span class="title">Add new Salary Period</span> </a> </li>
        <li class="nav-item  "> <a href="<?php echo e(route('sort.salary.periods')); ?>" class="nav-link "> <span class="title">Sort Salary Periods</span> </a> </li>

        
        
        <li class="nav-item  "> <a href="<?php echo e(route('edit.site.setting')); ?>" class="nav-link "> <span class="title">Manage Site Settings</span> </a> </li>


        <?php endif; ?>	

    </ul>
</li>