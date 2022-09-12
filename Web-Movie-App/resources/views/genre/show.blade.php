

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Genre</h4>
                    <a href="{{ route('genre.create') }}" class="btn btn-primary">Add</a>
                </div>
                <div class="card-body">
                    @forelse(\App\Models\Genre::all() as $genre)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"  id="genre{{$genre->id}}">
                            <label class="form-check-label" for="genre{{$genre->id}}">
                                {{$genre->genre}}
                            </label>
                        </div>
                    @empty
                        <p class="text-danger fw-bolder text-center fa-2x">There is no genre</p>
                    @endforelse
                </div>
            </div>


