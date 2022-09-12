
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Quality</h4>
                <a href="{{ route('quality.create') }}" class="btn btn-primary">Add</a>
            </div>
            <div class="card-body">
                @forelse(\App\Models\Quality::all() as $q)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"  id="quality{{$q->id}}">
                        <label class="form-check-label" for="quality{{$q->id}}">
                            {{$q->quality_name}}
                        </label>
                    </div>
                @empty
                    <p class="text-danger fw-bolder text-center fa-2x">There is no quality</p>
                @endforelse
            </div>
        </div>


