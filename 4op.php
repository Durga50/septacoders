<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Generator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
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
            const ngrokUrl = "https://08c0-35-230-18-215.ngrok-free.app"; // Replace with Colab ngrok URL
            
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
</body>
</html>
