<div class="modal-body">
    <div class="form-body">

        <div class="formrow">
              <label>{{__('Start Date')}}</label>
              <input type="date" required name="r_start_date" value="{{ !empty($profileExperience->r_start_date) ? $profileExperience->r_start_date : '' }}" class="form-control">
        </div>

        <div class="formrow">
              <label>{{__('End Date')}}</label>
              <input type="date" required name="r_end_date" value="{{ !empty($profileExperience->r_end_date) ? $profileExperience->r_end_date : '' }}" class="form-control">
        </div>

        <div class="formrow">
              <label>{{__('Company Name')}}</label>
              <input type="text" required name="r_company_name" value="{{ !empty($profileExperience->r_company_name) ? $profileExperience->r_company_name : '' }}" class="form-control">
        </div>

        <div class="formrow">
              <label>{{__('Position')}}</label>
              <input type="text" required name="r_position" value="{{ !empty($profileExperience->r_position) ? $profileExperience->r_position : '' }}" class="form-control">
        </div>

        <div class="formrow">
              <label>{{__('Title')}}</label>
              <input type="text" required name="r_title" value="{{ !empty($profileExperience->r_title) ? $profileExperience->r_title : '' }}" class="form-control">
        </div>

        <div class="formrow">
              <label>{{__('Duty')}}</label>
              <input type="text" required name="r_duty" value="{{ !empty($profileExperience->r_duty) ? $profileExperience->r_duty : '' }}" class="form-control">
        </div>
     
        
    </div>
</div>