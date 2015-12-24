<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>Your Admit Card has been Generated.</title>
    </head>
    <body>
        <h2>Your Admit Card has been Generated.</h2>

        <div>
            <p>{{ $message_text }}</p>
            
            <p>Following are the details about yourself <br><br>
            Name: &nbsp; <b>{{ $name }}</b> <br>
            Form No: &nbsp; <b>{{ $form_no }}</b> <br>
            Roll No: &nbsp;<b>{{ $rollno }}</b> <br>
            Test Center: <b>{{ $center_name }}</b> <br><br>

            <i>Click below to get your admit Card details.</i><br>
            <a href="{{ URL::route('students.login') }}"> Login to Admission Portal</a> 
             or copy paste the following link in the browser<br>
            {{ URL::route('students.login') }}
            <br>
            And choose your desired programme and click on continue the process and take colour print out of the application.
            </p>
            <p>
                Never reply to this email address.<br>This is a automated system generated email.
            </p>


        </div>

    </body>
</html>