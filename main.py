from flask import Flask, request, jsonify

app = Flask(__name__)


@app.route("/get-user/john")
def get_user():
    user_data = {
        "name" : "john doe" , 
        "email" : "john.doe@gmail.com"
    }

    return jsonify(user_data)   



if __name__ == "__main__":
    app.run(debug=True, host='127.0.0.1', port=5000)