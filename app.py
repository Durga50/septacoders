from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # Allow requests from PHP UI

@app.route('/count_words', methods=['POST'])
def count_words():
    data = request.json  # Get JSON data from request
    text = data.get("text", "")
    word_count = len(text.split())  # Count words
    
    return jsonify({"word_count": word_count})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
