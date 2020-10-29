<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/23/2020
 * Time: 8:27 PM
 */
?>
<div class="table-responsive">
<table class="table border">
    <thead>
    <th>Date</th>
    <th>Time</th>
    <th>Duration</th>
    <th>Note</th>
    <th>Status</th>
    </thead>
    <tbody>
        @foreach($school_times as $r)
            <tr>
                <td>
                    <input type="hidden" name="job_id" value="{{ $r->job_id }}">
                    <input type="hidden" name="user_id" value="{{ $r->user_id }}">
                    <input type="hidden" name="invitation_id" value="{{ $r->invitation_id }}">
                    <input type="hidden" name="time_zone" id="timeZone">
                    <input type="hidden" name="apply_id" value="{{ $r->apply_id }}">
                    <input type="date" value="{{ $r->date }}" class="form-control" name="date[]"></td>
                <td><input type="time" value="{{ $r->time }}"class="form-control"  name="time[]"></td>
                <td><input type="number" value="{{ $r->duration }}" name="duration[]" class="form-control" ></td>
                <td><textarea name="note[]" class="form-control" >{{ $r->note }}</textarea></td>
                <td>@if($r->is_approve)
                        {{ 'Confirmed' }}
                @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>