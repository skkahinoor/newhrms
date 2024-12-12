<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Face</title>
</head>

<body>
    <div>
        <video id="webcam" autoplay></video>
        <button onclick="registerFace()">Register Face</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.min.js"></script>

    <script>
        async function loadModels() {
            await faceapi.nets.faceRecognitionNet.loadFromUri('/models');
            await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
            await faceapi.nets.ssdMobilenetv1.loadFromUri('/models');
            startCamera();
        }

        async function startCamera() {
            const video = document.getElementById('webcam');
            const stream = await navigator.mediaDevices.getUserMedia({
                video: {}
            });
            video.srcObject = stream;
        }

        async function registerFace() {
            const video = document.getElementById('webcam');
            const detections = await faceapi.detectSingleFace(video).withFaceLandmarks().withFaceDescriptor();

            if (detections) {
                const descriptor = detections.descriptor;

                // Save to backend
                const response = await fetch('/save-face-descriptor', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        descriptor
                    }),
                });

                const result = await response.json();
                alert(result.message);
            } else {
                alert('No face detected. Try again.');
            }
        }

        loadModels();
    </script>

</body>

</html>
