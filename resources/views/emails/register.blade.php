<html>
<body>
<p>Hello There,<br>
    Your student account has been created by {{Auth::user()->coachingName}} <br>
    Please Login <br>
    With username: <b>{{$student['unamee']}}</b><br>
    Password: <b>{{substr($student['email'], 0, -10)}}</b>
    <br>
    Please conserve this email for future reference.
    For more details and features about the online examination platform, 

    <!-- Visit: <a href="http://smrtbook.in" style="text-decoration: none;color: rgb(17,85,204)">http://smrtbook.in</a> -->

<p>Thanks and Regards,<br>
    
</p>

<!-- /*/*<p style="text-align: center">SmrtBook.in | Online Examination System</p>*/*/ -->
</body>
</html>