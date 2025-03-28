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
    <header class="navbars d-flex align-items-center">
        <div class="logo">

            <h1 class="brand-name">Auralis</h1>

        </div>
        <div class="nav-right d-flex align-items-center">
            <i class="fa-solid fa-bars" style="font-size:21px;" data-bs-toggle="offcanvas" data-bs-target="#historyModal"></i>
            <!-- <button class="btn login">Login</button>
            <button class="btn register">Register</button> -->
        </div>
    </header>
    
  
    
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


