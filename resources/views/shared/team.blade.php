<!-- Modal -->
<div class="modal fade" id="createdTeamModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Created Team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="team-form" method="POST" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="inviteUserInput"
                            class="form-label">Email address</label>
                        <input name="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="inviteUserInput">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
