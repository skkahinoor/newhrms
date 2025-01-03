<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            margin-right: 2px;
            width: fit-content;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #myBtn:hover {
            cursor: pointer;
        }

        h2 {
            margin: 0;
            padding: 10px;
            text-align: center;
            color: #333;
        }

        .modal-heading {
            display: flex;
            justify-content: center;
            /* Horizontal center */
            align-items: center;
            font-size: 28px;
        }

        .modal-heading,
        h2 {

            font-size: 28px;
        }

        .form-container {
            display: flex;
            align-items: center;
            margin-top: 0.5rem;
        }

        #late_reason {
            margin-top: 0.5rem;
        }

        label {
            margin-right: 10px;
        }

        #clockContainer {
            background: url({{ asset('assets/images/clock.jpg') }});
            background-size: cover;
        }
    </style>
</head>

<body>
    <li class="nav-item ">
        <a id="myBtn" class="nav-link">
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">Regularization</span>
        </a>
    </li>

    <div id="myModal" class="modal">

        <!-- Modal content -->

        <div class="col-xxl-3 col-xl-4 d-flex m-auto">
            <div class="card w-100">
                <div class="modal-heading">
                    <h2>Regularization</h2>
                    <span class="close">&times;</span>
                </div>
                <div class="card-body text-center clock-display">

                    <div id="clockContainer" class="mb-3">
                        <div id="hour"></div>
                        <div id="minute"></div>
                        <div id="second"></div>
                    </div>

                    <p id="date" class="text-primary fw-bolder mb-3"></p>


                    <div class="row text-center">
                        <div class="col-md-12">
                            <label class="h6"> Date </label>
                            <input type="date" class="form-control text-center" name="date" id="get_date"
                                onchange="checkAttendance(`{{ route('admin.ajaxRegularizationModal') }}`)">
                        </div>
                        <div class="form-container">
                            <br>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="checkin">Check In At</label>
                                    <input type="time" class="form-control" name="checkin" id="checkin_time">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="checkout">Check Out At</label>
                                    <input type="time" class="form-control" name="checkout" id="checkout_time">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <label class="h6"> Reason </label>
                            <textarea required name="reason" class="form-control text-center" id="late_reason" cols="10" rows="3" placeholder="Enter the reason"></textarea>
                        </div>
                    </div>
                    <div class="punch-btn mt-2 mb-2 d-flex align-items-center modal-footer justify-content-around">
                        <button class="btn btn-lg btn-danger {{ '' }}"
                            onclick="regularization(`{{ route('admin.createAjaxRegularization') }}`)"
                            id="addRegularization" data-audio="{{ asset('assets/audio/beep.mp3') }}">
                            Regularize
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        $('document').ready(function() {
            function drawClock() {
                console.log("check it");
                let now = new Date();
                let hr = now.getHours();
                let min = now.getMinutes();
                let sec = now.getSeconds();
                let hr_rotation = 30 * hr + min / 2; // 30 degrees per hour, 0.5 degrees per minute
                let min_rotation = 6 * min; // 6 degrees per minute
                let sec_rotation = 6 * sec; // 6 degrees per second

                // Debug log to confirm the function is being called
                /* console.log('Clock is updating'); */

                // Rotate clock hands
                document.getElementById('hour').style.transform = `rotate(${hr_rotation}deg)`;
                document.getElementById('minute').style.transform = `rotate(${min_rotation}deg)`;
                document.getElementById('second').style.transform = `rotate(${sec_rotation}deg)`;

                // Display weekday and date
                const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                const weekday = weekdays[now.getDay()];
                const date = now.toLocaleDateString();
                document.getElementById('date').innerText = `${weekday}, ${date}`;
            }

            // Run clock every second
            setInterval(drawClock, 1000);

        });


        function checkAttendance(url) {
            let choose_date = document.getElementById('get_date').value
            console.log(choose_date);
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    date: choose_date
                },
                success: function(data) {

                    if (data?.check_in != null && data?.check_out != null) {

                        let checkin_time = data.check_in;
                        let formattedCheckInTime = checkin_time.split(':').slice(0, 2).join(':');
                        let checkout_time = data.check_out;
                        let formattedCheckOutTime = checkout_time.split(':').slice(0, 2).join(':');

                        document.getElementById('checkin_time').value = formattedCheckInTime;
                        document.getElementById('checkout_time').value = formattedCheckOutTime;

                        document.getElementById('checkin_time').disabled = true;
                        document.getElementById('checkout_time').disabled = true;
                        document.getElementById('addRegularization').disabled = true;

                        Swal.fire({
                            icon: 'info',
                            title: data?.message ?? 'Something went wrong.',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true
                        });

                    } else if (data?.check_in != null && data?.check_out == null) {

                        let checkin_time = data.check_in;
                        let formattedTime = checkin_time.split(':').slice(0, 2).join(':');

                        console.log('formattedTime');

                        document.getElementById('checkin_time').value = formattedTime;
                        document.getElementById('checkout_time').value = null;

                        document.getElementById('checkin_time').disabled = false;
                        document.getElementById('checkout_time').disabled = false;
                        document.getElementById('addRegularization').disabled = false;


                        Swal.fire({
                            icon: 'warning',
                            title: data?.message ?? 'Something went wrong.',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                    } else {
                        $checkin_input = document.getElementById('checkin_time');
                        $checkout_input = document.getElementById('checkout_time');
                        $reason = document.getElementById('reason')

                        document.getElementById('checkin_time').value = null;
                        document.getElementById('checkout_time').value = null;

                        $checkin_input.disabled = false;
                        $checkout_input.disabled = false;
                        document.getElementById('addRegularization').disabled = false;


                        Swal.fire({
                            icon: 'warning',
                            title: data?.message ?? 'Something went wrong.',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true
                        });

                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function regularization(ur) {
            // addRegularization
            let choose_date = document.getElementById('get_date').value
            let check_in_time = document.getElementById('checkin_time').value
            let check_out_time = document.getElementById('checkout_time').value
            let reason = document.getElementById('late_reason').value
            if (reason) {
                console.log(reason);
                $.ajax({
                    type: 'POST',
                    url: ur,
                    data: {
                        date: choose_date,
                        checkin: check_in_time,
                        checkout: check_out_time,
                        reason: reason
                    },
                    success: function(data) {
                        console.log(data?.message);
                        var modal = document.getElementById("myModal");
                        Swal.fire({
                            icon: 'success',
                            title: data?.message ?? 'Something went wrong.',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                        modal.style.display = "none";
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: "Please Add Reason",
                    timer: 3000,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timerProgressBar: true
                });
            }


        }

        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>
