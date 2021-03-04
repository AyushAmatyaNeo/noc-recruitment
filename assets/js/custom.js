function ageValid() 
{
    var x, text;
  
    // Get the value of the input field with id="numb"
    x = document.getElementById("age1").value;
  
    // If x is Not a Number or less than one or greater than 10
    if (isNaN(x) || x < 18 || x > 60) {
      text = "Age must be between 18 to 60";
    } else {
      text = "";
    }
    document.getElementById("demo").innerHTML = text;
}