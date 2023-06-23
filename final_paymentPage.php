<!DOCTYPE html>
<html>
<head>
  <title>Final paymennt and checkout</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #4e54c8, #8f94fb);
      font-family: Arial, sans-serif;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .box {
      background-color: white;
      padding: 40px;
      text-align: center;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .box h1 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #4f1e9c;
    }

    .box p {
      margin-bottom: 10px;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4caf50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #45a049;
    }

    .error-message {
      color: red;
    }
  </style>
  <script>
    function validateForm() {
      var checkbox = document.getElementById("selector");
      var errorMessage = document.getElementById("error-message");
      
      if (!checkbox.checked) {
        errorMessage.style.display = "block";
        return false;
      }
      errorMessage.style.display = "none";
      return true;
    }
  </script>
</head>
<body>
  <div class="container">
    <div class="box">
      <h1>Almost there!</h1>
      <h1>One step ahead to book your table</h1>
      <p>Payment method</p>
      <p>
        <input type="checkbox" id="selector">
        <label for="selector"></label>
        Cash
      </p>
      <p id="error-message" class="error-message" style="display: none;">We only accept cash. Please check the box.</p>
      <a class="button" href="source1.html?source=final_button" onclick="return validateForm();">Continue</a>
      
    </div>
  </div>
</body>
</html>

<!-- 
  if you want a alert when it redirected to source1.html
  add this in source1.html
  <script>
    window.onload = function() {
      var urlParams = new URLSearchParams(window.location.search);
      var source = urlParams.get('source');
      
      if (source === 'final_button') {
        alert("Table booked Succeessfully!");
      }
    };
  </script>

  AND,

  <a class="button" href="source1.html" onclick="return validateForm();">Continue</a> 
  in this button tag add "source=final_button" in the ennd of href="source1.html" like-
  <a class="button" source1.html?source=gradient">Continue</a>


-->
