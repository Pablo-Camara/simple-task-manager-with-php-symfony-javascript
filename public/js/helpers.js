function ready(callback){
    // in case the document is already rendered
    if (document.readyState!='loading') callback();
    // modern browsers
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    // IE <= 8
    else document.attachEvent('onreadystatechange', function(){
        if (document.readyState=='complete') callback();
    });
}

function post(data,url,callback) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      callback(this.responseText);
    }
  };
  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(data);
}

function toggleDisplay(element_id){
  var element = document.getElementById(element_id);
  if(element.style.display === 'none')element.style.display = 'block';
  else element.style.display = 'none';
};


function isVisible(element_id){
  var element = document.getElementById(element_id);
  return !(element.style.display === 'none');
}

function displayElement(element_id){
  var element = document.getElementById(element_id);
  element.style.display = 'block';
}

function hideElement(element_id){
  var element = document.getElementById(element_id);
  element.style.display = 'none';
}
