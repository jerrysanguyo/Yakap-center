<div class="modal fade" id="scheduleModal{{ $child->id }}" tabindex="-1" role="dialog" aria-labelledby="scheduleModal{{ $child->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModal{{ $child->id }}Label">Schedule Interview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- You can place your form or any content here -->
                <form method="POST" action="{{ route(Auth::user()->getRoleNames()->first() . '.schedule.store', $child->parents_id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="interview_date">Interview Date</label> {{ $child->parents_id }}
                        <input type="date" class="form-control" name="interview_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                </form>
            </div>
        </div>
    </div>
</div>