<div class="modal fade modal_popup_cls" id="loginmodal" aria-hidden="true" aria-labelledby="loginmodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title_heading black_color heading_font" id="loginmodal">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Login Form -->
                <form id="loginForm">
                    @csrf
                    <div class="form-group mt-4">
                        <input type="text" class="form-control" name="email" placeholder="User Email *" required />
                    </div>
                    <div class="form-group mt-5">
                        <input type="password" class="form-control" name="password" placeholder="Password *" required />
                        <a class="forget_buttons" onclick="showRegisterForm();">Create Account</a>
                    </div>
                    <div class="form-group">
                        <div class="buttonclass1 mt60">
                            <button type="submit">Sign In <i class="las la-arrow-right"></i></button>
                        </div>
                    </div>
                </form>

                <!-- Registration Form (Hidden by Default) -->
                <form id="registerForm" style="display: none;">
                    @csrf
                    <div class="form-group mt-4">
                        <input type="text" class="form-control" name="name" placeholder="Full Name *" required />
                    </div>
                    <div class="form-group mt-4">
                        <input type="text" class="form-control" name="username" placeholder="Full Username *" required />
                    </div>
                    <div class="form-group mt-4">
                        <input type="email" class="form-control" name="email" placeholder="Email Address *"
                            required />
                    </div>
                    <div class="form-group mt-4">
                        <input type="password" class="form-control" name="password" placeholder="Password *" required />
                    </div>
                    <div class="form-group mt-4">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Confirm Password *" required />
                    </div>
                    <div class="form-group">
                        <div class="buttonclass1 mt60">
                            <button type="submit">Register <i class="las la-arrow-right"></i></button>
                        </div>
                    </div>
                    <div class="form-group mt-5">
                      <a class="forget_buttons text-black text-decoration-none" onclick="showLoginForm();">
                          Already have an account? Login
                      </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@section('login.scripts')
    <script>

        // Show Register Form
        function showRegisterForm() {
            $('#loginForm').hide();
            $('#registerForm').show();
        }

        // Show Login Form
        function showLoginForm() {
            $('#registerForm').hide();
            $('#loginForm').show();
        }

        $(document).ready(function() {
            // Handle Login
            $('#loginForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('customer.login') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#loginForm button').text('Signing In...');
                    },
                    success: function(response) {
                        if (response.success) {
                            Command: toastr["success"]('Login Successfully', "Success");
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr) {
                        Command: toastr["error"]('Login failed', "error");
                    },
                    complete: function() {
                        $('#loginForm button').text('Sign In');
                    }
                });
            });

            // Handle Registration
            $('#registerForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('register') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#registerForm button').text('Registering...');
                    },
                    success: function(response) {
                        if (response.success) {
                            Command: toastr["success"]('Registeration Successfully', "Success");
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 2000); // 1000 milliseconds = 1 second
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = '';
                        $.each(errors, function(key, value) {
                            errorMsg += value + "\n";
                        });
                        Command: toastr["error"](errorMsg, "error");
                    },
                    complete: function() {
                        $('#registerForm button').text('Register');
                    }
                });
            });
        });
    </script>
@endsection
