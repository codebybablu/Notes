<form method="POST" action="{{ route('change-password') }}">
    @csrf

    <div class="form-group">
        <label for="old_password">Old Password:</label>
        <input type="password" class="form-control" id="old_password" name="old_password" required>
        @if ($errors->has('old_password'))
            <span class="text-danger">{{ $errors->first('old_password') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="new_password">New Password:</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
        @if ($errors->has('new_password'))
            <span class="text-danger">{{ $errors->first('new_password') }}</span>
        @endif
    </div>

    <div class="form-group">
        <label for="new_password_confirmation">Confirm New Password:</label>
        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        @if ($errors->has('new_password_confirmation'))
            <span class="text-danger">{{ $errors->first('new_password_confirmation') }}</span>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Change Password</button>
</form>