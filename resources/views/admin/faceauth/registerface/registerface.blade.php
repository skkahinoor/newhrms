<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Matching</title>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
</head>
<body>
    <h1>Face Matching</h1>
    <input type="file" id="image1" accept="image/*">
    <input type="file" id="image2" accept="image/*">
    <button onclick="matchFaces()">Compare Faces</button>

    <script>
        async function matchFaces() {
            await loadModels();

            const img1 = document.getElementById('image1').files[0];
            const img2 = document.getElementById('image2').files[0];

            if (!img1 || !img2) {
                alert('Please upload both images.');
                return;
            }

            const isMatch = await compareFaces(img1, img2);
            alert(isMatch ? 'Faces Match!' : 'Faces Do Not Match.');
        }

        async function loadModels() {
            await faceapi.nets.ssdMobilenetv1.loadFromUri('/models');
            await faceapi.nets.faceRecognitionNet.loadFromUri('/models');
            await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
        }

        async function compareFaces(image1, image2) {
            const img1 = await faceapi.bufferToImage(image1);
            const img2 = await faceapi.bufferToImage(image2);

            const results1 = await faceapi.detectSingleFace(img1).withFaceLandmarks().withFaceDescriptor();
            const results2 = await faceapi.detectSingleFace(img2).withFaceLandmarks().withFaceDescriptor();

            if (!results1 || !results2) {
                console.log('No face detected in one or both images.');
                return false;
            }

            const distance = faceapi.euclideanDistance(results1.descriptor, results2.descriptor);
            console.log('Similarity Score:', distance);

            const threshold = 0.6;
            return distance < threshold;
        }
    </script>
</body>
</html>
