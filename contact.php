<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>
        <input type="text" id="name" placeholder="Your Name">
        <input type="email" id="email" placeholder="Your Email">
        <textarea id="message" placeholder="Your Message"></textarea>
        <button onclick="saveContact()">Submit</button>
        <p id="status"></p>
    </div>

    <script>
        function saveContact() {
            let name = document.getElementById("name").value;
            let email = document.getElementById("email").value;
            let message = document.getElementById("message").value;
            
            if (name && email && message) {
                let contactData = { name, email, message };
                localStorage.setItem("contact_" + Date.now(), JSON.stringify(contactData));
                document.getElementById("status").innerText = "Message saved successfully!";
            } else {
                document.getElementById("status").innerText = "Please fill in all fields";
            }
        }
    </script>
</body>
</html>