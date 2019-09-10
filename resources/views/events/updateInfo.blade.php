@extends('events.dash')
<style>
    .btnB:hover{
        background: #68dff0;
        color: white;
        cursor: pointer;
        border: 1px solid white;
    }
</style>
@section('sidebar')
    <li class="mt">
        <a href="/student/dashboard">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/performance" class="">
            <i class="fas fa-chart-pie"></i>
            <span>Performance Record</span>
        </a>
    </li>
    <li class="sub-menu">
        <a href="/student/records" >
            <i class="fa fa-tasks"></i>
            <span>Previous Exams</span>
        </a>
    </li>

    <li class="sub-menu">
        <a href="/student/important" >
            <i class="fa fa-book"></i>
            <span>Important Question</span>
        </a>
    </li>
    {{--<li><a class="logout" style="color: #4c5f99;--}}
    {{--background: none;--}}
    {{--font-size: 18px;--}}
    {{--border: none !IMPORTANT;--}}
    {{--padding: initial;" href="/student/logout">Logout</a></li>--}}
    {{--<li class="sub-menu">--}}
    {{--<a href="/student/public-exams" >--}}
    {{--<i class="fa fa-book"></i>--}}
    {{--<span>Public Exams</span>--}}
    {{--</a>--}}
    {{--</li>--}}

    <li class="sub-menu">
        <a href="/student/updateInfo" class="active">
            <i class="far fa-edit"></i>
            <span>Update Info</span>
        </a>
    </li>
    {{--<li class="sub-menu">--}}
    {{--<a href="/student/exams" >--}}
    {{--<i class="fa fa-th" ></i>--}}
    {{--<span>Available Exams</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--<li class="sub-menu">--}}
    {{--<a href="/student/updateInfo">--}}
    {{--<i class=" fa fa-bar-chart-o"></i>--}}
    {{--<span>Update Info</span>--}}
    {{--</a>--}}
    {{--</li>--}}

    <li class="logout">
        <a href="/student/logout" >
            <i class="fa fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

@endsection

@section('mainContent')
    <div class="row" style="padding-top: 10vh;color: #000;">
        <div class="col-sm-1"></div>
        <div class="col-sm-11" style="padding-bottom: 5vh;">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="/student/updateInfo" method="POST">
                {!! csrf_field() !!}
                <div class="row" style="padding:20px;">
                    {{--<div class="col-sm-4"><label>Your Coaching Institute</label></div>--}}
                    <div class="col-sm-12" style="text-align: center">
                        <b class="form-control-static" style="font-size: 140%;">
                            {{$data->coachingName}}
                        </b><br>
                        <b class="form-control-static" style="font-size: 100%;">
                            Update your Information
                        </b>
                        @if(session('message'))
                        <div class="alert alert-success">
                            <strong>Alert!</strong> {{session('message')}}
                        </div>
                        @endif

                        {{--<input class="form-control" name="coaching_name" value="{{$data->coachingName}}">--}}
                    </div>
                </div>

                <div class="row" style="padding:20px;">
                    <div class="col-sm-2"><label>Full Name</label></div>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="name" required value="{{$data->name}}">
                    </div>
                    <div class="col-sm-2"><label>Email-ID</label></div>
                    <div class="col-sm-4">
                        <input class="form-control" type="email" name="email" required value="{{$data->email}}" disabled>
                    </div>
                </div>
                <div class="row" style="padding:20px;">
                    <div class="col-sm-2"><label>Mobile No</label></div>
                    <div class="col-sm-4">
                        <input class="form-control" type="number" name="mobile" value="{{$data->phone}}" required>
                    </div>
                    <div class="col-sm-2"><label>Class</label></div>
                    <div class="col-sm-4">
                        <select class="form-control" name="class" required>
                            @if($data->class)
                                <option value="{{$data->class}}">{{$data->class}}</option>
                            @endif
                            <option value="8th Class">8th Class</option>
                            <option value="9th Class">9th Class</option>
                            <option value="10th Class">10th Class</option>
                                </select>
                                {{--<input class="form-control" type="number" name="class" value="{{$data->class}}" required>--}}
                            </div>
                        </div>


                        <div class="row" style="padding:20px;">
                            <div class="col-sm-2"><label>Your Batch</label></div>
                            <div class="col-sm-4">
                                @if($data->coaching_batch == NULL)
                                    <select class="form-control" name="coaching_batch" required>
                                        <option value="NSO Set-A | 1st Nov">NSO Set-A | 1st Nov</option>
                                        <option value="NSO Set-B | 15th Nov">NSO Set-B | 15th Nov</option>
                                        <option value="NSO Set-C | 27th Nov">NSO Set-C | 27th Nov</option>
                                    </select>
                                    {{--<input class="form-control" name="coaching_batch" value="{{$data->coaching_batch}}">--}}
                                @else
                                    <input class="form-control" name="coaching_batch" disabled value="{{$data->coaching_batch}}">
                                @endif
                            </div>

                            <div class="col-sm-2"><label>Your Roll Number</label></div>
                            <div class="col-sm-4">
                                <input class="form-control" name="coaching_rollno" required disabled value="{{$data->coaching_rollno}}">
                            </div>
                        </div>
                        <div class="row" style="padding:20px;">
                    <div class="col-sm-2"><label>Gender</label></div>
                    <div class="col-sm-4">
                        <select class="form-control" name="gender" required>
                            @if($data->gender)
                                <option value="{{$data->gender}}">{{$data->gender}}</option>
                            @endif
                            <option value="Male">Male</option>--}}
                            <option value="Female">Female</option>
                        </select>
                    </div>

                            <div class="col-sm-2"><label>Date of Birth</label></div>
                            <div class="col-sm-4">
                                <input class="form-control" type="date" name="dob" value="{{$data->dob}}">
                            </div>
                        </div>
                    <div class="row" style="padding:20px;">
                            <div class="col-sm-2"><label>Pin Code</label></div>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="pincode" value="{{$data->pincode}}">
                            </div>

                            <div class="col-sm-2"><label>School Name</label></div>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="school_name" value="{{$data->school}}">
                            </div>
                    </div>
                    <div class="row" style="padding:20px;">

                            <div class="col-sm-2"><label>School Email ID</label></div>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="school_email" value="{{$data->school_email}}">
                            </div>

                            <div class="col-sm-2"><label>School Mobile No</label></div>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="school_mobile" value="{{$data->school_mobile}}">
                            </div>
                    </div>
                    <div class="row" style="padding:20px;">

                            <div class="col-sm-2"><label>City</label></div>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="city" value="{{$data->city}}">
                            </div>


                            <div class="col-sm-2"><label>State</label></div>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="state" value="{{$data->state}}">
                            </div>

                    </div>

                <div class="row" style="padding:20px;">
                    <div class="col-sm-3"><label>Do you have a Passport</label></div>
                    <div class="col-sm-9">
                        @if($data->passport == NULL or $data->passport == 'No')
                            <input type="radio" onclick="handleClick(this);" name="passport_c" value="Yes"> Yes
                            <input type="radio" onclick="handleClick(this);" name="passport_c" value="No" checked style="margin-left: 40px;">No
                        @else
                            <input type="radio" onclick="handleClick(this);" name="passport_c" value="Yes" checked> Yes
                            <input type="radio" onclick="handleClick(this);" name="passport_c" value="No" style="margin-left: 40px;">No
                        @endif
                    {{--<input type="radio" onclick="handleClick(this);" name="passport_c" value="Yes"> Yes--}}
                    {{--<input type="radio" onclick="handleClick(this);" name="passport_c" value="No" checked style="margin-left: 40px;">No--}}
                    </div>
                </div>

                    <div id="passport" class="row" style="padding:20px;display: none;">
                    <div class="col-sm-3"><label>Provide your 7 Digit Passport Number</label></div>
                    <div class="col-sm-6">
                    <input class="form-control" type="text" name="passport" value="{{$data->passport}}">
                    </div>
                    </div>

                <script>
                    var currentValue = 0;
                    function handleClick(myRadio) {
                        if ((myRadio.value == 'Yes')){
                            document.getElementById('passport').style.display='block'
                        }
                        else{
                            document.getElementById('passport').style.display='none'
                        }
                        // alert('Old value: ' + currentValue);
                        // alert('New value: ' + myRadio.value);
                        currentValue = myRadio.value;
                    }
                    // $("passport_c").keyup(function(){
                    // var selection = window.getSelection().toString();
                    // if ( selection !== '' ) {
                    //     return;
                    // }
                </script>



                <div class="row" style="text-align: center">
                    <p>If you do not want to update the Password, leave the below two inputs empty.
                        {{--A password Update will require Email ID, where the new user credentials will be sent.--}}
                        </p>
                </div>
                <div class="row" style="padding:20px;">
                    <div class="col-sm-2"><label>Update Password</label></div>
                    <div class="col-sm-4">
                        <input class="form-control" type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                    </div>
                    <div class="col-sm-2"><label>Repeat Password</label></div>
                    <div class="col-sm-4">
                        <input class="form-control" type="password" name="re_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                    </div>
                </div>

                    {{--<div class="col-sm-2"><label>Institute Name</label></div>--}}
                    {{--<div class="col-sm-4">--}}
                        {{--<input class="form-control" type="text" name="institute">--}}
                    {{--</div>--}}




                <div class="row" style="padding:20px;">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <button class="btnE form-control" type="submit">Update Information</button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>



                <div style="text-align: center;padding: 20px">

                    <b style="font-size: 120%;">For any Issues, Contact:</b>
                    <br>

                    <br>
                    <a href="tel:+91-7045800411" style="margin-right: 20px;">
                    <img style="width: 24px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAU3SURBVHhe7ZxdiFtFFMezrgiK37W2uTNJ9s692S2rIoriB6iICr4oiESsL9oum8zcuLb1QfBBK+iTioqij1pFQQRF0CoiKviBpU9aK9SKhdqHYq22flVt6+o5uwek6Ulyk3uzuZk7P/hD2WbOOfPPZO7MnZsUHA6Hw+FwOBwOjqDYvDgQ5mUl9feBNPOgf/uVkuY+CpsPlIxWK6H/4szoU/NBSd9M4e1GFetlGHl/MiYkEozC1yiF3eBI4QxILv02pbCbQEY38gYklNBbKYXd+NJcyhqQVML8RCnsZrJYP4c1IAX5XnOS0tgNTPi/cgYkVsncSynsBuarbawByfUWpbAbWAO+yXQ+uYT+uVDYeAKlsReY8B9lDUhBE6JxIaWxl1CaGa7zaUgJs47S2Itf0ldxnU9J71AaeymXzVmwc/iH6XxiwQg8jPEplb1AZ79o7XxqEtEspbEXuBI/zXY+BSmpt1Aae1GycQvX+bQUrpxbTqnsZJXXXDaoeXBBXv0KSmUvsKX7nO18QuHNWrVCn0tp7CUU0QbOgMQS5mFKYTehmJMD+BjDOrA2TinsBzr8aYsB/UvobUrVz6DQ+QDmq3tYM3oUxPkWRzSFzQ9TpaYH67YjnCk96IdARiGFzB8wD77OmBJLYP4+XzYvoFD5xC81buDM6SqhD4SevojC5JoxJczXrEntJMxBPKCi9g7l6TtZo9oILhqPUFMHMj1dOwmM2d1qVDvB3Le/Ull3JjV3IPCxrHNmtROMwmepqQO5prDxRDBmZ6tRHTQPpl9LzR1I4DVuY4xqK/go78nlAroDYzCqPubMai/9ZbFYP4XaO/BosufdidDPU3MHAqPqKdaoDlKl6C5q7pheHp0KV9ldnFHtBIvxv0OhL6cQDuVF14ExPT0/jXvjsDQbUAgHXFCe44zqJLy1VZUNQSHyDV5dwZDtnFGdhHtr60/m4hKUovPAlD9aTYqhHZPlu30Kk2+UNGsYg7pL6L34nRQKkxiYY2+HaeUVX+q1I3d8gHtf1qQugk7/FnrmJgrTL2MQ68ljYgt9CPQCbidxG0qvyy60V/7gmE7E11E8RqVQPYF3iuDNe5WJ+b+EOQh6A96sB/Cpi0qxvgrbUYjsgE804FWW7UQcwYjpZdu3sB6V+kM2VhdBuyNU62b49xPKM3rxJvCQj12rZaOgoD2tBceWMF/hCKFwbZlatvY0MPwTNkYi6W+k3HAypRkOeJAEF5Yf+QK7C96A32F0rG/3THUYzp0Or0vvzLpFkPsxSjU8qiK6DAr5hSswrsDILa2nenh1hb9/xr0+NQl9gNINF1WqXwKd3c8WGVPQHu/8bKpUGhOL5g3moadWUReGDxhwPryje7kiexHejIAR/R33f4MQlZ8NlGhUoahejgOGLio9O9DD6+9zxWZRVHa2wMU2fAz72rEstajkbAJ71TsWdgdM4VkRlZpdJlZGlcEshNMRlZl1auMwEu8HIw9xnRimqMDRAL+MDeu7j7iODEtU2kgxhid3sG7cx3VoqUU1jR74UBIsmh/HhTPXsaUSlTO60F2dF2krx3ZykKIyRp8JT09BhzbB+jHNX1PqKkpvD74/swIuNA+msa+OoXlKax94Kx4X4jAi34V58jDT+TS0g9LZzcKXIkU0C2a+l6qZwjxEKfKDlDNn+0LfCkY+A4ZuD5J8TS3Fo9aRBW/7V2V0NZi5HubOlxZNNUePM+t4bc7V9/l6ozaOj5TgoVXgmSt9z1yPozYUpoa/XIc//0cvdDgcDofDkUEKhf8Ab/dGyiyLQB8AAAAASUVORK5CYII=">
                        {{$data->support_phone}}</a>
                    <a href="mailto:contact@smrtbook.in">
                    <img style="width: 24px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAYAAACOEfKtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAUWSURBVHhe7ZpJiFxFGMdnUNw9aAxOd73unrfMREccD+4iuKAgiIpILi4okfR71Z2BqFejBg8exERC8OSCyzFK9KhEb4p6UmI8uB40XlRwQ8UQ/Vf3VzL9qrre3pnuV3/4M9P9vq+66jdV9ep9PXNWVlZWVlZWVlZWVlZWVlZWVlYzoEaje4bf5pfW3UGwdiohyax5j0XP+A7/t7Zm/AlikV+eEz2qbXy2fRyTZychKC7fifqi0diHzKqPea3eAzT09FpivSuXnJDRS0WuE96D2fiP5gNnxph1f3lOeCcNWdFye4e7yMJL6OWoXCe6G2v+G9/pBfSWoqDJb0PMn7oPn3ZjcvzmNvlNNFRFfqt3EQB/7zJ+K701qgFA0RiLfkDQKr2tyGfh9Z7Df413YKrN+E8Bi66iISrC6rsCgH8UsckABw1GP/vN7tV0SZHX6l4mG5x6M37UdfoX09AUYdbduH7CpAMIA9Dvbiu8mS4rWurwCz3Gv1ufM20GnK+D1nafhqQIy/aO+JaVGqAwAP3tsuguClHU6YSL6MQX8bxpMPp9eEur36ShKMIqvE9308wEkHwM17ZRmKJOp7eAY84nmryNa8Y/vKDZ30RDUISYNVh7bMsDUPi43+IPU6iidpufg33ifU3eRvShLZu2nU1dV4RxPKbJ+d95AQ7N+JMUrmj1/EfOxPW3tXkbxFi2Bzud+0+jLsc1j5i98Zy4iwGEsS/uR/j8MGtUKytbT8Fyfl2Xd6KNmfXKdXOPn0xdjWnrSdjzXtLlxV0Y4MCMv5bQmRe1eSfImHn70DHtH11UWzCeN3R5OpcDEMYd6i3TcsD1Pbq8iZtFu6lPilY2987CinlHmzfGpQEUxrJ4z7whR7t0eROysaLiOA+ei/5/oMkzulSAAzP+sflIEO5A3KQrOcaKSru9vYGZ+akmL9HlA4Txlz5iquQEjN+rO5RWYfQlsaKCG+GXutw0rgTgwAmVHL8V3Y6YSis5+COlqqjoctO6OoDCiZUcfgP2nWoqORkqKkVcLUDhhEqO6/DLyxjIiDNWVIq4eoAwABkrOUE7XCm6lKTRTuaKShFPBKDwsJIzfjkPKzn5N3Nh5H9mrKg0+TVl37wmBhDei2a1p3+pQSUn53ECeR+Zjk8k8dXs89r8nJ4QwOhZNGmEJ5XnQItZ9a7pAB9TqRAnADA9PKksj1RYtm8aHiHHaR774Au69rK6YoDj4XmNbhszZxd+zf1Qj/xXE4oYu8W2QG/EVQrECgEmwMPdUsQBwstisHQpJgGBP6e2PXiufRoB2vaHZTR+QMQi7kiVECsCmA6eNF4fNP3TDp5jr8VS3Y/YA4jdJw7BdEmRrpBbJcQKAGaDt86HxN5Hoblk+iqhKoglA8wNb+iEL3dMGhyBEr7MqgJiiQALwiOLQbrN/jKlphIGsYq8r3TtxV02xJIAlgNPGvG/eCwMxc2AmtHKcR46HbE7kfNHvA2Ty4RYAsBy4Y06+hY/nxLP0aJuJ/Y48ZzrO71bcPfeg4EeVXPSuSyIBQFWCa96lwGxAMDphiddFGJOgOPhLS70OtMCb50/zwsxB8CZgyedC2JGgDMLTzozxAwAZx6edCaIKQHWBp50aogpANYOnnQqiAkAawtPOhHiWIDBwtpm/KgzPGkjxOVG9zz6PZ1qBk/aBDG9agpPuhjEmsOTzg9RFDqX2tyru0VFiJBYWVlZWVlZWVlZWVlZWVlZWVlZ1Vpzc/8BZAUI70E19cMAAAAASUVORK5CYII=">
                     {{$data->support_email}}
                    </a>

                </div>





                {{--<div class="row">--}}
                    {{--<div class="col-sm-4"><label>Your Location</label></div>--}}
                    {{--<div class="col-sm-8">--}}
                        {{--<input class="form-control" name="coaching_location">--}}
                    {{--</div>--}}
                {{--</div>--}}





            </form>
        </div>
        <div class="col-sm-2"></div>

    </div>

@endsection

@section('scripts')



@endsection