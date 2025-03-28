<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Audio Remix Generator</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    .file-list {
      margin-top: 10px;
    }
    .file-item {
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <div class="container text-center mt-5">
    <h2>Upload Audio Files for Remixing</h2>
    <div class="mb-3">
      <!-- Single file selection input -->
      <input type="file" id="fileInput" accept="audio/*">
      <button class="btn btn-secondary" onclick="addFile()">Add File</button>
    </div>
    <!-- Display list of added files -->
    <div id="fileList" class="file-list"></div>
    <button class="btn btn-primary mt-3" onclick="remixAudio()">Remix</button>
    <div id="status" class="mt-3"></div>
    <audio id="audioPlayer" controls class="mt-3" style="display: none;"></audio>
  </div>

  <script>
    let selectedFiles = [];

    function addFile() {
      const fileInput = document.getElementById("fileInput");
      const fileList = document.getElementById("fileList");
      const status = document.getElementById("status");

      if (fileInput.files.length === 0) {
        status.innerText = "Please select a file.";
        return;
      }

      if (selectedFiles.length >= 3) {
        status.innerText = "You can only add up to 3 files.";
        return;
      }

      const file = fileInput.files[0];
      selectedFiles.push(file);

      // Create a list item for the file
      const listItem = document.createElement("div");
      listItem.className = "file-item";
      listItem.innerHTML = `<i class="fas fa-file-audio"></i> ${file.name}`;
      fileList.appendChild(listItem);

      // Clear the input
      fileInput.value = "";
      status.innerText = "";
    }

    async function remixAudio() {
      const status = document.getElementById("status");
      const audioPlayer = document.getElementById("audioPlayer");

      if (selectedFiles.length < 2 || selectedFiles.length > 3) {
        status.innerText = "Please add 2 or 3 audio files.";
        return;
      }

      status.innerText = "Remixing audio...";

      const formData = new FormData();
      selectedFiles.forEach(file => formData.append("files", file));

      try {
        // Replace YOUR_NGROK_URL_HERE with your actual ngrok URL from Colab
        const response = await fetch("https://a673-104-196-255-88.ngrok-free.app/remix-music", {
          method: "POST",
          body: formData
        });
        
        if (!response.ok) {
          const errorData = await response.json();
          throw new Error(errorData.error || "Remixing failed.");
        }
        
        const blob = await response.blob();
        const url = URL.createObjectURL(blob);
        
        // Play the remixed audio
        audioPlayer.src = url;
        audioPlayer.style.display = "block";
        audioPlayer.play();
        
        // Show download icon button
        status.innerHTML = `
          <p>Remixed audio ready!</p>
          <a href="${url}" download="remixed_audio.mp3" class="btn btn-success">
            <i class="fas fa-download"></i> Download
          </a>
        `;
      } catch (error) {
        status.innerText = "Error: " + error.message;
      }
    }
  </script>
</body>
</html>
