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
                <form method="POST" action="{{ route(Auth::user()->getRoleNames()->first() . '.schedule.store', $child->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="scheduled_date">Interview Date</label>
                        <input type="date" class="form-control" name="scheduled_date" value="{{ $child->schedule->date ?? '' }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                </form>
            </div>
        </div>
    </div>
</div>