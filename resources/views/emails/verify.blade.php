<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Your account details</h2>

        <div>
            <p>Thanks for creating an account with the NERIST Online Application Portal.</p>
            <br>
            <p>
                You have registered with following data<br/>
                Name name = {{ $first_name }} {{ $last_name }} <br/>
                password = {{ $password }} <br/>
                mobile_no = {{ $mobile_no }} <br/>
                OTP = {{ $confirm_code }} <br/>
            </p>
            <p>
                Never reply this to email address
            </p>


        </div>

    </body>
</html>