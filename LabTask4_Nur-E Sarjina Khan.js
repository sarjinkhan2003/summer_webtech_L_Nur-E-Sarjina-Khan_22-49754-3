// Counter logic
var count = 0;
function incrementCounter() {
  count= document.getElementById("counterBox").value;
  count++;
  document.getElementById("counterBox").value = count;
}
function decrementCounter() {
	count= document.getElementById("counterBox").value;
  count--;
  document.getElementById("counterBox").value = count;
}

// BMI calculator logic
function calculateBMI() {
  var height = parseFloat(document.getElementById("height").value);
  var weight = parseFloat(document.getElementById("weight").value);
  var bmiResult = document.getElementById("bmiResult");
  if (height > 0 && weight > 0) {
    var bmi = weight / ((height / 100) * (height / 100));
    bmiResult.innerText = bmi;
  } else {
    bmiResult.innerText = "Please enter valid height and weight!";
  }
}

// Color change logic
function changeTextColor() {
  var color = document.getElementById("colorInput").value;
  document.getElementById("colorBox").style.backgroundColor = color;
}

function isUsernameValid(username) {
  if (username.length < 1 || username.length > 8) return false;
 
  return true;
}

function isPasswordValid(password) {
  if (password.length < 6)
	  return false;
  
  return true;
}

function calcScore(password) {
  var score = 0;
  var specialChars = "!@#$%&*";
  var hasAlpha = false, hasNumber = false, hasSpecial = false;
  if (password.length >= 6) score++;
  for (var i = 0; i < password.length; i++) {
    var ch = password.charAt(i);
    if ((ch >= 'a' && ch <= 'z') || (ch >= 'A' && ch <= 'Z')) hasAlpha = true;
    if (ch >= '0' && ch <= '9') hasNumber = true;
    if (specialChars.indexOf(ch) !== -1) hasSpecial = true;
  }
  if (hasAlpha) score++;
  if (hasNumber) score++;
  if (hasSpecial) score++;
  return score;
}

// Form validation logic
function formAuth() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var cpassword = document.getElementById("Cpassword").value;
  var resultDiv = document.getElementById("authResult");

  if (!isUsernameValid(username)) {
    resultDiv.innerText = "Invalid username! max 8 characters.";
    return;
  }

  if (password !== cpassword) {
    resultDiv.innerText = "Passwords do not match!";
    return;
  }

  var passValid = isPasswordValid(password);
  var score = calcScore(password);
  var strength = "";

  if (score <= 1) 
	  strength = "Very Weak";
  else if (score === 2) 
	  strength = "Weak";
  else if (score === 3) 
	  strength = "Moderate";
  else if (score === 4) 
	  strength = "Strong";

  if (!passValid) {
    resultDiv.innerText = "Invalid password!";
  } else {
    resultDiv.innerText = "Login Success! Password Strength: " + strength;
  }
}

window.onload = function() {
  document.getElementById("plusBtn").onclick = incrementCounter;
  document.getElementById("minusBtn").onclick = decrementCounter;
  document.getElementById("bmiBtn").onclick = calculateBMI;
  document.getElementById("colorBtn").onclick = changeTextColor;
  document.getElementById("btn1").onclick = formAuth;
};