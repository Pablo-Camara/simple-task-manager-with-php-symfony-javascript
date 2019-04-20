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
