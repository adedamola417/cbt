<?php
require_once('session/index.php');
if(!isset($_SESSION['user'])){
header('Location: index.php');
exit();
}
$welcom_message = "Welcome to the CBT Dashboard, " . $_SESSION['user']['first_name'] . "!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT Exam</title>
</head>

<body>
/* style to your taste, I'm a PHP developer. */
<h1><?php print $welcom_message; ?></h1>
    <h1>CBT Exam</h1>
    <div id="question-container"></div>
    <button id="previous-question" style="display: none;">Previous Question</button>
    <button id="next-question" style="display: none;">Next Question</button>
    <button id="submit-exam" style="display: none;">Submit Exam</button>
    <video id="webcam-video" hidden muted></video>
    <video id="recorded-video" controls hidden></video>

    <style>
        #question-container{
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        #question-container p{
            font-size: 18px;
            margin: 10px 0;
        }
        #next-question, #previous-question, #submit-exam {
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

    <script>
        let currentQuestionId = 1;
        let answers = {};
        let mediaRecorder;
        let recordedChunks = [];
        let videoBlob;

        // Fetch and display one question at a time
        function fetchQuestion() {
            fetch(`con.php?question_id=${currentQuestionId}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('question-container');
                    container.innerHTML = `
                        <p>${currentQuestionId}</p><p>${data.question}</p>
                        <label><input type="radio" name="answer" value="A"> ${data.option_a}</label><br>
                        <label><input type="radio" name="answer" value="B"> ${data.option_b}</label><br>
                        <label><input type="radio" name="answer" value="C"> ${data.option_c}</label><br>
                        <label><input type="radio" name="answer" value="D"> ${data.option_d}</label><br>
                    `;
                    document.getElementById('next-question').style.display = 'block';
                    document.getElementById('previous-question').style.display = currentQuestionId > 1 ? 'block' : 'none';
                    alert(`Question ${currentQuestionId} of 10`);
                    if (currentQuestionId === 10) {
                        document.getElementById('next-question').style.display = 'none';
                        document.getElementById('submit-exam').style.display = 'block';
                    }
                    else{
                        document.getElementById('submit-exam').style.display = 'none';
                    }
                });
        }

        // Start webcam recording and display live feed
        async function startRecording() {
            alert ('Starting webcam recording...');
             try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        mediaRecorder = new MediaRecorder(stream);
        mediaRecorder.ondataavailable = event => recordedChunks.push(event.data);
        mediaRecorder.start();

        const webcamVideo = document.getElementById('webcam-video');
        webcamVideo.srcObject = stream;
        webcamVideo.play();
    } catch (err) {
        console.error('Error accessing webcam:', err);
        alert('Could not access webcam. Please check permissions and connection.');
    }
        }

        // Stop recording and save video
        function stopRecording() {
            mediaRecorder.onstop = () => {
                videoBlob = new Blob(recordedChunks, { type: 'video/webm; codecs=vp9' });
                const video = document.getElementById('recorded-video');
                video.src = URL.createObjectURL(videoBlob);
                console.log(`Video Blob Size: ${videoBlob.size}`);
                recordedChunks = [];

                // Upload the video blob
                const userId = 1; // Replace with actual user ID
                const formData = new FormData();
                formData.append('user_id', userId);
                formData.append('answers', JSON.stringify(answers));
                formData.append('video', videoBlob, `${Date.now()}.webm`);

                fetch('con.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log('Server Response:', data);
                    alert(data);
                })
                .catch(error => {
                    console.error('Error uploading video:', error);
                    alert('Failed to upload video.');
                });
            };
            mediaRecorder.stop();
        }

        // Save answer and move to the next question
        document.getElementById('next-question').addEventListener('click', () => {
            const selectedAnswer = document.querySelector('input[name="answer"]:checked');
            if (selectedAnswer) {
                answers[currentQuestionId] = selectedAnswer.value;
                alert(`Answer for Question ${currentQuestionId} saved: ${selectedAnswer.value}`);
                currentQuestionId++;
                fetchQuestion();
            } else {
                alert('Please select an answer!');
            }
        });

        // Move to the previous question
        document.getElementById('previous-question').addEventListener('click', () => {
            if (currentQuestionId > 1) {
                currentQuestionId--;
                fetchQuestion();
            }
        });

        // Submit exam
        document.getElementById('submit-exam').addEventListener('click', () => {
            stopRecording();
           
        });

        // Initialize exam
        fetchQuestion();
        startRecording();
    </script>
</body>
</html>