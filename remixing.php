<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Music Composer</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/logo.png"> 
</head>
<body>
<div class="container p-5">

    <header class="navbars d-flex align-items-center" id="header" style="background:red;">
        <div class="logo">
            <h1 class="brand-name">Auralis</h1>
        </div>
        <div class="nav-right d-flex align-items-center">
            <i class="fa-solid fa-bars" style="font-size:21px;" data-bs-toggle="offcanvas" data-bs-target="#historyModal"></i>
        </div>
    </header>
    
       
    </div>
   <!-- Side Modal -->
   <div class="offcanvas offcanvas-end custom-offcanvas" tabindex="-1" id="historyModal" aria-labelledby="historyModalLabel" >
        <div class="offcanvas-header" style="z-index:1000;">
            <h5 id="historyModalLabel" class="sidebar-title">History</h5>
            <button type="button" class="btn-close custom-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="z-index:1000;">
            <div class="history-list">
                <p>Your recent activity will appear here.</p>
                <div class="history-list">
                    <div class="history-item active">
                        <!-- <i class="fa-solid fa-music"></i> -->
                        Composed a new track
                    </div>
                    <div class="history-item">
                        <!-- <i class="fa-solid fa-edit"></i> -->
                        Edited melody notes
                    </div>
                    <div class="history-item">
                        <!-- <i class="fa-solid fa-save"></i> -->
                        Saved AI-generated music
                    </div>
                    <div class="history-item">
                        <!-- <i class="fa-solid fa-headphones"></i> -->
                        Played last session
                    </div>
                </div>

            </div>
        </div>
    </div>


<div class="area" style="position :fixed;">
    <ul class="circles">
        <li><i class="fa-solid fa-music" style="font-size: 46px; color: rgba(255, 8, 0, 1);"></i></li>
        <li><i class="fa-solid fa-guitar" style="font-size: 40px; color: rgba(255, 141, 0, 0.9);"></i></li>
        <li><i class="fa-solid fa-headphones" style="font-size: 36px; color: rgba(255, 8, 0, 1);"></i></li>
        <li><i class="fa-solid fa-play" style="font-size: 50px; color: rgba(255, 141, 0, 0.9);"></i></li>
        <li><i class="fa-solid fa-music" style="font-size: 26px; color: rgba(255, 8, 0, 1);"></i></li>
        <li><i class="fa-solid fa-drum" style="font-size: 46px; color: rgba(255, 141, 0, 1);"></i></li>
        <li><i class="fa-solid fa-microphone" style="font-size: 36px; color: rgba(255, 8, 0, 1);"></i></li>
        <li><i class="fa-solid fa-volume-up" style="font-size: 46px; color: rgba(255, 141, 0, 1);"></i></li>
        <li><i class="fa-solid fa-compact-disc" style="font-size: 36px; color: rgba(255, 8, 0, 1);"></i></li>
        <li><i class="fa-solid fa-headphones-alt" style="font-size: 46px; color: rgba(255, 141, 0, 1);"></i></li>
    </ul>
</div>
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
        // Replace with the correct ngrok URL printed from Colab
        const response = await fetch("https://8798-35-185-114-174.ngrok-free.app/remix-music", {
            method: "POST",
            body: formData,
            mode: "cors"  // Ensure CORS handling
        });

        if (!response.ok) {
            throw new Error("Remixing failed.");
        }

        const blob = await response.blob();
        const url = URL.createObjectURL(blob);

        // Play the remixed audio
        audioPlayer.src = url;
        audioPlayer.style.display = "block";
        audioPlayer.play();

        // Show download button
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
    <?php include("footer.php"); ?>
</body>



