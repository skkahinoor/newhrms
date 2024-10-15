<script>
    $('document').ready(function() {

        $('.errorStartWorking').hide();

        $('.errorStopWorking').hide();

        $('.successStartWorking').hide();

        $('.successStopWorking').hide();

        function showLoader() {
            $('#loader').show();
        }

        function hideLoader() {
            $("#loader").hide();
        }




        function drawClock() {
            let now = new Date();
            let hr = now.getHours();
            let min = now.getMinutes();
            let sec = now.getSeconds();
            let hr_rotation = 30 * hr + min / 2; // 30 degrees per hour, 0.5 degrees per minute
            let min_rotation = 6 * min; // 6 degrees per minute
            let sec_rotation = 6 * sec; // 6 degrees per second

            // Debug log to confirm the function is being called
            // console.log('Clock is updating');

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

       


        let tasksChart = new Chart(document.getElementById("tasksChart"), {
            type: 'pie',
            data: {
                labels: ["Pending", "On Hold", "In progress", "Completed", "Cancelled"],
                datasets: [{
                    label: 'Task state',
                    type: 'doughnut',
                    backgroundColor: ["#7ee5e5", "#f77eb9", "#4d8af0", "#00ff00", "#FF0000"],
                    borderColor: [
                        'rgba(256, 256, 256, 1)',
                        'rgba(256, 256, 256, 1)',
                        'rgba(256, 256, 256, 1)',
                        'rgba(256, 256, 256, 1)',
                        'rgba(256, 256, 256, 1)'
                    ],

                    data: [
                        {{ $taskPieChartData['not_started'] }},
                        {{ $taskPieChartData['on_hold'] }},
                        {{ $taskPieChartData['in_progress'] }},
                        {{ $taskPieChartData['completed'] }},
                        {{ $taskPieChartData['cancelled'] }}
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false,
                        text: 'Task Pie Chart'
                    }
                }
            }
        });

        let ctx = document.getElementById('projectChart')?.getContext('2d');
        let labels = ["Pending", "On Hold", "In progress", "Completed", "Cancelled"];
        let barColors = ["#7ee5e5", "#f77eb9", "#4d8af0", "green", 'red'];
        let barData = [
            {{ $projectCardDetail['not_started'] }},
            {{ $projectCardDetail['on_hold'] }},
            {{ $projectCardDetail['in_progress'] }},
            {{ $projectCardDetail['completed'] }},
            {{ $projectCardDetail['cancelled'] }}
        ];
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Project',
                    backgroundColor: barColors,
                    data: barData,
                    borderWidth: 1,
                    borderRadius: 10,
                    borderSkipped: true,
                }],

            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                },
                plugins: {
                    legend: {
                        position: 'none',
                    },
                    title: {
                        display: false,
                        text: 'Project Bar Chart'
                    }
                },
                barThickness: 50,

            }
        });

        $("#startWorkingBtn").click(function(e) {
            e.preventDefault();
            showLoader();
            let url = $(this).attr('href');
            let audioUrl = $(this).data('audio');

            getLocation().then(function(position) {
                let params = {
                    lat: position.latitude,
                    long: position.longitude
                };
                let queryString = $.param(params);
                let urlWithParams = url + "?" + queryString
                $.ajax({
                    type: "get",
                    url: urlWithParams,
                    success: function(response) {
                        $('#startWorkingBtn').addClass('d-none');
                        $('#checkInTime').text(response.data.check_in_at);
                        $('#flashAttendanceMessage').removeClass('d-none');
                        $('.successStartWorking').show();
                        $('.successStartWorkingMessage').text(response.message);
                        $('div.alert.alert-success').not('.alert-important').delay(
                            500).slideUp(900);
                        let audio = new Audio(audioUrl);
                        audio.play();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status === 400) {
                            let errorObj = JSON.parse(jqXHR.responseText);
                            let errorMessage = "Error: " + errorObj.message;
                            $('#flashAttendanceMessage').removeClass('d-none');
                            $('.errorStartWorking').show();
                            $('.errorStartWorkingMessage').text(errorMessage);
                            $('div.alert.alert-danger').not('.alert-important')
                                .delay(5000).slideUp(900);
                        } else {
                            let errorMessage = "Error: " + errorThrown;
                            $('#flashAttendanceMessage').removeClass('d-none');
                            $('.errorStartWorking').show();
                            $('.errorStartWorkingMessage').text(errorMessage);
                            $('div.alert.alert-danger').not('.alert-important')
                                .delay(5000).slideUp(900);
                        }
                    },
                    complete: function() {
                        hideLoader();
                    }
                });
            }).catch(function(error) {
                hideLoader();
                $('#flashAttendanceMessage').removeClass('d-none');
                $('.errorStartWorking').show();
                $('.errorStartWorkingMessage').text(
                    "Error occurred while retrieving location: " + error.message);
                $('div.alert.alert-danger').not('.alert-important').delay(5000).slideUp(900);
            });
        });

        $("#stopWorkingBtn").click(function(e) {
            e.preventDefault();
            showLoader();
            let url = $(this).attr('href');
            let audioUrl = $(this).data('audio');
            getLocation().then(function(position) {
                let params = {
                    lat: position.latitude,
                    long: position.longitude
                };
                let queryString = $.param(params);
                let urlWithParams = url + "?" + queryString

                $.ajax({
                    type: "get",
                    url: urlWithParams,
                    success: function(response) {
                        let audio = new Audio(audioUrl);
                        audio.play();
                        $('#stopWorkingBtn').addClass('d-none');
                        $('#checkOutTime').text(response.data.check_out_at);
                        $('#flashAttendanceMessage').removeClass('d-none');
                        $('.successStopWorking').show();
                        $('.successStopWorkingMessage').text(response.message);
                        $('div.alert.alert-success').not('.alert-important').delay(
                            500).slideUp(900);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status === 400) {
                            let errorObj = JSON.parse(jqXHR.responseText);
                            let errorMessage = "Error: " + errorObj.message;
                            $('#flashAttendanceMessage').removeClass('d-none');
                            $('.errorStopWorking').show();
                            $('.errorStopWorkingMessage').text(errorMessage);
                            $('div.alert.alert-danger').not('.alert-important')
                                .delay(5000).slideUp(900);
                        } else {
                            let errorMessage = "Error: " + errorThrown;
                            $('#flashAttendanceMessage').removeClass('d-none');
                            $('.errorStopWorking').show();
                            $('.errorStopWorkingMessage').text(errorMessage);
                            $('div.alert.alert-danger').not('.alert-important')
                                .delay(5000).slideUp(900);
                        }
                    },
                    complete: function() {
                        hideLoader();
                    }
                });
            }).catch(function(error) {
                hideLoader();
                $('#flashAttendanceMessage').removeClass('d-none');
                $('.errorStartWorking').show();
                $('.errorStartWorkingMessage').text(
                    "Error occurred while retrieving location: " + error.message);
                $('div.alert.alert-danger').not('.alert-important').delay(5000).slideUp(900);
            });
        });

        function getLocation() {
            if (navigator.geolocation) {
                return new Promise(function(resolve, reject) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        let latitude = position.coords.latitude;
                        let longitude = position.coords.longitude;

                        resolve({
                            latitude: latitude,
                            longitude: longitude
                        });
                    }, function(error) {
                        reject(error);
                    });
                });
            } else {
                hideLoader();
                $('#flashAttendanceMessage').removeClass('d-none');
                $('.errorStartWorking').show();
                $('.errorStartWorkingMessage').text('Geolocation is not supported by this browser.');
                $('div.alert.alert-danger').not('.alert-important').delay(5000).slideUp(900);
            }
        }
    });






    // Dashboard followup today
    // Function to display a SweetAlert notification if there are follow-ups for today
    function showTodayFollowUps(todayFollowUps) {
        let message = '<strong>Ohh! Today, You Have Follow-Ups with Clients!</strong><br><br>';

        todayFollowUps.forEach(followUp => {
            const leadName = followUp.leadEnqueryforDashboard ? followUp.leadEnqueryforDashboard.name :
                'Unknown';
            message += `
            
            <strong>Follow-Up Date:</strong> ${followUp.followupdate}<br>
            <strong>Follow-Up Time:</strong> ${followUp.followuptime}<br><br>
            
        `;
        });

        Swal.fire({
            title: 'Follow-Ups for Today',
            html: message,
            icon: 'info',
            confirmButtonText: 'Got It',
            padding: '10px 50px 20px 50px',
            allowOutsideClick: false,
        });
    }

    // Function to check if any follow-up is scheduled for today
    function checkForTodayFollowUps(followUps) {
        const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
        const todayFollowUps = followUps.filter(followUp => followUp.followupdate === today);

        const alertShownToday = localStorage.getItem('alertShownDate');

        // If there are follow-ups for today and the alert has not been shown yet
        if (todayFollowUps.length > 0 && alertShownToday !== today) {
            showTodayFollowUps(todayFollowUps);
            localStorage.setItem('alertShownDate', today); // Store the alertShownDate to avoid duplicate alerts
        }
    }

    // Fetch follow-up data from the API endpoint
    function fetchFollowUps() {
        fetch('dashboard/followups') // Replace this with your actual API route
            .then(response => response.json())
            .then(data => {
                const followUps = data.data; // Access follow-up data from JSON response
                checkForTodayFollowUps(followUps); // Pass the data to the checking function
            })
            .catch(error => console.error('Error fetching follow-ups:', error));
    }

    // Execute the follow-up check after the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        fetchFollowUps(); // Fetch follow-up data from the backend
    });







    // This is For Follow Up Remind me tomorrow 
    // Check if there's a "remindMeTomorrow" entry in localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const followupSection = document.getElementById('followup-hide');
        const remindTime = localStorage.getItem('remindMeTomorrow');

        if (remindTime) {
            const remindDate = new Date(remindTime);
            const currentDate = new Date();

            // If today is after the stored date, show the section
            if (currentDate > remindDate) {
                localStorage.removeItem('remindMeTomorrow'); // Remove the old reminder

            } else {
                // Keep the section hidden
                followupSection.style.display = 'none';
            }
        }
    });

    // Set the reminder when the button is clicked
    document.querySelector('.remind-me-tomorrow').addEventListener('click', function() {
        const followupSection = document.getElementById('followup-hide');
        followupSection.style.display = 'none'; // Hide the section

        // Calculate the date for tomorrow
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);

        // Store the reminder in localStorage
        localStorage.setItem('remindMeTomorrow', tomorrow);

        Swal.fire({
            title: 'Got It! It will be now hide untill tomorrow!',
            icon: 'success',
            confirmButtonText: 'Done',
            padding: '10px 50px 20px 50px',
            allowOutsideClick: false
        });
    });
</script>
