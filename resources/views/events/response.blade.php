<!DOCTYPE html>
<html>
<head>
    <title>Exam Response | UserName</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Exam Completed Successfully.</h2>
    <p>Here is the final response of the exam you just attempted.</p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="info">
                <th>#</th>
                <th>Total Question</th>
                <th>Questions Attempted</th>
                <th>Correct Attempts</th>
                <th>Section Marks</th>
                <th>Marks Scored</th>
                <th>Time Spent(sec)</th>
            </tr>
            </thead>
            <tbody>
            @foreach(explode(",",$inExam['totalQ']) as $key=>$totalQ)
            <tr>

                <td>{{$key+1}}</td>
                <td>{{explode(",",$inExam['totalQ'])[$key]}}</td>
                <td>{{explode(",",$inExam['totalQ'])[$key] - explode(",",$inExam['totalNotAttempted'])[$key]}}</td>
                <td>{{explode(",",$inExam['totalCorrect'])[$key]}}</td>
                <td>{{explode(",",$inExam['examMarks'])[$key]}}</td>
                <td>{{explode(",",$inExam['totalMarks'])[$key]}}</td>
                <td>{{explode(",",$inExam['totalTime'])[$key]}}</td>
            </tr>
            @endforeach
            <th>Total</th>
            <th>{{array_sum(explode(",",$inExam['totalQ']))}}</th>
            <th>{{array_sum(explode(",",$inExam['totalQ'])) - array_sum(explode(",",$inExam['totalNotAttempted']))}}</th>
            <th>{{array_sum(explode(",",$inExam['totalCorrect']))}}</th>
            <th>{{array_sum(explode(",",$inExam['examMarks']))}}</th>
            <th>{{array_sum(explode(",",$inExam['totalMarks']))}}</th>
            <th>{{array_sum(explode(",",$inExam['totalTime']))}}</th>

            </tbody>
        </table>
    </div>


    <p>You can now close this window, further analytics of the exam can be found out in your dashboard under Performance Records.</p>
    <button class="btn btn-success" onclick="closeWin()"> Close Window and return to Dashboard</button>
</div>


<script>
    function closeWin() {
        parent.window.close();
        // myExamWindow.close();
    }

</script>

</body>
</html>
