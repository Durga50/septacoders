<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humming to Instrumental AI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
    <h2 class="text-center mb-4">🎵 Humming to Instrumental Music AI 🎶</h2>
    
    <div class="container">
        <form id="uploadForm">
            <label>Upload Your Humming Audio:</label>
            <input type="file" id="audioInput" class="form-control" accept="audio/*">
            <br>
            <button type="button" class="btn btn-primary" onclick="uploadAudio()">Generate Music</button>
        </form>

        <div id="output" class="mt-4"></div>
    </div>

    <script>
        async function uploadAudio() {
            let fileInput = document.getElementById("audioInput");
            if (fileInput.files.length === 0) {
                alert("Please upload an audio file.");
                return;
            }

            let formData = new FormData();
            formData.append("file", fileInput.files[0]);

            let response = await fetch("https://98f5-34-138-83-118.ngrok-free.app/generate-music", {
                method: "POST",
                body: formData
            });

            if (response.ok) {
                let blob = await response.blob();
                let url = URL.createObjectURL(blob);

                let outputDiv = document.getElementById("output");
                outputDiv.innerHTML = `
                    <h5>Generated Music 🎶</h5>
                    <audio controls>
                        <source src="${url}" type="audio/wav">
                        Your browser does not support the audio element.
                    </audio>
                    <br>
                    <a href="${url}" download="generated_music.wav">
                        <button class="btn btn-success mt-2">⬇️ Download</button>
                    </a>
                `;
            } else {
                alert("Error generating music.");
            }
        }
    </script>
</body>
</html>
