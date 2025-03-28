<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Counter AI</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        textarea { width: 80%; height: 100px; }
        button { padding: 10px 20px; margin-top: 10px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Word Counter AI</h2>
    <textarea id="text_input" placeholder="Enter your text here..."></textarea><br>
    <button onclick="countWords()">Count Words</button>
    <h3>Word Count: <span id="result">0</span></h3>

    <script>
        function countWords() {
            var text = $("#text_input").val();
            $.ajax({
                url: "http://localhost:5000/count_words",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({ "text": text }),
                success: function(response) {
                    $("#result").text(response.word_count);
                },
                error: function() {
                    alert("Error connecting to AI API");
                }
            });
        }
    </script>

</body>
</html>
