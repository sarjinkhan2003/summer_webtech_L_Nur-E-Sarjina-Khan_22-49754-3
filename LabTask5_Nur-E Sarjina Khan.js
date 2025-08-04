
function validateForm() {
  var name = document.getElementById("n").value;
  var age = document.getElementById("a").value;
  var course = document.getElementById("cs").value;

  if (name == "") {
    alert("Name is required.");
    return false;
  }


  if (age <= 0 || age == "") {
    alert("Please enter a valid age.");
    return false;
  }


  if (course == "") {
    alert("Please select a course.");
    return false;
  }
  



  return true;
}
  function showImage() {
  document.getElementById("image").style.visibility = "visible";
}


function hideImage() {
  document.getElementById("image").style.visibility = "hidden";
}
