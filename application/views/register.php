<form class="form-horizontal" method="post" action="<?php echo base_url('register/create') ?>">
    <fieldset>

        <!-- Form Name -->
        <legend>Registration Form</legend>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="username">Username</label>
            <div class="controls">
                <input id="username" name="username" type="text" placeholder="" class="input-xlarge">

            </div>
        </div>

        <!-- Password input-->
        <div class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input id="password" name="password" type="password" placeholder="" class="input-xlarge">

            </div>
        </div>

        <!-- Password input-->
        <div class="control-group">
            <label class="control-label" for="Confirmation">Confirmation</label>
            <div class="controls">
                <input id="confirmation" name="confirmation" type="password" placeholder="" class="input-xlarge">

            </div>
        </div>

        <!-- Button -->
        <div class="control-group">
            <label class="control-label" for="register"></label>
            <div class="controls">
                <button id="register" name="register" class="btn btn-primary">Register</button>
            </div>
        </div>

    </fieldset>
</form>
