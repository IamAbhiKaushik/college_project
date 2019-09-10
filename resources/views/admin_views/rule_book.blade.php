@extends('layouts.frame')

@section('inside')

    <li class="breadcrumb-item active">Guidelines !</li>
    </ol><br>
   <h3>Creating a new Test</h3>
   <p>Go to <a href="/admin_views/create_test">Create Test</a></p>
    <h4>PDF Upload for questions</h4>
   <p>PDF should have <ul>
        <li>One question on each page with ONLY first Page having instructions rest a question per page</li>
        <li>Each page should be statement size</li>
        <li><a href="https://goo.gl/FUHZXM" target="_blank">Download sample Doc File{Convert to PDF}</a></li>
        <li>For paragraph based question include paragraph for every question related to that particular question in a Page</li>
    </ul></p><hr>
    <h4>Excel Sheet for question details</h4><p><ul>
        <li>Excel sheet should be in XLSX format</li>
        <li><a href="http://bit.ly/2LAVnZl" target="_blank">Download sample Format Here</a></li>
        <li>Fields in xlsx file
        <ul>
            <li><b>Column:A Question Number</b><br>Question number in excel sheet correspond to question in each page of PDF<br>Page 1 of PDF is instruction starting form page 2 and similarly in excel sheet starting from row 2 leave row one as header row</li>
            <li><b>Column:B Question Type</b><br>0 for Single Correct<br>1 for Multiple choice question<br>2 for Integer Type</li>
            <li><b>Column:C Question Subject/Stream</b><br>P=Physics<br>M=Mathematics<br>C=Chemistry<br>B=Biology</li>
            <li><b>Column:D Difficulty Level</b><br>E=Easy<br>M=Medium<br>H=Difficult</li>
            <li><b>Column:E Correct Answer</b><br>Example A(Single Correct),AB(Multiple Correct),22(Integer Type)</li>
            <li><b>Column:F Marks</b><br>Marks given for correct response </li>
            <li><b>Column:G Negative Marks</b><br>Negative marks for WRONG attempt no -ve sign</li>
        </ul>
        </li>
        <li>Do not leave any blank row in between nor repeat any question number in excel sheet question number column each question dettail would be mapped to page in PDF</li>
    </ul>
    </p><br><br>
    <h3>Updating Test</h3>
       <p>Test cannot be updated after exam is started</p>
<br><br>
    <h3>Deleting Test</h3>
    <p>Test can be deleted,not during the time when exam is running,just by clicking delete in test details page</p>
    

@endsection