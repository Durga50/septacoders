<?php include("header.php"); ?>

<main class="content">
    <div class="container">
        <div class="row" style="z-index:1000;">
            <!-- Card 1: Hum to Music -->
            <div class="col-md-4">
                <div class="custom-card" data-url="humming.php">
                    <i class="fa-solid fa-file-audio card-icon"></i>
                    <h5>Humming to music</h5>
                    <p class="font">Turn your hums into beautifully composed melodies with AI-powered music generation.</p>
                </div>
            </div>

            <!-- Card 2: Remixing Audio -->
            <div class="col-md-4">
                <div class="custom-card" data-url="remixing.php">
                    <i class="fa-solid fa-music card-icon"></i>
                    <h5>Remixing Audio</h5>
                    <p class="font">Mix and remix your favorite tracks effortlessly with advanced AI audio tools.</p>
                </div>
            </div>

            <!-- Card 3: Music Notes -->
            <div class="col-md-4">
                <div class="custom-card" data-url="music_notes.php">
                    <i class="fa-solid fa-microphone-music card-icon"></i>
                    <h5>Music Notes</h5>
                    <p class="font">Effortlessly transform your humming into a full-fledged melody with AI-powered music generation.</p>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".custom-card");

    cards.forEach(card => {
        card.addEventListener("click", function () {
            const targetUrl = card.getAttribute("data-url"); // Get the page URL from data attribute
            if (targetUrl) {
                window.location.href = targetUrl; // Navigate to the respective page
            }
        });
    });
});

</script>

<?php include("footer.php"); ?>