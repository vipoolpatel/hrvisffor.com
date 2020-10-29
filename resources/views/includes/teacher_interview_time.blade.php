<?php
/**
 * Created by Tanay Kumar Roy<tanayroy12@gmail.com>.
 * User: Tanay
 * Date: 7/24/2020
 * Time: 4:05 PM
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

        @foreach($teacher_times as $r)
            <tr>
                <td>{{ $r->date }}></td>
                <td>{{ $r->time }}</td>
                <td>{{ $r->duration }}</td>
                <td>{{ $r->note }}</td>
                <td>@if($r->is_approve)
                        {{ 'Confirmed' }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
