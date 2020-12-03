<h1>Create Own Login System Using Laravel Fortify </h1>
<h2>1. Installation</h2>
<pre>To get started, install Fortify using Composer:

<strong> composer require laravel/fortify  </strong>

Next, publish Fortify's resources:

<strong>php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"</strong>

This command will publish Fortify's actions to your app/Actions directory.
This directory will be 
created if it does not exist. In addition, Fortify's configuration file and 
migrations will be published.
Next, you should migrate your database:

<strong> php artisan migrate  </strong>

</pre>
<h2>2. Registering Providers</h2>
<pre>
All service providers are registered in the config/app.php configuration file.
This file contains 
a providers array where you can list the class names of your service providers.
By default, 
a set of Laravel core service providers are listed in this array. These 
providers bootstrap 
the core Laravel components, such as the mailer, queue, cache, and others.

To register your provider, add it to the array:

<strong>
	'providers' => [
    // Other Service Providers

    App\Providers\FortifyServiceProvider::class,
],
</strong>
</pre>
<h2>3. Enable Features</h2>
<pre>
The fortify configuration file contains a features configuration array. 
This array defines which 
backend routes / features Fortify will expose by default.
<strong>
'features' => [
    Features::registration(),
    Features::resetPasswords(),
    Features::emailVerification(),
],
</strong>
</pre>
<h2>4. Registration </h2>
<pre>
To begin implementing registration functionality, we need to instruct Fortify
how to return our register view.
<strong>
use Laravel\Fortify\Fortify;

Fortify::registerView(function () {
    return view('auth.register');
});
</strong>
Fortify will take care of generating the /register route that returns this view. 
Your register template
should include a form that makes a POST request to /register. The /register
action expects a string name,
string email address / username, password, and password_confirmation fields.
The name of 
the email / username field should match the username value of the fortify 
configuration file.

If the registration attempt is successful, Fortify will redirect you to the
URI configured via the home 
configuration option within your fortify configuration file. If the login 
request was an XHR request,
a 200 HTTP response will be returned.

If the request was not successful, the user will be redirected back to the 
registration screen and the 
validation errors will be available to you via the shared $errors Blade template
variable. Or, in the 
case of an XHR request, the validation errors will be returned with the 422 HTTP response.
</pre>
<h2>5. Authentication </h2>
<pre>
To get started, we need to instruct Fortify how to return our login view. 
<strong>
use Laravel\Fortify\Fortify;

Fortify::loginView(function () {
    return view('auth.login');
});
</strong>
Fortify will take care of generating the /login route that returns this view.
Your login template should
include a form that makes a POST request to /login.The /login action expects 
a string email address / username and a password.The name of the email / username
field should match 
the username value of the fortify configuration file. In addition, a boolean
remember field may
be provided to indicate that the user would like to use the "remember me" functionality.

If the login attempt is successful, Fortify will redirect you to the URI 
configured via the home 
configuration option within your fortify configuration file. If the login 
request was an XHR request,
a 200 HTTP response will be returned.

If the request was not successful, the user will be redirected back to the 
login screen and the 
validation errors will be available to you via the shared $errors Blade template
variable. Or, 
in the case of an XHR request,the validation errors will be returned with the 422
HTTP response.
</pre>
<h2>6. Password Reset </h2>
<pre>
To begin implementing password reset functionality, we need to instruct Fortify 
how to return our 
<strong>
"forgot password" view.
use Laravel\Fortify\Fortify;

Fortify::requestPasswordResetLinkView(function () {
    return view('auth.forgot-password');
});
</strong>
Fortify will take care of generating the /forgot-password route that returns 
this view. Your 
forgot-password template should include a form that makes a POST request 
to /forgot-password. 
The /forgot-password endpoint expects a string email field. The name of this 
field / database column 
should match the email value of the fortify configuration file.

If the password reset link request was successful, Fortify will redirect 
back to the /forgot-password 
route and send an email to the user with a secure link they can use to reset
their password. If the 
request was an XHR request, a 200 HTTP response will be returned.

