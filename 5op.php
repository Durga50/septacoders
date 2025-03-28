<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinematic BGM Generator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
    <h2 class="text-center mb-4">🎥 AI Cinematic BGM Generator 🎵</h2>
    
    <div class="container">
        <form id="bgmForm">
            <label>Select Instruments:</label><br>
            <div id="instrumentContainer">
                <input type="checkbox" name="instrument" value="piano"> Piano
                <input type="checkbox" name="instrument" value="violin"> Violin
                <input type="checkbox" name="instrument" value="flute"> Flute
                <input type="checkbox" name="instrument" value="guitar"> Guitar
                <input type="checkbox" name="instrument" value="drums"> Drums
            </div>
            <br>

            <label>Select Mood:</label>
            <select id="mood" class="form-select">
                <option value="happy">Happy</option>
                <option value="sad">Sad</option>
                <option value="angry">Angry</option>
                <option value="dizzy">Dizzy</option>
            </select>
            <br>

            <label>Select Beat:</label>
            <select id="beat" class="form-select">
                <option value="high">High</option>
                <option value="low">Low</option>
            </select>
            <br>

            <label>Select Style:</label>
            <select id="style" class="form-select">
                <option value="folk">Folk</option>
                <option value="classic">Classic</option>
                <option value="western">Western</option>
            </select>
            <br>

            <label>Duration (seconds):</label>
            <input type="number" id="duration" class="form-control" value="10" min="5" max="60">
            <br>

            <button type="button" class="btn btn-primary" onclick="generateBGM()">Generate BGM</button>
        </form>

        <div id="output" class="mt-4"></div>
    </div>

    <script>
        async function generateBGM() {
            let instruments = [];
            document.querySelectorAll("input[name='instrument']:checked").forEach(el => instruments.push(el.value));

            let mood = document.getElementById("mood").value;
            let beat = document.getElementById("beat").value;
            let style = document.getElementById("style").value;
            let duration = document.getElementById("duration").value;

            if (instruments.length === 0) {
                alert("Please select at least one instrument.");
                return;
            }

            let requestData = {
                instruments: instruments,
                mood: mood,
                beat: beat,
                style: style,
                duration: duration
            };

            let response = await fetch(" https://4310-34-125-7-135.ngrok-free.app/generate-bgm", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(requestData)
            });

            if (response.ok) {
                let blob = await response.blob();
                let url = URL.createObjectURL(blob);
                
                let outputDiv = document.getElementById("output");
                outputDiv.innerHTML = `
                    <h5>Generated Cinematic BGM 🎶</h5>
                    <audio controls>
                        <source src="${url}" type="audio/wav">
                        Your browser does not support the audio element.
                    </audio>
                    <br>
                    <a href="${url}" download="cinematic_bgm.wav">
                        <button class="btn btn-success mt-2">⬇️ Download</button>
                    </a>
                `;
            } else {
                alert("Error generating BGM.");
            }
        }
    </script>
</body>
</html>
