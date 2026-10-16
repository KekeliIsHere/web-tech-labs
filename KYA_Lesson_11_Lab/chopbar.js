// Step 1: Universal AJAX Request Helper
function asyncRequest() {
  try {
    return new XMLHttpRequest(); // Non-IE browsers
  } catch (e1) {
    try {
      return new ActiveXObject("Msxml2.XMLHTTP"); // IE 6+
    } catch (e2) {
      try {
        return new ActiveXObject("Microsoft.XMLHTTP"); // IE 5
      } catch (e3) {
        return false; // No AJAX support
      }
    }
  }
}

// Step 2 & 3: GET request for XML with cache-busting
function loadMenuXML() {
  var xhr = asyncRequest();
  if (!xhr) {
    console.error("Browser does not support AJAX");
    return;
  }

  // Prevent caching by appending a timestamp / random query parameter
  var cacheBuster = "menu.xml?nocache=" + Math.random() * 1000000;

  xhr.open("GET", cacheBuster, true);

  xhr.onreadystatechange = function () {
    // Log readyState changes to console
    console.log("menu.xml readyState:", xhr.readyState);

    if (xhr.readyState === 4 && xhr.status === 200) {
      var xmlDoc = xhr.responseXML;
      var dishes = xmlDoc.getElementsByTagName("dish");
      var menuList = document.getElementById("menu");
      menuList.innerHTML = ""; // Clear existing entries

      for (var i = 0; i < dishes.length; i++) {
        var name = dishes[i].getElementsByTagName("name")[0].textContent;
        var price = dishes[i].getElementsByTagName("price")[0].textContent;

        var li = document.createElement("li");
        li.textContent = name + " - GHS " + price;
        menuList.appendChild(li);
      }
    }
  };

  xhr.send(null);
  // Log immediately after sending to show asynchronous behavior
  console.log("Request sent");
}

// Step 4: GET request for JSON
function loadSpecialsJSON() {
  var xhr = asyncRequest();
  if (!xhr) return;

  xhr.open("GET", "specials.json?nocache=" + Math.random() * 1000000, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var specials = JSON.parse(xhr.responseText);
      var specialsList = document.getElementById("specials");
      specialsList.innerHTML = "";

      specials.forEach(function (item) {
        var li = document.createElement("li");
        li.textContent = item.name + " - GHS " + item.price;
        specialsList.appendChild(li);
      });
    }
  };

  xhr.send(null);
}

// Step 5: POST order request
function sendOrder() {
  var xhr = asyncRequest();
  if (!xhr) return;

  var endpoint = "http://169.239.251.102:341/~hamison-addy/dish.php";

  xhr.open("POST", endpoint, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var res = JSON.parse(xhr.responseText);
      var confirmation = document.getElementById("confirmation");
      confirmation.textContent = "Order received! Order number: " + res.id;
    }
  };

  var orderPayload = JSON.stringify({ dish: "Jollof Rice", qty: 2 });
  xhr.send(orderPayload);
}

// Execute requests once DOM is ready
window.addEventListener("DOMContentLoaded", function () {
  loadMenuXML();
  loadSpecialsJSON();
  sendOrder();
});