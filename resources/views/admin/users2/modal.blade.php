<div class="modal" id="modal-users">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modal-genre-title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control"
                               placeholder="Name"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email"
                               class="form-control"
                               placeholder="Email"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineActive" name="inlineActive" value="active" >
                        <label class="form-check-label" for="inlineActive">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineAdmin" name="inlineAdmin" value="admin">
                        <label class="form-check-label" for="inlineAdmin">Admin</label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Save genre</button>
                </form>
            </div>
        </div>
    </div>
</div>