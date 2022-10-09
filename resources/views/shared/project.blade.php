<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="project-form" method="POST" action="{{route('projects.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="projectNameInput"
                            class="form-label">Project name</label>
                        <input name="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="projectNameInput">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="projectKeyInput"
                            class="form-label">Project key</label>
                        <input name="key" type="text" value="{{ old('key') }}" class="form-control @error('key') is-invalid @enderror" readonly id="projectKeyInput">
                        @error('key')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="descriptionTexarea" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="descriptionTexarea" rows="3">{{ old('description') }}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="creatProject()" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
