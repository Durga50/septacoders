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
        <h2>Generate Music from Notes</h2>
        <input type="text" id="notes" class="form-control" placeholder="Enter Notes (e.g. C D E F G)">
        <button class="btn btn-primary mt-3" onclick="generateMusic()">Generate</button>
        
        <div id="status" class="mt-3"></div>
        <audio id="audioPlayer" class="mt-3" controls style="display: none;"></audio>
    </div>

    <script>
        async function generateMusic() {
            const notes = document.getElementById("notes").value;
            const ngrokUrl = "https://f54d-34-125-21-115.ngrok-free.app"; // Replace with Colab ngrok URL
            
            if (!notes) {
                alert("Please enter musical notes.");
                return;
            }

            document.getElementById("status").innerHTML = "<p>Generating music...</p>";

            try {
                const response = await fetch(`${ngrokUrl}/generate-music`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ notes: notes })
                });

                if (!response.ok) throw new Error("Server error!");

                const blob = await response.blob();
                const url = URL.createObjectURL(blob);

                // Play the generated music
                const audioPlayer = document.getElementById("audioPlayer");
                audioPlayer.src = url;
                audioPlayer.style.display = "block";
                audioPlayer.play();

                // Show download icon
                document.getElementById("status").innerHTML = `
                    <p>Music Generated!</p>
                    <a href="${url}" download="generated_music.mp3" class="btn btn-success">
                        <i class="fas fa-download"></i> Download
                    </a>
                `;
            } catch (error) {
                document.getElementById("status").innerHTML = "<p>Error generating music.</p>";
                console.error(error);
            }
        }
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



