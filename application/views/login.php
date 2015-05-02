<form class="form-horizontal" method="post" action="<?php echo base_url('login/check') ?>">
    <fieldset>
        <!-- Form Name -->
        <legend>Login Form</legend>

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

        <!-- Button -->
        <div class="control-group">
            <label class="control-label" for="login"></label>
            <div class="controls">
                <button id="login" name="login" class="btn btn-primary">Login</button>
            </div>
        </div>

        <div class="control-group">
            <p> Register <a href="<? echo base_url('register'); ?>">here</a></p>
        </div>
    </fieldset>
</form>
