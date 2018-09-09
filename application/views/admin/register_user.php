<section class="create-user-content" id="content">
    <form class="form-horizontal card" role="form">
        <div class="card-header">
            <h2>Fill in user details</h2>
        </div>
        
        <div class="card-body card-padding">
            <div class="form-group">
                <label class="col-sm-2 control-label">Names</label>
                <div class="col-sm-5">
                    <div class="fg-line">
                        <input name="first_name" type="text" class="form-control" placeholder="First Name" autofocus required>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="fg-line">
                        <input name="last_name" type="text" class="form-control" placeholder="Last Name" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <input name="username" type="text" class="form-control" placeholder="Username" required>
                    </div>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <input name="email" type="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Role</label>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <select name="role" class="form-control">
                            <option value="">Faculty Representative</option>
                            <option value="">Scheduler Manager</option>
                            <option value="">Administrator</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Register</button>
                </div>
            </div>
        </div>
    </form>

</section>