After being redirected back to the /forgot-password route after a successful
request, the status session 
variable may be used to display the status of the password reset link request attempt:
<strong>
@if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
@endif
</strong>	
If the request was not successful, the user will be redirected back to the 
request password reset link 
screen and the validation errors will be available to you via the shared 
$errors Blade template variable.
Or, in the case of an XHR request, the validation errors will be returned 
with the 422 HTTP response.
</pre>
<h2>7. Resetting The Password </h2>
<pre>
To finish implementing password reset functionality, we need to instruct
Fortify how to return our 
"reset password" view.
<strong>
use Laravel\Fortify\Fortify;

Fortify::resetPasswordView(function ($request) {
    return view('auth.reset-password', ['request' => $request]);
});
</strong>
Fortify will take care of generating the route to display this view. 
Your reset-password template should 
include a form that makes a POST request to /reset-password. The /reset-password 
endpoint expects a string
email field, a password field, a password_confirmation field, and a hidden 
field named token that contains
the value of request()->route('token'). The name of the "email" 
field / database column should match the email
value of the fortify configuration file.

If the password reset request was successful, Fortify will redirect 
back to the /login route so that the 
user can login with their new password. In addition a status session 
variable will be set so that you may
display the successful status of the reset on your login screen:
<strong>
@if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
@endif
</strong>
If the request was an XHR request, a 200 HTTP response will be returned.

If the request was not successful, the user will be redirected back to 
the reset password screen and the 
validation errors will be available to you via the shared $errors Blade 
template variable. Or, in the case
of an XHR request, the validation errors will be returned with the 422 HTTP response.


</pre>
<h2>8. Email Verification </h2>
<pre>
After registration, you may wish for users to verify their email address 
before they continue accessing your
application. To get started, ensure the emailVerification feature is enabled
in your fortify configuration 
file's features array. Next, you should ensure that your App\Models\User 
class implements the MustVerifyEmail
interface. This interface is already imported into this model for you.

Once these two setup steps have been completed, newly registered users will
receive an email prompting them to
verify their email address ownership. However, we need to inform Fortify 
how to display the email verification
screen which informs the user that they need to go click the verification 
link in the email.

All of the authentication view's rendering logic may be customized using 
the appropriate methods available 
via the Laravel\Fortify\Fortify class. Typically, you should call this 
method from the boot method of your
FortifyServiceProvider:
<strong>
use Laravel\Fortify\Fortify;

Fortify::verifyEmailView(function () {
    return view('auth.verify-email');
});
</strong>
Fortify will take care of generating the route to display this view when 
a user is redirected to the /email/verify
endpoint by Laravel's built-in verified middleware.

Your verify-email template should include an informational message instructing
the user to click the email 
verification link that was sent to their email address. You may optionally 
add a button to this template that 
triggers a POST request to /email/verification-notification. When this 
endpoint receives a request, a new 
verification email link will be emailed to the user, allowing the user to get 
a new verification link if the 
previous one was accidentally deleted or lost.

If the request to resend the verification link email was successful, Fortify 
will redirect back to 
the /email/verify endpoint with a status session variable, allowing you to 
display an informational message 
to the user informing them the operation was successful. If the request was 
an XHR request, a 202 
HTTP response will be returned.

</pre>
<strong>I have to set mailer at .env file to send email </strong>
<h2>9. Protecting Routes </h2>
<pre>
To specify that a route or group of routes requires that the user has previously
verified their email address,
you should attach Laravel's built-in verified middleware to the route:
<strong>
Route::get('/home', function () {
    // ...
})->middleware(['verified']);
</strong>
To specify that a route or group of routes requires that the user is authenticated
you should attach Laravel's 
built-in auth middleware to the route:
<strong>
Route::get('/home', function () {
    // ...
})->middleware(['auth']);
</strong>
Writing together 
<strong>
Route::get('/home', function () {
    // ...
})->middleware(['auth','verified']);
</strong>
To assign middleware to all routes within a group, you may use the middleware 
method before defining the group.
Middleware are executed in the order they are listed in the array:
<strong>
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/home', function () {
        // ...
    });

    Route::get('user/profile', function () {
        // Uses first & second middleware...
    });
});
</strong>

</pre>
<h1> Thank you so much </h1>





 
